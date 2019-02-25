@extends('layouts.app')

@section('content')
    @if(Auth::user() != null)
    @foreach($users as $user)
        @if (Auth::user()->id != $user->id)
            This is not your profile
        @else
        <div class="update_profile">
            <h3>Please provide us your real informations.</h3>
            <br>
            @if(\Session::has('msg'))
                <p style="color: green">{!! \Session::get('msg') !!}</p>
            @endif
            <form action="{{action('ProfileController@update_profile')}}" method="post" id="profile">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                    <label for="firstname"><strong>Firstname</strong></label><br>
                    @if($user->firstname != null)
                        <input type="text" name="firstname" value="{{$user->firstname}}" required>
                    @else
                        <input type="text" name="firstname" required>
                    @endif
                    <br>

                    <label for="address"><strong>Address</strong></label><br>
                    @if($user->address != null)
                        <input type="text" name="address" value="{{$user->address}}" required>
                    @else
                        <input type="text" name="address" required>
                    @endif
                    <br>

                    <label for="phone"><strong>Phone Number</strong></label><br>
                    @if($user->phone_number != null)
                        <input type="text" name="phone" value="{{$user->phone_number}}" required>
                    @else
                        <input type="text" name="phone" required>
                    @endif
                    <br>

                    <label for="email"><strong>E-Mail</strong></label><br>
                    @if($user->email != null)
                        <input type="text" name="email" value="{{$user->email}}" required>
                    @else
                        <input type="text" name="email" required>
                    @endif
                    <br>
                <button type="submit">Update</button>
            </form>
            <a href="/profile/{{Auth::user()->id}}"><i class="fas fa-caret-left"></i> Back to your profile</a>
        </div>
        @endif
    @endforeach
    @else
        You're not connected !
    @endif
@endsection