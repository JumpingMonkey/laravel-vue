<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        // dd(Auth::user());
        return inertia(
            'Index/Index',
            [
                'message' => 'Hello from laravel'
            ]
        );
    }

    public function show()
    {
        return inertia('Index/Show');
    }
}
