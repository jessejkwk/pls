@extends('layouts.app')

@section('content')

    @if(\Auth::user()->isAdmin())
        <a class="btn btn-primary" href="{{ route('users') }}"> see all Users </a>
    @endif


    <div class="container">
        <div class="row">
            <h2>/** welcome **/</h2>
            <form action="{{ route('search') }}" method="get">
                {{--{{ csrf_field() }}--}}
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input name="search" type="text" class="search-query form-control"
                               placeholder="Search from questions "/>
                        <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

    @isset($questions)



        @foreach($questions as $qt)
            <div class="card">
                <div class="card-header">
                    Question N {{ $qt->id }}
                </div>
                <div class="card-block">
                    <h4 class="card-title">{{ $qt->user->name }}</h4>
                    <p class="card-text">{{ $qt->the_question }} ? </p>
                    <p class="card-text" style="font-family: 'American Typewriter'">{{ $qt->details }} .</p>
                    <a href="{{ route('question' , ['id' => $qt->id ]) }}" class="btn btn-primary">see more</a>
                </div>
            </div>
            <br><br>
        @endforeach

        {{ $questions->links() }}
    @endisset


    <style>
        #custom-search-input {
            margin: 0;
            margin-top: 10px;
            padding: 0;
        }

        #custom-search-input .search-query {
            padding-right: 3px;
            padding-right: 4px \9;
            padding-left: 3px;
            padding-left: 4px \9;
            /* IE7-8 doesn't have border-radius, so don't indent the padding */

            margin-bottom: 0;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        #custom-search-input button {
            border: 0;
            background: none;
            /** belows styles are working good */
            padding: 2px 5px;
            margin-top: 2px;
            position: relative;
            left: -28px;
            /* IE7-8 doesn't have border-radius, so don't indent the padding */
            margin-bottom: 0;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            color: #D9230F;
        }

        .search-query:focus + button {
            z-index: 3;
        }
    </style>
    
@endsection
