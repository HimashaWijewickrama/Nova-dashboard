<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
use App\Nova\Metrics\TotalUsers;
use App\Nova\Metrics\UsersOverTime;

class UserInsights extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(): array
    {
        return [
            TotalUsers::make(),
            UsersOverTime::make(),
        ];
    }

    public function name()
    {
        return 'User Insights';
    }

    public function uriKey()
{
    return 'user-insights-improved';
}

}