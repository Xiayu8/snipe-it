@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('general.changepassword') }}
@stop

{{-- Account page content --}}
@section('content')


<div class="row">
    <div class="col-md-9">
    {{ Form::open(['method' => 'POST', 'files' => true, 'class' => 'form-horizontal', 'autocomplete' => 'off']) }}
    <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="box box-default">
            <div class="box-body">


    <!-- Old Password -->
    <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
        <label for="current_password" class="col-md-3 control-label"> {{ trans('general.current_password') }} </label>
        </label>
        <div class="col-md-5 required">
            <input class="form-control" type="password" name="current_password" id="current_password" {{ (config('app.lock_passwords') ? ' disabled' : '') }}>
            {!! $errors->first('current_password', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
            @if (config('app.lock_passwords')===true)
                <p class="text-warning"><i class="fas fa-lock"></i> {{ trans('general.feature_disabled') }}</p>
            @endif
        </div>
    </div>

    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-3 control-label">{{ trans('general.new_password') }}</label>
        <div class="col-md-5 required">
            <input class="form-control" type="password" name="password" id="password" {{ (config('app.lock_passwords') ? ' disabled' : '') }} onKeyUp="checkPasswordMatch();">
            {!! $errors->first('password', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
            @if (config('app.lock_passwords')===true)
                <p class="text-warning"><i class="fas fa-lock"></i> {{ trans('general.feature_disabled') }}</p>
            @endif
        </div>
    </div>


    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <label for="password_confirmation" class="col-md-3 control-label">{{ trans('general.new_password') }}</label>
        <div class="col-md-5 required">
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"  {{ (config('app.lock_passwords') ? ' disabled' : '') }} aria-label="password_confirmation" onKeyUp="checkPasswordMatch();">
            {!! $errors->first('password_confirmation', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
            @if (config('app.lock_passwords')===true)
                <p class="text-warning"><i class="fas fa-lock"></i> {{ trans('general.feature_disabled') }}</p>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"></label>
        <div class="col-md-5 registrationFormAlert" >
            <p style="color:darkgreen;" id="divCheckPasswordMatch";></p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">Requirements</label>
        <div class="col-md-5">
            <ul class="list-group">
                <li class="list-group-item">
                    Require at least {{ $snipeSettings->pwd_secure_min }} characters
                </li>
                @if (strpos($snipeSettings->pwd_secure_complexity, 'fields') !== FALSE)
                    <li class="list-group-item">
                        Password cannot be the same as first name, last name, email, or username
                    </li>
                @endif
                @if (strpos($snipeSettings->pwd_secure_complexity, 'letters') !== FALSE)
                    <li class="list-group-item">
                        Require at least one letter
                    </li>
                @endif
                @if (strpos($snipeSettings->pwd_secure_complexity, 'numbers') !== FALSE)
                    <li class="list-group-item">
                        Require at least one number
                    </li>
                @endif
                @if (strpos($snipeSettings->pwd_secure_complexity, 'symbols') !== FALSE)
                    <li class="list-group-item">
                        Require at least one symbol
                    </li>
                @endif
                @if (strpos($snipeSettings->pwd_secure_complexity, 'case_diff') !== FALSE)
                    <li class="list-group-item">
                        Require at least one uppercase and one lowercase
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <script type="text/javascript" >
    function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#password_confirmation").val();
        var regex;
        if (password == confirmPassword){
            document.getElementById("divCheckPasswordMatch").hidden = false;
            document.getElementById("divCheckPasswordMatch").style.color = "darkgreen";
            $("#divCheckPasswordMatch").html("&#9745; Passwords match");
        }
        if (password != confirmPassword){
            document.getElementById("divCheckPasswordMatch").hidden = false;
            document.getElementById("divCheckPasswordMatch").style.color = "darkred";
            $("#divCheckPasswordMatch").html("&#9746; Passwords dont match");
        }
        if(password == "" || confirmPassword == ""){
            document.getElementById("divCheckPasswordMatch").hidden = true;
        }
    }
    </script>


            </div> <!-- .box-body -->
            <div class="box-footer text-right">
                <a class="btn btn-link" href="{{ URL::previous() }}">{{ trans('button.cancel') }}</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check icon-white" aria-hidden="true"></i> {{ trans('general.save') }}</button>
            </div>

        </div> <!-- .box-default -->
        {{ Form::close() }}
    </div> <!-- .col-md-9 -->
</div> <!-- .row-->
@stop
