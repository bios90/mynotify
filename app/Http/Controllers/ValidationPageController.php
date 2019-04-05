<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ValidationPageController extends Controller
{
    public function index(Request $request)
    {
        $errors = array();
        if(!$request->has('id') || !$request->has('key'))
        {
            $errors[] = "Ошибка, проверьте ссылку в письме или повторите регистрацию";
            return view('verifypage.verifypage', compact('errors'));
        }

        $id = $request->input('id');
        $key = $request->input('key');

        $user = User::where('id','=',$id)->where('activation_key','=',$key)->first();

        if($user == null)
        {
            $errors[] = "Ошибка, пользователь не найден";
            return view('verifypage.verifypage', compact('errors'));
        }


        if($user->verified === 1)
        {
            $errors[] = "Данный email уже активирован";
            return view('verifypage.verifypage', compact('errors'));
        }

        $user->verified = 1;
        $user->email_verified_at = now();
        $user->save();

        $result = "success";
        return view('verifypage.verifypage', compact('result'));
    }
}

