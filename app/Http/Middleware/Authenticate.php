<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Check if the URL contains 'admin'
        if ($request->is('admin/*')) {
            return route('admin.login.form');  // Redirect to admin login
        }

        // Otherwise, redirect to user login
        return route('user.login.form');
    }
}
