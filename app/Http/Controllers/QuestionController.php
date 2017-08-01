<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Requests\NewQuestionRequest;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('home') ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('askPage') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewQuestionRequest $request)
    {
        $question = new Question  ;
        $question->the_question = $request->input('question') ;
        $question->details = $request->input('details') ;
        $question->user_id = $request->input('userId') ;
        $question->asked_at = \Carbon\Carbon::now() ;
        $question->save() ;

        //Session::flash('message' , 'thanks for asking');

        flashData('thanks for asking ' , 'sucess') ;

        return redirect()->route('home') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qt = Question::find( $id );
        $answers = $qt->answers;

        return view( 'question' )->with( ['qt' => $qt, 'anws' => $answers] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (\Auth::id() == Question::find($id)->user->id)
        {
            $question = Question::find($id) ;
            $question->answers->each(function ($answer)
            {
                $answer->delete() ;
            });
            Question::destroy($id) ;
        }
        else
            flashData('you can\'t delete that question ' , 'danger') ;

        return redirect()->back() ;
    }

    public function postAnswer(Request $request)
    {
        $this->validate( $request, [
            'the_answer' => 'required',
            'userId' => 'required',
            'questionId' => 'required'
        ]);

        $newAnswer = new Answer;

        $newAnswer->the_answer = $request->input( 'the_answer' );
        $newAnswer->user_id = $request->input( 'userId' );
        $newAnswer->question_id = $request->input( 'questionId' );
        $newAnswer->answred_at = \Carbon\Carbon::now();

        $newAnswer->save();

        //Session::flash('message' , ' thanks for helping others ') ;
        flashData(['message' => 'thanks for helping others' ] , 'info') ;

        return redirect()->route( 'question', ['id' => $request->input( 'questionId' )] );
    }



}
