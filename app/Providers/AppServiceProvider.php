<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configure writable paths for Vercel serverless environment
        if (isset($_ENV['VERCEL']) || isset($_ENV['LAMBDA_TASK_ROOT'])) {
            // Create necessary directories in /tmp
            $tmpDirs = [
                '/tmp/storage',
                '/tmp/storage/framework',
                '/tmp/storage/framework/cache',
                '/tmp/storage/framework/sessions',
                '/tmp/storage/framework/views',
                '/tmp/views',
                '/tmp/cache',
            ];

            foreach ($tmpDirs as $dir) {
                if (!file_exists($dir)) {
                    @mkdir($dir, 0755, true);
                }
            }

            // Set config values for writable paths
            config(['view.compiled' => '/tmp/views']);
            config(['cache.stores.file.path' => '/tmp/cache']);
            config(['session.files' => '/tmp/storage/framework/sessions']);
        }
    }
}
