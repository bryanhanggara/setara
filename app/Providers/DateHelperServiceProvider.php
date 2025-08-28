<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\DateHelper;

class DateHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Blade directive for Indonesian date format
        Blade::directive('indonesianDate', function ($expression) {
            return "<?php echo App\Helpers\DateHelper::formatIndonesian($expression); ?>";
        });

        // Blade directive for Indonesian short date format
        Blade::directive('indonesianDateShort', function ($expression) {
            return "<?php echo App\Helpers\DateHelper::formatIndonesianShort($expression); ?>";
        });

        // Blade directive for Indonesian date with time
        Blade::directive('indonesianDateTime', function ($expression) {
            return "<?php echo App\Helpers\DateHelper::formatIndonesianWithTime($expression); ?>";
        });

        // Blade directive for time ago in Indonesian
        Blade::directive('timeAgo', function ($expression) {
            return "<?php echo App\Helpers\DateHelper::timeAgo($expression); ?>";
        });
    }
} 