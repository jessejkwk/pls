<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Topic;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function profile($id)
    {
        if ( \Auth::guest() )
            return redirect()->route( 'login' );

        $user_sProfile = \App\User::find($id) ;

        $questions = $user_sProfile->questions;

        return view( 'profile' )->with( ['questions' => $questions , 'user' => $user_sProfile ]  );
    }



    // discussions


    public function postDisc(Request $request)
    {
        $this->validate( $request, ['message' => 'required', 'userId' => 'required' , 'topicId' => 'required'] );

        $discution = new Discussion;
        $discution->message = $request->input( 'message' );
        $discution->sent_at = \Carbon\Carbon::now();
        $discution->topic_id = $request->input('topicId') ;
        $discution->user_id = $request->input( 'userId' );

        $discution->save();

        return redirect()->route( 'chat' , [ 'topic_id' => $request->input('topicId')]);
    }

    public function users()
    {
        $users = \App\User::orderBy('created_at' , 'desc')->paginate(10) ;

        return view('users')->with('users'  , $users) ;

    }

    public function chatDiscussion($topic_id)
    {
        $topics = Topic::all() ;
        $topic = Topic::find($topic_id) ;
        $chats = $topic->discussions ;

        return view( 'chat' )->with( ['chats' => $chats , 'topics' => $topics  , 'topicSelected' => $topic] );
    }

}
