<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function users()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('users', ['users'=>$users]);
    }

    public function conversation($id){
        $messages = Message::with('sender')->whereIn(
            'sender_id', [$id, Auth::id()])->whereIn(
            'receiver_id', [$id, Auth::id()]
        )->orderBy('id')->get();
        return view('conversation', [
            'messages'=>$messages,
            'otherUserId'=>$id,
            'userId'=>Auth::id(),
        ]);
    }

    public function sendMessage(Request $request){
        $this->validate($request, [
            'message' => 'required',
            'otherUserId' => 'required',
        ]);

        $message = new Message();
        $message->content = $request->input('message');
        $message->receiver_id = $request->input('otherUserId');
        $message->sender_id = Auth::id();

        $message->save();

        return redirect()->route('conv', [
            'id'=>$message->receiver_id
        ]);
    }
}
