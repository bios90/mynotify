<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UpdateTokenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if(!$request->has('email') || !$request->has('fb_token'))
        {
            return 'no_data';
        }

        $email = $request->input('email');
        $token = $request->input('fb_token');

        $user = User::where('email','=',$email)->first();
        if($user != null)
        {
            $user->fb_token = $token;
            $user->save();
        }

        return "all Ok";
    }
}
