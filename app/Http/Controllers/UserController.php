<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question ;
use App\Discussion;
use App\Http\Requests\NewQuestionRequest;
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

    public function postAnswer(Request $request)
    {
        $this->validate( $request, ['the_answer' => 'required', 'userId' => 'required', 'questionId' => 'required'] );

        $newAnswer = new Answer;

        $newAnswer->the_answer = $request->input( 'the_answer' );
        $newAnswer->user_id = $request->input( 'userId' );
        $newAnswer->question_id = $request->input( 'questionId' );
        $newAnswer->answred_at = \Carbon\Carbon::now();

        $newAnswer->save();

        return redirect()->route( 'question', ['id' => $request->input( 'questionId' )] );
    }

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

    public function askQuestion()
    {
        return view('askPage') ;
    }


    public function postQuestion(NewQuestionRequest $request )
    {
        $question = new Question  ;
        $question->the_question = $request->input('question') ;
        $question->details = $request->input('details') ;
        $question->user_id = $request->input('userId') ;
        $question->asked_at = \Carbon\Carbon::now() ;
        $question->save() ;

        return redirect()->route('home') ;
    }

    public function search(Request $request)
    {
        $this->validate($request , [
            'search' => 'required'
        ]) ;

        $questions = Question::where('the_question' , 'like' , '%' . $request->input('search' ) . '%')->paginate(5) ;

        return view('home')->with('questions' , $questions ) ;

    }

    public function chatDiscussion($topic_id)
    {
        $topics = Topic::all() ;
        $topic = Topic::find($topic_id) ;
        $chats = $topic->discussions ;

        return view( 'chat' )->with( ['chats' => $chats , 'topics' => $topics  , 'topicSelected' => $topic] );
    }

}
