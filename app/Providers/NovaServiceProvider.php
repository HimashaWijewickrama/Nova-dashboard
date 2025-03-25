<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Fortify\Features;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\Dashboards\Main;
use App\Nova\Dashboards\UserInsights;
class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        parent::boot();

        Nova::footer(function (Request $request) {
            return Blade::render('
                @env(\'prod\')
                    This is production!
                @endenv
            ');
        });

        $this->getCustomMenu();



        Nova::withoutThemeSwitcher(); //remove the theme switcher from the dashboard

        //createcustom footer
        Nova::footer(function(){
            // return '<div style="text-align: center; padding: 10px; font-size: 12px; color: #666;">Powered by <a href="https://nova.laravel.com" target="_blank" class="no-underline dim text-primary font-bold">Laravel Nova</a></div>';
            return Blade::render('nova/footer');  //create a blade file in resources/views/nova/footer.blade.php
        });
    }

    /**
     * Register the configurations for Laravel Fortify.
     */
    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
                // Features::emailVerification(),
                // Features::twoFactorAuthentication(['confirm' => true, 'confirmPassword' => true]),
            ])
            ->register();
    }

    /**
     * Register the Nova routes.
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes(default: true)
            ->withPasswordResetRoutes()
            ->withoutEmailVerificationRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (User $user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Dashboard>
     */
    protected function dashboards(): array
    {
        return [
            Main::make(),
            UserInsights::make(),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Tool>
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        //
    }

    private function getCustomMenu(){
        Nova::mainMenu(function(Request $request){
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar')->withBadge('New', 'success'),
                MenuSection::make('Products', [
                    MenuItem::make('All Products', '/resources/products'),
                    MenuItem::make('Create Product', '/resources/products/new'),
                ])->icon('shopping-bag')->collapsable(),
                MenuSection::make('Brands', [
                    MenuItem::make('All Brands', '/resources/brands'),
                    MenuItem::make('Create Brand', '/resources/brands/new'),
                ])->icon('tag')->collapsable(),
                MenuSection::make('Users', [
                    MenuItem::make('All Users', '/resources/users'),
                    MenuItem::make('Create User', '/resources/users/new'),
                ])->icon('users')->collapsable()
            ];
        });

    }
}
