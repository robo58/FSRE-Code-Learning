<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @param User $cUser
     * @return void
     */
    public function getMessages(User $user,User $cUser)
    {
        return Message::whereIn('sender_id',array($user->id,$cUser->id))->whereIn('receiver_id',array($user->id,$cUser->id))->oldest()->get();
    }

    public function getUsers()
    {
        return User::where('id','!=',auth()->id())->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function sendMessage(Request $request)
    {
        $this->validate($request,[
            'sender_id'=>'required',
            'receiver_id'=>'required',
            'text'=>'required|max:255'
        ]);
        $message=new Message();
        $message->sender_id=$request->sender_id;
        $message->receiver_id=$request->receiver_id;
        $message->text=$request->text;
        $message->save();

        broadcast(new MessageSent($message));

        return response($message,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Message  $message
     * @return Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
