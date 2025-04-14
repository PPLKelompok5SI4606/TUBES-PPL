<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Check if this is a logout request or post-logout redirect
        if ($request->is('logout') || $request->session()->has('just_logged_out')) {
            return view('usermain');
        }
        
        // Handle role-based redirection
        if (Auth::check()) {
            $user = Auth::user();
            $userRole = $user->role; // Assuming 'role' is the column name
            
            if ($userRole === 'admin') {
                return redirect()->route('admin.home');
            } elseif ($userRole === 'pengelola') {
                return redirect()->to('/laporan');
            }
        }
        
        // Default view for users and guests
        return view('usermain');
    }
}