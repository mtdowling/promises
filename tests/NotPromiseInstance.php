<?php

declare(strict_types=1);

namespace GuzzleHttp\Promise\Tests;

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\PromiseInterface;

class NotPromiseInstance extends Thennable implements PromiseInterface
{
    private $nextPromise = null;

    public function __construct()
    {
        $this->nextPromise = new Promise();
    }

    public function then(callable $res = null, callable $rej = null)
    {
        return $this->nextPromise->then($res, $rej);
    }

    public function otherwise(callable $onRejected)
    {
        return $this->then($onRejected);
    }

    public function resolve($value): void
    {
        $this->nextPromise->resolve($value);
    }

    public function reject($reason): void
    {
        $this->nextPromise->reject($reason);
    }

    public function wait($unwrap = true, $defaultResolution = null): void
    {
    }

    public function cancel(): void
    {
    }

    public function getState()
    {
        return $this->nextPromise->getState();
    }
}
