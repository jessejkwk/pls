<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Requests\NewQuestionRequest;
use App\Question;
use \Gate ;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route( 'home' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'askPage' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewQuestionRequest $request)
    {
        $question = new Question;
        $question->the_question = $request->input( 'question' );
        $question->details = $request->input( 'details' );
        $question->user_id = $request->input( 'userId' );
        $question->asked_at = \Carbon\Carbon::now();
        $question->save();

        //Session::flash('message' , 'thanks for asking');

        flashData( 'thanks for asking ', 'sucess' );

        return redirect()->route( 'home' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questionToEdit = Question::find($id) ;
        if (Gate::denies('edit_question' , $questionToEdit))
            return redirect()->back() ;
        return view('askPage')->with('questionToEdit' , $questionToEdit) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id) ;

        if (Gate::denies('edit_question' , $question))
            return redirect()->back() ;

        $this->validate($request , [
            'question' => [ 'required', 'min:20' ]
        ]);

        $question->the_question = $request->input('question') ;
        if ($request->has('details'))
            $question->details = $request->input('details') ;
        $question->update() ;

        return redirect()->route('profile' , ['id' => auth()->id() ]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questionToDelete = Question::find($id);
        //        if (\Auth::id() == Question::find($id)->user->id)
        //        {
        //            $question = Question::find($id) ;
        //            $question->answers->each(function ($answer)
        //            {
        //                $answer->delete() ;
        //            });
        //            Question::destroy($id) ;
        //        }
        if ( Gate::denies( 'delete_question', $questionToDelete ) )
            flashData( 'you can\'t delete that question ', 'danger' );
        else
        {
            // delete the answers first then delete the question
            // I know that I should use on delete cascade .
            $questionToDelete->answers()->delete() ;
            $questionToDelete->delete() ;
            flashData( ' question deleted with id : ' . $id , 'info' );
        }

        return redirect()->route('home') ;
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


        flashData( ['message' => 'thanks for helping others'], 'info' );

        return redirect()->route( 'question', ['id' => $request->input( 'questionId' )] );
    }


}
