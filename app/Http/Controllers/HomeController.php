<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        if (Auth::check()) {
            $role_id = Auth::user()->role_id;

            // Redirect based on role_id
            if ($role_id === 1) {
                return redirect()->route('patient.dashboard');
            } elseif ($role_id === 2) {
                return redirect()->route('patient.dashboard');
            }
        }

        // Default redirect if user is not authenticated or role not found
        return redirect('/login');
    }
}
