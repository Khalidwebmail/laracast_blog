<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;

class ProfileController extends Controller
{

    public function show(User $user)
    {   
        return view('profiles.show', [
            'profile_user' => $user,
            // 'threads'      => $user->threads()->paginate(1)
            'activities'      => Activity::feed($user)
        ]);
    }
}
