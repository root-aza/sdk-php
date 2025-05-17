<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Internal\Transport\Router;

use React\Promise\Deferred;
use Temporal\DataConverter\EncodedValues;
use Temporal\Worker\Transport\Command\ServerRequestInterface;

final class InvokeSignal extends WorkflowProcessAwareRoute
{
    public function handle(ServerRequestInterface $request, array $headers, Deferred $resolver): void
    {
        $process = $this->findProcessOrFail($request->getID());
        $handler = $process
            ->getContext()
            ->getSignalDispatcher()
            ->getSignalHandler($request->getOptions()['name']);

        // Get Workflow context
        $context = $this->findProcessOrFail($request->getID())->getContext();

        $info = $context->getInfo();
        $tickInfo = $request->getTickInfo();
        /** @psalm-suppress InaccessibleProperty */
        $info->historyLength = $tickInfo->historyLength;
        /** @psalm-suppress InaccessibleProperty */
        $info->historySize = $tickInfo->historySize;
        /** @psalm-suppress InaccessibleProperty */
        $info->shouldContinueAsNew = $tickInfo->continueAsNewSuggested;

        $handler($request->getPayloads());

        $resolver->resolve(EncodedValues::fromValues([null]));
    }
}
