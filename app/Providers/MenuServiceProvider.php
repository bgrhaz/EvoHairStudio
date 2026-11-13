<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Route;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
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
    $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
    $verticalMenuData = json_decode($verticalMenuJson);

    $verticalMenuBarbermanJson = file_get_contents(base_path('resources/menu/verticalMenuBarberman.json'));
    $verticalMenuBarbermanData = json_decode($verticalMenuBarbermanJson);

    // Share all menuData to all the views
    $this->app->make('view')->share('menuData', [$verticalMenuData, $verticalMenuBarbermanData]);
  }
}
