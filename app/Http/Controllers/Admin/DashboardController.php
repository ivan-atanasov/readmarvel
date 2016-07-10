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
        if (\Auth::user()->can('edit_forum')) {
            echo "you can edit the forum";
        }

        echo "";

        if (\Auth::user()->can('edit_funds')) {
            echo "you can edit the funds";
        }

        return View::make('admin/dashboard');
    }
}