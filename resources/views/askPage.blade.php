@extends('layouts.app')


@section('content')



    <div class="container">
        <div class="row">
            <form role="form" id="contact-form" class="contact-form" action="{{ route('postQuestion') }}"  method="post">
                <input type="hidden" name="userId" value="{{ Auth::id() }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="question" id="Name"
                                   placeholder="Question">
                        </div>
                    </div>
                    {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="email" class="form-control" name="email" autocomplete="off" id="email"--}}
                                   {{--placeholder="E-mail">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control textarea" rows="3" name="details" id="Message"
                                      placeholder="details .. "></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn main-btn pull-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .contact-form {
            margin-top: 15px;
        }

        .contact-form .textarea {
            min-height: 220px;
            resize: none;
        }

        .form-control {
            box-shadow: none;
            border-color: #eee;
            height: 49px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #00b09c;
        }

        .form-control-feedback {
            line-height: 50px;
        }

        .main-btn {
            background: #00b09c;
            border-color: #00b09c;
            color: #fff;
        }

        .main-btn:hover {
            background: #00a491;
            color: #fff;
        }

        .form-control-feedback {
            line-height: 50px;
            top: 0px;
        }
    </style>

@endsection