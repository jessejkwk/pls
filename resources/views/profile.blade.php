@extends('layouts.app')


@section('content')


        <h2> Hello {{ \Auth::user()->name }}</h2>




    @foreach($questions as $qt)
        <div class="card">
            <div class="card-header">
                Question N {{ $qt->id }}
            </div>
            <div class="card-block">
                <h4 class="card-title">{{ $qt->user->name }}</h4>
                <p class="card-text">{{ $qt->the_question }} ? </p>
                <a href="{{ route('question' , ['id' => $qt->id]) }}" class="btn btn-primary">see more</a>
            </div>
        </div>
        <br><br>
    @endforeach

@endsection

