<?php

namespace AskewBrook\DevTools;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DevToolsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->environment('local')) {
            return;
        }

        $this->registerRoutes();
        $this->publishStubs();
    }

    protected function registerRoutes(): void
    {
        Route::get('/devtools.json', function () {
            $path = resource_path('devtools/components.json');

            $data = file_exists($path)
                ? json_decode(file_get_contents($path), true)
                : ['components' => []];

            // Auto-injected context
            $data['projectRoot'] = base_path();
            $data['environment'] = app()->environment();
            $data['php'] = PHP_VERSION;
            $data['laravel'] = app()->version();

            // Auto-detect available tools
            $data['links'] = array_filter([
                'telescope' => $this->detectRoute('telescope'),
                'horizon' => $this->detectRoute('horizon.index'),
                'pulse' => $this->detectRoute('pulse'),
                'filament' => $this->detectFilament(),
                'nova' => $this->detectRoute('nova.pages.home'),
            ]);

            return response()->json($data, 200, [
                'Access-Control-Allow-Origin' => '*',
            ]);
        })->name('devtools.json');
    }

    protected function detectRoute(string $name): ?string
    {
        return Route::has($name) ? route($name) : null;
    }

    protected function detectFilament(): ?string
    {
        if (! class_exists(\Filament\FilamentServiceProvider::class)) {
            return null;
        }

        // Get the first panel's path
        if (class_exists(\Filament\Facades\Filament::class)) {
            try {
                $panels = \Filament\Facades\Filament::getPanels();
                if ($panels && count($panels) > 0) {
                    return '/' . array_values($panels)[0]->getPath();
                }
            } catch (\Throwable) {
                // Fallback
            }
        }

        return '/admin';
    }

    protected function publishStubs(): void
    {
        $this->publishes([
            __DIR__.'/../resources/devtools/components.json' => resource_path('devtools/components.json'),
        ], 'devtools-config');
    }
}
