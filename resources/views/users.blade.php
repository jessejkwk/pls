@extends('layouts.app')


@section('content')

    <h1> Hello Admin </h1>

    <div class="row">

        @foreach($users as $user)

            <div class="card">
                <div class="card-header">
                    User : {{ $user->id }}
                </div>
                <div class="card-block">
                    <h4 class="card-title">{{ $user->name }}</h4>
                    <p class="card-text"> {{ $user->questions->count() }} question (s) asked </p> <br>
                    <p class="card-text"> {{ $user->answers->count() }} answer (s) answered</p>
                    <a href="{{ route('profile' ,[ 'id' => $user->id ]) }}" class="btn btn-primary">visit profile</a>
                </div>
            </div>

        @endforeach


        {{ $users->links() }}

    </div>

@endsection