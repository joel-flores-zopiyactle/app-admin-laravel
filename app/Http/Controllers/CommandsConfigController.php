<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandsConfigController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function configDB()
    {
        return view('config');
    }

    public function migrateDB()
    {
        echo 'Migrando Base de datos, espere por favor .....';
        Artisan::call('migrate');
        return redirect('/');
    }
}
