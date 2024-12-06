<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;



class ProfileController extends Controller
{

    public function edit(){
        $user = Auth::user();
        return view('dashboard.profile.edit',['user' => $user , 'countries' => Countries::getNames(), 'locales' => Languages::getNames() ]);
    }

    public function update(Request $request){
        $request->validate([
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'birthday '=> ['nullable','date','before:today'],
            'country' => ['required']
        ]);

        $user = Auth::user();
        // if there are not data fill .. fill the i/ps if there are data update this.
        $user->profile->fill($request->all())->save();
        return redirect()->back()->with('Success');

        // $profile = $user->profile;
        // if($profile->user_id){
        //     $profile->update($request->all);
        // }else{
        //     $user->profile()->create($request->all( ));
        // }

    }
}
