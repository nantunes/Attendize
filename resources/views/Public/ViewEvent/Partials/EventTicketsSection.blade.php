@php
$direct = true;
foreach($tickets as $ticket) {
    if($ticket->min_per_person != $ticket->max_per_person) {
        $direct = false;
        break;
    }
}
@endphp
<section id="tickets" class="container">
@if(!$direct)
    <div class="row">
        <h1 class='section_head'>
            Inscrição
        </h1>
    </div>
@endif

    @if($event->start_date->isPast())
    <div class="alert alert-boring">
        Inscrições encerradas.
    </div>
    @else

    @if($tickets->count() > 0)

    {!! Form::open(['url' => route('postValidateTickets', ['event_id' => $event->id]), 'class' => 'ajax']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="content">
                <div class="tickets_table_wrap">
@if(!$direct)
                    <table class="table">
@else
                    <table class="table" style="margin-bottom: 0;">
@endif
                        <?php
                         $is_free_event = true;
                        ?>
                        @foreach($tickets as $ticket)
@if(!$direct)
                        <tr class="ticket" property="offers" typeof="Offer">
@else
                        <tr class="ticket" property="offers" typeof="Offer" style="display: none;">
@endif
                            <td>
                                <span class="ticket-title semibold" property="name">
                                    {{$ticket->title}}
                                </span>
                                <p class="ticket-descripton mb0 text-muted" property="description">
                                    {{$ticket->description}}
                                </p>
                            </td>
                            <td style="width:180px; text-align: right;">
                                <div class="ticket-pricing" style="margin-right: 20px;">
                                    @if($ticket->is_free)
                                    <meta property="price" content="0">
                                    @else
                                        <?php
                                        $is_free_event = false;
                                        ?>
                                    <span title='{{money($ticket->price, $event->currency)}} + {{money($ticket->total_booking_fee, $event->currency)}} taxas'>{{money($ticket->total_price, $event->currency)}} </span>
                                    <meta property="priceCurrency" content="{{ $event->currency->code }}">
                                    <meta property="price" content="{{ number_format($ticket->price, 2, '.', '') }}">
                                    @endif
                                </div>
                            </td>
                            <td style="width:85px;">
                                @if($ticket->is_paused)

                                <span class="text-danger">
                                    Inscrições suspensas
                                </span>

                                @else

                                @if($ticket->sale_status === config('attendize.ticket_status_sold_out'))
                                <span class="text-danger" property="availability" content="http://schema.org/SoldOut">
                                    Esgotado
                                </span>
                                @elseif($ticket->sale_status === config('attendize.ticket_status_before_sale_date'))
                                <span class="text-danger">
                                    Inscrições por abrir
                                </span>
                                @elseif($ticket->sale_status === config('attendize.ticket_status_after_sale_date'))
                                <span class="text-danger">
                                    Inscrições fechadas
                                </span>
                                @else
                               {!! Form::hidden('tickets[]', $ticket->id) !!}
                                <meta property="availability" content="http://schema.org/InStock">
                                <select name="ticket_{{$ticket->id}}" class="form-control" style="text-align: center">
                                    @if ($tickets->count() > 1)
                                    <option value="0">0</option>
                                    @endif
                                    @for($i=$ticket->min_per_person; $i<=$ticket->max_per_person; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                @endif

                                @endif
                            </td>
                        </tr>
                        @endforeach

                        <tr class="checkout">
@if(!$direct)
                            <td colspan="3">
@else
                            <td colspan="3" style="padding: 0; border: 0;">
@endif
                                @if(!$is_free_event)
                                    <div class="hidden-xs pull-left">
                                    <img class="" src="{{asset('assets/images/public/EventPage/credit-card-logos.png')}}" />
                                    @if($event->enable_offline_payments)

                                    <div class="help-block" style="font-size: 11px;">
                                        Disponível pagamento offline
                                    </div>
                                    @endif

                                    </div>

                                @endif
                                {!!Form::submit('Inscrever', ['class' => 'btn btn-lg btn-primary pull-right'])!!}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
   {!! Form::hidden('is_embedded', $is_embedded) !!}
   {!! Form::close() !!}

    @else

    <div class="alert alert-boring">
        Inscrição não disponível.
    </div>

    @endif

    @endif

</section>