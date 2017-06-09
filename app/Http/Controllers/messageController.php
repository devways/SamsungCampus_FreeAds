<?php

namespace freeads\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use freeads\User;
use freeads\Message;

class messageController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'content' => 'required|max:255',
        ]);
    }

    public function index(Request $request) {
        return view('messages/index');
    }

    public function reception(Request $request) {
        $messages = DB::table('users')
            ->rightJoin('messages', 'users.id', '=', 'messages.expediteur_id')
            ->where('destinataire_id', Auth::user()->id)
            ->get();
        return view('messages/reception', ['message' => $messages]);
    }

    public function send(Request $request, Message $message) {
        if($request->email) {
            $destinataire_id = DB::table('users')
            ->where('email', $request->email)
            ->get();
            if($destinataire_id) {
                $message->destinataire_id = $destinataire_id[0]->id;
                $message->expediteur_id = Auth::user()->id;
                $message->content = $request->content;
                $message->save();
            }
        }
        return redirect('message/send');
    }
}
