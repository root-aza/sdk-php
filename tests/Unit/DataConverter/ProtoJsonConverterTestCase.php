<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Tests\Unit\DataConverter;

use Temporal\DataConverter\EncodingKeys;
use Temporal\DataConverter\PayloadConverterInterface;
use Temporal\DataConverter\ProtoJsonConverter;
use Temporal\Tests\Unit\UnitTestCase;

/**
 * @group unit
 * @group data-converter
 */
class ProtoJsonConverterTestCase extends UnitTestCase
{
    protected function create(): PayloadConverterInterface
    {
        return new ProtoJsonConverter();
    }

    public function testMessageType(): void
    {
        $converter = $this->create();

        $message = new \Temporal\Tests\Proto\Test();
        $message->setValue('foo');

        $payload = $converter->toPayload($message);

        $this->assertNotNull($payload);
        $this->assertSame(
            'tests.Test',
            $payload->getMetadata()->offsetGet(EncodingKeys::METADATA_MESSAGE_TYPE),
        );
    }
}
