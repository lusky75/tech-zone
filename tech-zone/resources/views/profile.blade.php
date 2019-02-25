@extends('layouts.app')

@section('content')
	@if(Auth::user() != null)
    @foreach ($users as $user)
		@if (Auth::user()->id != $user->id)
			This is not your profile
		@else
	<div class="userinfos">
    	<h3>Update your informations</h3>
	    <table style="margin-left:auto; margin-right:auto;">
	    	<tr>
		    	<td><strong>Name</strong></td>
		    	<td>{{$user->name}}</td>
	    	</tr>
	    	<tr>
		    	<td><strong>Firstname</strong></td>
		    	@if ($user->firstname == null)

		    	<td><a href="/update_profile/{{Auth::user()->id}}">Add your lastname</a></td>
		    	@else
		    	<td><a href="/update_profile/{{Auth::user()->id}}">{{$user->firstname}}</a></td>
		    	@endif
	    	</tr>
	    	<tr>
		    	<td><strong>Address</strong></td>
		    	@if ($user->address == null)

                    <td><a href="/update_profile/{{Auth::user()->id}}">Add your Address</a></td>
		    	@else
		    	<td><a href="/update_profile/{{Auth::user()->id}}">{{$user->address}}</a></td>
		    	@endif
	    	</tr>
	    	<tr>
		    	<td><strong>Phone Number</strong></td>
		    	@if ($user->phone_number == null)
		    	<td><a href="/update_profile/{{Auth::user()->id}}">Add your Phone Number</a></td>
		    	@else
		    	<td><a href="/update_profile/{{Auth::user()->id}}">{{$user->phone_number}}</a></td>
		    	@endif
	    	</tr>
	    	<tr>
		    	<td><strong>Email</strong></td>
		    	<td><a href="/update_profile/{{Auth::user()->id}}">{{$user->email}}</a></td>
	    	</tr>
	    </table>
	</div><br>

	<div class="userinfos">
    	<h3>Update your payment methods</h3>
	    <table style="margin-left:auto; margin-right:auto;">
	    	<tr>
		    	<td><strong>Paypal</strong></td>
		    	@if ($user->firstname == null)
		    	<td><a href="">Add a Paypal account</a></td>
		    	@else
		    	<td><a href="">$user->firstname</a></td>
		    	@endif
	    	</tr>
	    	<tr>
		    	<td><strong>Credit Card</strong></td>
		    	@if ($user->firstname == null)
		    	<td><a href="">Add a credit card</a></td>
		    	@else
		    	<td><a href="">$user->firstname</a></td>
		    	@endif
	    	</tr>
	    	<tr>
		    	<td><strong>Credit Card 2</strong></td>
		    	@if ($user->firstname == null)
		    	<td><a href="">Add a credit card</a></td>
		    	@else
		    	<td><a href="">$user->firstname</a></td>
		    	@endif
	    	</tr>
	    </table>
	</div>
		@endif
    @endforeach
	@else
		You're not connected !
	@endif
@endsection