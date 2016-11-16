<?php

namespace App\Providers;
use Blade;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Blade::directive('getimage', function ($image) {
        dd($image);
        return "<?php echo $image ?>";
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
