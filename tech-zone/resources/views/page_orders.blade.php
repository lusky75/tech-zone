@extends('layouts.app')

@section('content')

    <table class="info">
        <tr class ="tr">
            <td>N °</td>
            <td>Content</td>
            <td>Date</td>
        </tr>

        @foreach($orders as $order)
        <tr>
            <td>{{$order->id}}</td>
            <td><a href="/orders/{{$order->id}}">Check the content</a></td>
            <td>{{$order->created_at}}</td>
        </tr>
        @endforeach

@endsection