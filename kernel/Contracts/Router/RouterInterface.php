<?php

namespace Kernel\Contracts\Router;

interface RouterInterface
{
    public function add(string $method, string $path, callable $callback): void;

    public function dispatch(): callable;
}