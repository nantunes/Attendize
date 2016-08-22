@extends('Emails.Layouts.Master')

@section('message_content')

A sua inscrição em <b>{{$order->event->title}}</b> foi efectuada.<br><br>

Pode consultar os detalhes da inscrição em: {{route('showOrderDetails', ['order_reference' => $order->order_reference])}}

<h3>Detalhes</h3>
Referência: <b>{{$order->order_reference}}</b><br>
Nome: <b>{{$order->full_name}}</b><br>
Data: <b>{{$order->created_at->toDayDateTimeString()}}</b><br>
E-mail: <b>{{$order->email}}</b><br>

<h3>Inscrições</h3>
<div style="padding:10px; background: #F9F9F9; border: 1px solid #f1f1f1;">
    <table style="width:100%; margin:10px;">
        <tr>
            <td>
                <b>Tipo</b>
            </td>
            <td>
                <b>Quantidade</b>
            </td>
@if((int)ceil($order->amount) > 0)
            <td>
                <b>Preço</b>
            </td>
            <td>
                <b>Taxas</b>
            </td>
            <td>
                <b>Total</b>
            </td>
@endif
        </tr>
        @foreach($order->orderItems as $order_item)
                                <tr>
                                    <td>
                                        {{$order_item->title}}
                                    </td>
                                    <td>
                                        {{$order_item->quantity}}
                                    </td>
@if((int)ceil($order_item->unit_price) > 0)
                                    <td>
                                       {{money($order_item->unit_price, $order->event->currency)}}
                                    </td>
                                    <td>
                                        {{money($order_item->unit_booking_fee, $order->event->currency)}}
                                    </td>
                                    <td>
                                        {{money(($order_item->unit_price + $order_item->unit_booking_fee) * ($order_item->quantity), $order->event->currency)}}
                                    </td>
@endif
                                </tr>
                                @endforeach
@if((int)ceil($order->amount) > 0)
        <tr>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
                <b>Total</b>
            </td>
            <td colspan="2">
               {{money($order->amount + $order->order_fee, $order->event->currency)}}
            </td>
        </tr>
@endif
    </table>

    <br><br>
</div>

@stop
