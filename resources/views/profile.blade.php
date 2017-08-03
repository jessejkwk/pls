@extends('layouts.app')


@section('content')


    <h1> {{ $user->name }}
        <small>'s profile .</small>
    </h1>

    <br>
    <br>

    <h2>
        <small> Hello</small> {{ \Auth::user()->name }}</h2>
    <br>
    <br>


    @foreach($questions as $qt)
        <div class="card">
            <form method="post" action="{{ route('deleteQuestion' , ['id' => $qt->id]) }}">
                <button type="submit" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ csrf_field() }}
            </form>
            <div class="card-header">
                <h4 style="font-family: 'Apple SD Gothic Neo'"> Question N {{ $qt->id }} </h4>
            </div>
            <div class="card-block">
                {{--<h4 class="card-title">{{ $qt->user->name }}</h4>--}}
                <p class="card-text">{{ $qt->the_question }} ? </p>
                <p style="font-family: 'Arial Hebrew Scholar'"> {{ $qt->details }}</p>
                <a href="{{ route('question' , ['id' => $qt->id]) }}" class="btn btn-success">see more</a>
            </div>
        </div>
        <br><br>
    @endforeach

    @if(session()->has('pagesVisited'))
        <h2>
            PAGES VISITED WHILE ONLINE : {{ session()->get('pagesVisited') }}
        </h2> .
    @endif


@endsection

