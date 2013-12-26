<?php
/**
 * User: Gabriel Acosta
 * Date: 12/26/13
 * Time: 9:37 AM
 */

namespace GaboAcosta\UITools\Navigation;

use Illuminate\Support\ServiceProvider;

class NavBarServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('navbar', function()
        {
            return new NavBar();
        });
    }

}