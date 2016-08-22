@extends('Emails.Layouts.Master')

@section('message_content')

<p>
    A sua inscrição para <b>{{{$attendee->event->title}}}</b> foi cancelada.
</p>

<p>
    Pode contactar <b>{{{$attendee->event->organiser->name}}}</b> em <a href='mailto:{{{$attendee->event->organiser->email}}}'>{{{$attendee->event->organiser->email}}}</a>.
</p>
@stop

@section('footer')

@stop
