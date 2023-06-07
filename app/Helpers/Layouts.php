<?php

namespace App\Helpers;

use App\Models\Navigation;
use App\Http\Controllers\Controller;

class Layouts extends Controller
{
    /**
     * front end navigation
     */
    public static function NAVIGATION()
    {
        return Navigation::select('id', 'nav_bn', 'slug')->where('status', 1)->with('category')->get();
    }
}
