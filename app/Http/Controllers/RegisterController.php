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
//        $this->sendEmail($user);

    }

    function sendEmail($user)
    {
        $mail = new PHPMailer();

        try
        {
            $mail->CharSet = 'UTF-8';

            $message = "Test message";
            $message = mb_convert_encoding($message, 'UTF-8');
            $mail->isSMTP();
            $mail->Host = 'smtp.jino.ru';
            $mail->Username = 'register@salesideas.ru';
            $mail->Password = 'AA12411241aa';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->SMTPAuth = true;
            $mail->setFrom('register@salesideas.ru', mb_convert_encoding('Мои контакты - Регистрация','UTF-8'));
            $mail->addAddress("bios90@mail.ru","filippok");


            $mail->isHTML(false);
            $mail->Subject = mb_convert_encoding('Активация аккаунта приложения Мои Контакты','UTF-8');
            $mail->Body = $message;

            if($mail->Send())
            {
                return "okkkk";
                exit;
            }
            else
            {
                return "errrro";
                exit;
            }
        }
        catch(Exception $e)
        {
            return $e->getMessage();
            exit;
        }
    }

}
