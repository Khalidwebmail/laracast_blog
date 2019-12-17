<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show(User $user)
    {
        $activities = $this->getActivity($user);
        
        return view('profiles.show', [
            'profile_user' => $user,
            // 'threads'      => $user->threads()->paginate(1)
            'activities'      => Activity::feed($user)
        ]);
    }

    protected function getActivity(User $user)
    {
        return $user->activity()->latest()->with('subject')->take()->get()->groupBy(function($activitiy) {
            return $activitiy->created_at->format("Y-m-d");
        });
    }
}
