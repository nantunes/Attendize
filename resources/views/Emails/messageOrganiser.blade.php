@extends('Emails.Layouts.Master')

@section('message_content')

    <p>Recebeu uma mensagem de <b>{{$sender_name}}</b> em relação a <b>{{$event->title}}</b>.</p>
    <p style="padding: 10px; margin:10px; border: 1px solid #f3f3f3;">
       {!! nl2br($message_content) !!}
    </p>

    <p>
        Pode contactar <b>{{$sender_name}}</b> pelo endereço <a href='mailto:{{$sender_email}}}'>{{$sender_email}}</a>.
    </p>
@stop

@section('footer')


@stop
