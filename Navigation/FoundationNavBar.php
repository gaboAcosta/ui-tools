<?php
/**
 * User: Gabriel Acosta
 * Date: 12/26/13
 * Time: 9:35 AM
 */

namespace GaboAcosta\UITools\Navigation;

use Illuminate\Support\Facades\Facade;

class FoundationNavBar extends Facade {
    protected static function getFacadeAccessor(){return 'navbar';}
}