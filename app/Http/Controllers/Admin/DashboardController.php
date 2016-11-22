<?php

namespace App\Http\Controllers\Admin;

use View;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends HomeController
{
    public function index()
    {
        return View::make('admin/dashboard');
    }
}