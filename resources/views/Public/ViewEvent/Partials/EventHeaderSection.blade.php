@if(!$event->is_live)
<section id="goLiveBar">
    <div class="container">
                @if(!$event->is_live)
                O evento não está acessível publicamente - <a style="background-color: green; border-color: green;" class="btn btn-success btn-xs" href="{{route('MakeEventLive' , ['event_id' => $event->id])}}" >Publicar</a>
                @endif
    </div>
</section>
@endif
<section id="organiserHead" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div onclick="window.location='{{$event->event_url}}#organiser'" class="event_organizer">
                    <b>{{$event->organiser->name}}</b>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="intro" class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 property="name">{{$event->title}}</h1>
            <div class="event_venue">
                <span property="startDate" content="{{ $event->start_date->toIso8601String() }}">
                     @if($event->start_date->diffInHours($event->end_date) <= 12)
                        {{ $event->start_date->formatLocalized('%A %d %b %H:%M') }}
                     @elseif($event->start_date->diffInHours($event->end_date) > 2160)
                        {{ $event->start_date->format('Y') }}
                     @else
                        {{ $event->start_date->formatLocalized('%A %d %b %H:%M') }}
                     @endif
                </span>
                -
                <span property="endDate" content="{{ $event->end_date->toIso8601String() }}">
                     @if($event->start_date->diffInHours($event->end_date) <= 12)
                        {{ $event->end_date->format('H:i') }}
                     @elseif($event->start_date->diffInHours($event->end_date) > 2160)
                        {{ $event->end_date->format('Y') }}
                     @else
                        {{ $event->end_date->formatLocalized('%A %d %b %H:%M') }}
                     @endif
                </span>
             @if($event->venue_name != null && $event->venue_name != '' && $event->start_date->diffInHours($event->end_date) < 2160)
                @
                <span property="location" typeof="Place">
                    <b property="name">{{$event->venue_name}}</b>
                    <meta property="address" content="{{ urldecode($event->venue_name) }}">
                </span>
             @endif
            </div>

            <div class="event_buttons">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <a class="btn btn-event-link btn-lg" href="{{{$event->event_url}}}#details">INFORMAÇÃO</a>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <a class="btn btn-event-link btn-lg" href="{{{$event->event_url}}}#tickets">INSCRIÇÃO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
