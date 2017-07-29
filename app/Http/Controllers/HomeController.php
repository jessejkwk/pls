<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::latest()->paginate(10) ;

        return view('home')->with('questions' , $questions) ;
    }

    public function search(Request $request)
    {
        $this->validate($request , [
            'search' => 'required'
        ]) ;

        $questions = Question::where('the_question' , 'like' , '%' . $request->input('search' ) . '%')->paginate(5) ;

        return view('home')->with('questions' , $questions ) ;

    }



}
