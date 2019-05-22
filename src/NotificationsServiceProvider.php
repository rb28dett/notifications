<?php

namespace RB28DETT\Notifications;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use RB28DETT\Notifications\Models\Notification;
use RB28DETT\Notifications\Models\Settings;
use RB28DETT\Notifications\Policies\NotificationsPolicy;
use RB28DETT\Notifications\Policies\SettingsPolicy;
use RB28DETT\Permissions\PermissionsChecker;

class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Notification::class => NotificationsPolicy::class,
        Settings::class     => SettingsPolicy::class,
    ];

    /**
     * The mandatory permissions for the module.
     *
     * @var array
     */
    protected $permissions = [
        [
            'name' => 'Create Notifications',
            'slug' => 'rb28dett::notifications.create',
            'desc' => 'Allows creating notifications',
        ],
        [
            'name' => 'Edit Notifications Settings',
            'slug' => 'rb28dett::notifications.settings',
            'desc' => 'Allows edititing the notification settings',
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->loadTranslationsFrom(__DIR__.'/Translations', 'rb28dett_notifications');

        $this->loadViewsFrom(__DIR__.'/Views', 'rb28dett_notifications');

        $this->publishes([
            __DIR__.'/Views/public' => resource_path('views/vendor/rb28dett_notifications/public'),
        ], 'rb28dett_notifications');

        if (!$this->app->routesAreCached()) {
            require __DIR__.'/Routes/web.php';
        }

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        // Make sure the permissions are OK
        PermissionsChecker::check($this->permissions);
    }

    /**
     * I cheated this comes from the AuthServiceProvider extended by the App\Providers\AuthServiceProvider.
     *
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
