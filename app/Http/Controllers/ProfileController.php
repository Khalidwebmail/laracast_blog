<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show(User $user)
    {
        $activities = $user->activity()->latest()->with('subject')->get()->groupBy(function($activitiy) {
            return $activitiy->created_at->format("Y-m-d");
        });
        
        return view('profiles.show', [
            'profile_user' => $user,
            // 'threads'      => $user->threads()->paginate(1)
            'activities'      => $activities
        ]);
    }
}
