@extends('Emails.Layouts.Master')

@section('message_content')

Há uma nova inscrição em <b>{{$order->event->title}}</b>.<br><br>

@if(!$order->is_payment_received)
    <b>Pagamento pendente.</b>
    <br><br>
@endif


Referência: <b>{{$order->order_reference}}</b><br>
Nome: <b>{{$order->full_name}}</b><br>
Data: <b>{{$order->created_at->toDayDateTimeString()}}</b><br>
E-mail: <b>{{$order->email}}</b><br>


<h3>Inscrições</h3>
<div style="padding:10px; background: #F9F9F9; border: 1px solid #f1f1f1;">

    <table style="width:100%; margin:10px;">
        <tr>
            <th>
                Tipo
            </th>
            <th>
                Quantidade
            </th>
            <th>
                Preço
            </th>
            <th>
                Taxas
            </th>
            <th>
                Total
            </th>
        </tr>
        @foreach($order->orderItems as $order_item)
        <tr>
            <td>
                {{$order_item->title}}
            </td>
            <td>
                {{$order_item->quantity}}
            </td>
            <td>
                @if((int)ceil($order_item->unit_price) == 0)
                --
                @else
                {{money($order_item->unit_price, $order->event->currency)}}
                @endif

            </td>
            <td>
                @if((int)ceil($order_item->unit_price) == 0)
                --
                @else
                {{money($order_item->unit_booking_fee, $order->event->currency)}}
                @endif

            </td>
            <td>
                @if((int)ceil($order_item->unit_price) == 0)
                --
                @else
                {{money(($order_item->unit_price + $order_item->unit_booking_fee) * ($order_item->quantity), $order->event->currency)}}
                @endif

            </td>
        </tr>
        @endforeach
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
                {{money($order->total_amount, $order->event->currency)}}
            </td>
        </tr>
    </table>


    <br><br>
    Pode gerir a inscrição em: {{route('showEventOrders', ['event_id' => $order->event->id, 'q'=>$order->order_reference])}}
    <br><br>
</div>

@stop
