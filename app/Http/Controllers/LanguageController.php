<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function update(Request $request)
    {
        $language = $request->input('language');

        // Update the session with the new language preference
        session(['language' => $language]);

        // Update the authenticated user's language preference if available
        if (auth()->check()) {
            $user = auth()->user();
            $user->language = $language;
            $user->save();
        }

        return redirect()->back()->with('success', 'Language preference updated successfully.');
    }
}
