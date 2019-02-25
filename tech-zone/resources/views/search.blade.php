@extends('layouts.app')

@section('content')
    <div id="sidebar" class="sidebar">
        @include('includes.sidebar')
    </div>

        <div class="searchresult">
        <p>Results for
            <span class="searchresultblue">"<?php 
            if ($_POST['name'] != null) 
            echo $_POST['name'];
        ?>"</span></p>
        </div>
    @foreach($product as $value)
        <div class ="line">
            <div class="bloc">
                <a href=""><img class="img" src="{{$value->picture}}"></a>
                <div class="producttitle">{{$value->name}}</div>
                @if ($value->quantity === 0)
                    <button class="button-achat">Out of stock</button>
                @else
                    @guest
                        <a href="/login/"><button class="button-achat">Buy immediatly</button></a>
                    @endguest
                    @auth
                        <a href="/update/{{$value->quantity}}/{{$value->id}}">
                            <button class="button-achat">Buy immediatly</button></a>
                    @endauth
                @endif
                <button class="button"><a href="/product/{{$value->id}}">Quick check</a></button>
            </div>
        </div>
    @endforeach
@endsection