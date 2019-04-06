<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('adminpage', compact('users'));
    }


    public function send(Request $request)
    {
        $title = $request->input('title');
        $message1 = $request->input('message1');
        $message2 = $request->input('message2');
        $message3 = $request->input('message3');
        $url = $request->input('url');
        $userIds = $request->input('users');

        foreach ($userIds as $id)
        {
            $user = User::find($id);
            $this->makeFBCall($title, $message1, $message2, $message3, $url, $user);
        }
    }


    private function makeFBCall($title, $message1, $message2, $message3, $url, $user)
    {
        $client = new Client(['headers' => ['content-Type' => 'application/json', 'authorization' => 'key=AAAAuiTz0cc:APA91bGgncA3ydpXn1DjXLGgeH7AFSUymKbzNvq-__CA71eQvg_5u8zxDsobDraBS1ro1fGZAgD2GAjZZ8UB0dybzGNx1UV1EXOWNIvXNZAYI_c3ds_cB9stMPCJ32Pxw5nUDoIUAidh']]);
        $res = $client->request('POST', 'https://fcm.googleapis.com/fcm/send',
            [
                'body' => json_encode(
                    [
                        'data' =>
                            [
                                'title' => $title,
                                'message1' => $message1,
                                'message2' => $message2,
                                'message3' => $message3,
                                'url' => $url
                            ]
                        ,
                        'to' => $user->fb_token
                    ])
            ]);

        echo $res->getStatusCode();
    }
}
