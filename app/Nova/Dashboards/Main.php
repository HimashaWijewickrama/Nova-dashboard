<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\NewProducts;
use App\Nova\Metrics\ProductsPerDay;
use App\Nova\Dashboards\UserInsights;
use App\Nova\Metrics\RegisteredUsers;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(): array
    {
        return [
            new ProductsPerDay(),
            new RegisteredUsers(),
            new UserInsights(),
        ];
    }
}
