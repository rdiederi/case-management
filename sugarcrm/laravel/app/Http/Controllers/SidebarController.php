<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SidebarController extends Controller
{
    public function index()
    {
        return view('sidebar.index');
    }

    public function left()
    {
        global $moduleVardefs;

        foreach( $moduleVardefs as $beanName => $moduleVardef ) {
            $moduleVardefs[$beanName]['labelPlural'] = Str::plural($moduleVardefs[$beanName]['label']);
        }
        return view('sidebar.left', compact('moduleVardefs'));
    }
}
