<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailVerify;

class RegisterController extends Controller
{



    public function register(Request $request)
    {

        $rules = array
        (
            'email' => 'bail|email|required|unique:users',
            'name' => 'required|max:255',
            'password'=>'required|regex:/^[a-zA-Z0-9]{8,}$/',
            'fb_token'=>'required'
        );

        $messages = array
        (
            'name.required' => 'name',
            'email.required' => 'email',
            'email.unique' => 'email_in_use',
            'email.email' => 'email',
            'password.required' => 'pass',
            'password.regex' => 'pass',
            'fb_token.required' => 'fb_token'
        );

        $validator = Validator::make
        (
            $request->all(),
            $rules,
            $messages
        );

        if ($validator->fails())
        {
            $error = $validator->errors()->all();
            return $error;
        }

        $activation_key = Str::random(64);
        $password = bcrypt($request->get('password'));
        $request->merge([ 'password' => $password]);
        $request->merge([ 'activation_key' => $activation_key]);



        $user = new User($request->all());
        $user->save();

        Mail::to($user->email)->send(new SendMailVerify($user));

        return "success";

    }
}
