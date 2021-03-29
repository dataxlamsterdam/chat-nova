<?php

namespace Dataxl\NovaChat;

use Dataxl\NovaChat\Models\MessageModel;
use Dataxl\NovaChat\Models\RecipientModel;
use Dataxl\NovaChat\Policies\MessagePolicy;
use Dataxl\NovaChat\Policies\RecipientPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NovaChatServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->bootRegisterer();

        $this->app->booted(function () {
            $this->routes();
        });
    }

    public function bootRegisterer(): void
    {
        $this->publishes([
            __DIR__ . '/config/nova-chat.php' => config_path('nova-chat.php'),
        ], 'nova-chat');

        if (!class_exists('CreateMessagesTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_messages_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_messages_table.php'),
            ], 'nova-chat');
        }
    }

    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->prefix('nova-vendor/dataxl/advanced-nova-chat')
            ->group(__DIR__ . '/../routes/api.php');
    }

    public function register()
    {
        $this->registerPolicies();
    }

    public function registerPolicies()
    {
        Gate::policy(RecipientModel::class, RecipientPolicy::class);
        Gate::policy(MessageModel::class, MessagePolicy::class);
    }
}
