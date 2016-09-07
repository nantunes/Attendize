@extends('Shared.Layouts.MasterWithoutMenus')

@section('title')
Recuperar Password
@stop

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

           {!! Form::open(array('url' => route('postResetPassword'), 'class' => 'panel')) !!}

            <div class="panel-body">
                <div class="logo">
                   {!!HTML::image('assets/images/logo-dark.png')!!}
                </div>
                <h2>Recuperar Password</h2>
                @if (Session::has('status'))
                <div class="alert alert-info">
                    Foi enviada uma mensagem para o seu e-mail.
                </div>
                @else

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Ops!</strong> Há alguns problemas.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="form-group">
                    {!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'autofocus' => true]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Nova Password', ['class' => 'control-label']) !!}
                    {!! Form::password('password',  ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirmação da Password', ['class' => 'control-label']) !!}
                    {!! Form::password('password_confirmation',  ['class' => 'form-control']) !!}
                </div>
                {!! Form::hidden('token',  $token) !!}
                <div class="form-group nm">
                    <button type="submit" class="btn btn-block btn-success">Enviar</button>
                </div>
                <div class="signup">
                  <a class="semibold" href="{{route('login')}}">
                      <i class="ico ico-arrow-left"></i> Voltar
                  </a>
                </div>
            </div>
            {!! Form::close() !!}

            @endif
        </div>
    </div>
@stop