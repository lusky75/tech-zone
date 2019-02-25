@extends('layouts.app')

@section('content')
    @if (Auth::user() != null)
        <?php $number = 1 ?>
        <?php $total = 0 ?>
        <label id="display"></label>
        <div class="panier" onload="update()">

            <div class="top"><h1 class="title">Your cart</h1></div>
            <table class="cartinfos" id="info">
              <tr class="tr">
                  <td id="">N °</td>
                  <td id="">Picture</td>
                  <td id="">Product</td>
                  <td id="">Price</td>
                  <td id="">Quantity</td>
              </tr>
                <script>
                      $( document ).ready(function() {
                          display();
                      });
                </script>
            </table>
        </div>

        <div class="pay" id="pay">
            <h1>Total :</h1>
            <label for="text" id="total" value=0></label>
            <br><br>
            <script>
            $ (document).ready(function (){
                update();
                createButton();
              });

            </script>

            <div></div>
            <br>
        </div>

    @endif
@endsection
