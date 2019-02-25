@extends('layouts.app')

@section('content')

    @foreach ($users as $user)
        @if (Auth::user() == null)
            Not connected
            @break
        @elseif ($user->id == Auth::user()->id && $user->admin == 1)
        <div class="addproduct">
            <h3><strong>Add a new product</strong></h3>
            <form action="{{action('AdminController@add_product')}}" method="POST" id="product">
                {{csrf_field()}}
                <table>
                    <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Price</th>
                        <th>Id_Category</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input class="put" type="text" name="picture" maxlength="255" required></td>
                        <td><input class="put" type="text" name="name" required/></td>
                        <td><textarea class="putdescription" name="description" required></textarea></td>
                        <td><input class="put" type="number" min="0" max="100" name="amount" required/></td>
                        <td><input class="put" type="number" min="0" max="2000" name="price" required/></td>
                        <td>
                            <select class="put" name="category">
                                <option value="Phones">Phones</option>
                                <option value="TVs">TVs</option>
                                <option value="Accessories">Accessories</option>
                            </select>
                        </td>

                        <td><button class="put" type="submit">Add product</button></td>

                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
            @break
        @endif
        @if ($user->id == Auth::user()->id)
            You are not an admin !
            @break
        @endif
    @endforeach

<div class="changeusersrights">
    <table class="info">
        <tr>
            <td><h3><strong>Change users' rights</strong></h3></td>
        </tr>
        <tr>
            <td>Name</td>
            <td>Right</td>
        </tr>
    @foreach($users as $user)
        @if (Auth::user() != null && Auth::user()->id != $user->id && Auth::user()->admin == 1)
        <center>
            <tr>
                <td>{{$user->name}}</td>
                @if($user->admin == 1)
                    <td>admin</td>
                @else
                    <td>user</td>
                @endif
                <td><button type="submit"><a href="/update/{{$user->admin}}/{{$user->id}}">Change rights</a></button></td>
            </tr>
        </center>
        @endif
    @endforeach
    </table>
    </div>

    @foreach($users as $user)
    @if (Auth::user() != null && Auth::user()->id == $user->id && Auth::user()->admin == 1)
    <table class="info">
        <tr>
            <td><h3><strong>Manage products</strong></h3></td>
        </tr>
        <tr class ="tr">
            <td>N °</td>
            <td>Name</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Description</td>
            <td>Update</td>
            <td>Delete</td>
        </tr>
    @foreach($product as $value)
        <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->price}}</td>
            <td>{{$value->quantity}}</td>
            <td>{{$value->description}}</td>
            <td><a href=""><i class="fas fa-edit" style="font-size: 25px"></i></a>
            </td>
            <td>
                <a href="/delete/{{$value->id}}"><i class="fas fa-trash-alt" style="font-size: 25px"></i></a>
            </td>
        </tr>
        @endforeach
    </table>


    @endif
    @endforeach
    <script>
     $ (document).ready(function() {
     $("#reload").on("click", function() {
        $("#stats").load(" #stats");
    });
  });
    </script>

    <div  id="stats">
      <div class="active">
        <?php $a = DB::select("SELECT count(*) as users FROM users");
        echo 'Le nombre d\'utilisateurs : '.$a[0]->users;
        ?>
      </div>

      <div class="active">
        <?php $a = DB::select("SELECT count(*) as orders FROM orders");
        echo 'Le nombre de commande : '.$a[0]->orders;
        ?>
      </div>

      <div class="bestorder">
        <?php $a = DB::select("SELECT max(total_price) as max FROM orders");
        echo 'La meilleure commande : '.$a[0]->max;
        ?>
      </div>

    </div>

    <center><button  id="reload">Change</button></center>
@endsection
