@extends('layouts.app')



@section('content')

    <style>
        .chatperson {
            border-bottom: 1px solid #eee;
            width: 100%;
            display: flex;
            align-items: center;
            white-space: nowrap;
            overflow: hidden;
            margin-bottom: 15px;
            padding: 4px;
        }

        .chatperson:hover {
            text-decoration: none;
            border-bottom: 1px solid orange;
        }

        .namechat {
            display: inline-block;
            vertical-align: middle;
        }

        .chatperson .chatimg img {
            width: 40px;
            height: 40px;
            background-image: url('http://i.imgur.com/JqEuJ6t.png');
        }

        .chatperson .pname {
            font-size: 18px;
            padding-left: 5px;
        }

        .chatperson .lastmsg {
            font-size: 12px;
            padding-left: 5px;
            color: #ccc;
        }
    </style>


    <div class="row">
        <div class="col-sm-4">

            @foreach($topics as $topic)
                <a href="{{ route('chat' , [ 'topic_id' => $topic->id ]) }}" class="chatperson">
                    <span class="chatimg">
                        <img src="http://via.placeholder.com/50x50?text={{ $topic->discussions->count() }}" alt="{{ $topic->topic_name }}"/>
                    </span>
                    <div class="namechat">
                        <div class="pname">{{ $topic->topic_name }}</div>
                        <div class="lastmsg">{{ $topic->details }}</div>
                    </div>
                </a>
            @endforeach

        </div>
        <div class="col-sm-8">
            <div class="chatbody">

                <table class="table">
                    @foreach($chats as $chat)
                        <tr>
                            <td><img src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="img-thumbnail"
                                     alt="Cinque Terre" width="100" height="100"></td>
                            <td>
                                <h5 style="font-family: Didot ; font-style: italic ; font-size: large"> <a href="{{ route('profile' , [ 'id' => $chat->user->id ]) }}"> {{ $chat->user->name }} </a>
                                    : </h5>
                                {{ $chat->message }}</td>
                            <td>{{ $chat->sent_at->format('g:i') }}</td>
                        </tr>
                    @endforeach
                </table>

            </div>


            <form action="{{ route('postDisc') }}" method="post">
                <div class="row">
                    <div class="col-xs-9">
                        {{ csrf_field() }}
                        <input name="userId" value="{{ \Auth::user()->id }}" type="hidden">
                        <input name="topicId" value="{{ $topicSelected->id }}" type="hidden">
                        <input type="text" name="message" placeholder=" write your message here ..."
                               class="form-control"/>
                    </div>
                    <div class="col-xs-3">
                        <button type="submit" class="btn btn-info btn-block">Send</button>
                    </div>
                </div>
            </form>

        </div>
    </div>







@endsection