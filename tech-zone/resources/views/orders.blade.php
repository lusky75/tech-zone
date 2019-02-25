@extends('layouts.app')

@section('content')
    @if (Auth::user() != null)
    <?php $number = 1 ?>
        <table class="info">
            <tr class ="tr">
                <td>N °</td>
                <td>Picture</td>
                <td>Product</td>
                <td>Quantity</td>
                <td>Price</td>
            </tr>

            @foreach($products as $product)
            <tr>
                <td>{{$number}}</td>
                <td><img src="{{$product[0]->picture}}" class="panierimg"></td>
                <td>{{$product[0]->name}}</td>
                <td>{{$quantity[$number - 1]}}</td>
                <td><span style="color:#960023">{{$product[0]->price}},00 $</span></td>
            </tr>
                <?php $number++ ?>
            @endforeach
            </table>
            <br>
            <table class="info">
            <tr>
                <td>Date</td>
                <td>{{$date}}</td>
                <td>-</td>
                <td>Total :</td>
                <td><span style="color:#960023">{{$total_price}},00 $</span></td>
            </tr>
        </table>
            <a href="/page_orders/{{Auth::user()->id}}" style="margin-left:25%;"><i class="fas fa-caret-left"></i> Back to your orders</a>
    @else
        You're not connected !
    @endif
@endsection