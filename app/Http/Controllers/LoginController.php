<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        if(!$request->has('email') || !$request->has('password'))
        {
            return 'no_data';
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email','=',$email)->first();

        if($user == null)
        {
            return 'email_not_found';
        }

        if(!Hash::check($password,$user->password))
        {
            return 'pass_error';
        }

        if($user->virified === 0)
        {
            return 'verify_error';
        }

        if($request->has('fb_token'))
        {
            $token = $request->input('fb_token');
            $user->fb_token = $token;
            $user->save();
        }

        return json_encode($user);
    }
}
