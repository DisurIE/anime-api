<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;

$app = Application::configure(basePath: dirname(__DIR__))->create();

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Framework\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Framework\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Framework\Exceptions\Handler::class
);

return $app;
