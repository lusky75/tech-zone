@extends('layouts.app')

@section('content')
    <div id="sidebar" class="sidebar">
        @include('includes.sidebar')
    </div>

    @foreach($product as $value)
        <div class ="line">
            <div class="bloc">
                <a href="/product/{{$value->id}}"><img class="img" src="{{$value->picture}}"></a>
                <div class="producttitle">{{$value->name}}</div>
                <div class="productprice"><strong>{{$value->price}},00 $</strong></div>
                @if ($value->quantity === 0)
                    <button class="button-achat">Out of stock</button>
                @else
                    @guest
                        <a href="/login/"><button class="button-achat">Buy immediatly</button></a>
                    @endguest
                    @auth
                        <?php $number = 1 ?>

                        <button onclick="buyimmediatly('{{$value->picture}}',{{$value->id}}, '{{$value->name}}', {{Auth::user()->id}}, {{$value->price}}, {{$number}})" class="button-achat">Buy immediatly</button>

                    @endauth
                @endif
                <button class="button"><a href="/product/{{$value->id}}">Quick check</a></button>
            </div>
        </div>
    @endforeach
@endsection
