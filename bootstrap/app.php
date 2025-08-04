<?php

use App\Http\Middleware\EnsureCandidateLogin;
use App\Http\Middleware\EnsureExaminerLogin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'EnsureCandidate'])
                ->prefix('candidate')
                ->name('candidate.')
                ->group(base_path('routes/candidate.php'));

            Route::middleware(['web', 'EnsureExaminer'])
                ->prefix('examiner/')
                ->name('examiner.')
                ->group(base_path('routes/examiner.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'EnsureCandidate' => EnsureCandidateLogin::class,
            'EnsureExaminer' => EnsureExaminerLogin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
