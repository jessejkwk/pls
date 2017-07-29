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

        $questions = \App\User::find($id)->questions;

        return view( 'profile' )->with( 'questions' , $questions  );
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



    public function chatDiscussion($topic_id)
    {
        $topics = Topic::all() ;
        $topic = Topic::find($topic_id) ;
        $chats = $topic->discussions ;

        return view( 'chat' )->with( ['chats' => $chats , 'topics' => $topics  , 'topicSelected' => $topic] );
    }

}
