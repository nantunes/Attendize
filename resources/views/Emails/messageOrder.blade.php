@extends('Emails.Layouts.Master')

@section('message_content')

<p><b>{{{$event->organiser->name}}} - {{{$event->title}}}</b>:</p>
<p style="padding: 10px; margin:10px; border: 1px solid #f3f3f3;">
    {{nl2br($message_content)}}
</p>

@stop

@section('footer')

@stop
