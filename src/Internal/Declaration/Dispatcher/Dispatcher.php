<?php

/**
 * This file is part of Temporal package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Temporal\Internal\Declaration\Dispatcher;

use JetBrains\PhpStorm\Pure;

/**
 * @psalm-type FunctionExecutor = \Closure(object, array): mixed
 */
class Dispatcher implements DispatcherInterface
{
    /**
     * @var int
     */
    public const SCOPE_OBJECT = 0x01;

    /**
     * @var int
     */
    public const SCOPE_STATIC = 0x02;

    /**
     * @var \Closure(object, array): mixed
     * @psalm-var FunctionExecutor
     */
    private \Closure $executor;

    /**
     * @var array<\ReflectionType>
     */
    private $types;

    private int $scope = 0;

    public function __construct(\ReflectionFunctionAbstract $fun)
    {
        $this->boot($fun);
    }

    public function isObjectContextRequired(): bool
    {
        return $this->scope === static::SCOPE_OBJECT;
    }

    #[Pure]
    public function isObjectContextAllowed(): bool
    {
        return $this->scopeMatches(static::SCOPE_OBJECT);
    }

    public function isStaticContextRequired(): bool
    {
        return $this->scope === static::SCOPE_STATIC;
    }

    #[Pure]
    public function isStaticContextAllowed(): bool
    {
        return $this->scopeMatches(static::SCOPE_STATIC);
    }

    /**
     * @return array<\ReflectionType>
     */
    public function getArgumentTypes(): array
    {
        return $this->types;
    }

    public function dispatch(object $ctx, array $arguments): mixed
    {
        return ($this->executor)($ctx, $arguments);
    }

    #[Pure]
    private function scopeMatches(int $scope): bool
    {
        return ($this->scope & $scope) === $scope;
    }

    /**
     * @psalm-return FunctionExecutor
     *
     * @return \Closure(object, array): mixed
     */
    private function createExecutorFromMethod(\ReflectionMethod $fun): \Closure
    {
        return static function (object $object, array $arguments) use ($fun) {
            try {
                return $fun->invokeArgs($object, $arguments);
            } catch (\ReflectionException $e) {
                throw new \BadMethodCallException($e->getMessage(), $e->getCode(), $e);
            }
        };
    }

    /**
     * @psalm-return FunctionExecutor
     *
     * @return \Closure(object, array): mixed
     */
    private function createExecutorFromFunction(\ReflectionFunction $fun): \Closure
    {
        return static function (object $ctx, array $arguments) use ($fun) {
            $closure = $fun->getClosure();

            try {
                \set_error_handler(static function (int $type, string $message, string $file, int $line): void {
                    $error = new \ErrorException($message, $type, $type, $file, $line);

                    throw new \BadMethodCallException($message, $type, $error);
                });


                return $fun->isStatic()
                    ? $closure->bindTo(null, $ctx::class)?->__invoke(...$arguments) ?? $closure(...$arguments)
                    : $closure->call($ctx, ...$arguments);
            } finally {
                \restore_error_handler();
            }
        };
    }

    /**
     * @psalm-return FunctionExecutor
     */
    private function boot(\ReflectionFunctionAbstract $fun): void
    {
        if ($fun instanceof \ReflectionMethod) {
            $this->executor = $this->createExecutorFromMethod($fun);
            $this->scope = static::SCOPE_OBJECT;

            if ($fun->isStatic()) {
                $this->scope |= static::SCOPE_STATIC;
            }

            $this->types = [];
            foreach ($fun->getParameters() as $param) {
                $this->types[] = $param->getType();
            }

            return;
        }

        if ($fun instanceof \ReflectionFunction) {
            $this->executor = $this->createExecutorFromFunction($fun);
            $this->scope = static::SCOPE_STATIC;

            if ($fun->isClosure() && $fun->getClosureThis() !== null) {
                $this->scope |= static::SCOPE_OBJECT;
            }

            $this->types = [];
            foreach ($fun->getParameters() as $param) {
                $this->types[] = $param->getType();
            }

            return;
        }

        throw new \InvalidArgumentException('Unsupported function implementation');
    }
}
