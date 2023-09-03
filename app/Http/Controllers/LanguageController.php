<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function update()
    {
        if(App::isLocale('en'))
        {
            App::setLocale('ar');

        }
        else{
            App::setLocale('en');
        }

        return redirect()->back()->with('success', 'Language preference updated successfully.');
    }
}
