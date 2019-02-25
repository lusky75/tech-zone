@extends('layouts.app')

@section('content')
    <?php $stars = 0 ?>
    @foreach($review as $star)
        <?php $stars += $star->stars?>
    @endforeach

    @if($count != 0)
    <?php $result = (int)$stars/$count ?>
    @endif
    @foreach($product as $value)
    <div>
        <div class="produit"><img class="image" src="{{$value->picture}}"></div>
        <div class="pageproduit">
            <div class="description">
                <label class="producttitle">{{$value->name}}</label>
                </br>
            <div class="review">
                <div class="reviewstars">
                @if($count != 0)
                @for($i = 0; $i < floor($result); $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @for($j = floor($result); $j < 5; $j++)
                        <i class="far fa-star"></i>
                    @endfor
                    @else
                    @for($k = 0; $k < 5; $k++)
                        <i class="far fa-star"></i>
                    @endfor
                    @endif

                </div>
                <a href="#reviewspart">See the users reviews</a>
            </div>
                </br>
                <p>Price : <span class="prix">{{$value->price}},00 $</span></p>
                    @if ($value->quantity === 0)
                    <span class="notinstock"><i class="far fa-times-circle"></i> Out of Stock</span>
                    @else
                    <span class="stock"><i class="fas fa-check-circle"></i> In Stock</span>
                    @endif
                <div class="descproduit">
                    {{$value->description}}
                </div>
            </div>
        </div>
        @if(Auth::user() != null)
        <div class="cart">
            <label>Quantity</label>
            <form action="{{action('ProductController@buy_product')}}" method="post" id="product">
                {{ csrf_field() }}
                <input type="hidden" name="quantity" value="{{$value->quantity}}">
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <input type="number" name="amount" min="0" max="10" value="1" required>
                <input type="hidden" name="id_product" value="{{$value->id}}">
                <button type="submit" class="enjoy-css">Add to Cart</button>
            </form>

            @if ($value->quantity <= 10)
            <span class="quantityremaining">Only {{$value->quantity}} remaining</span>
            @endif

            @if (Auth::user()->admin == 1)
                <p></p>
                <span class="quantityremaining">Quantity : {{$value->quantity}}</span>

            <form action="{{action('AdminController@update_quantity')}}" method="post" id="product">
                {{ csrf_field() }}
                <input type="hidden" name="id_product" value="{{$value->id}}">
                <input type="number" name="quantity" min="0" max="100" style="width:120px" required>
                <button type="submit">ok</button>
            </form>
            @endif
        </div>
        @endif
    </div>
    <br>
    <div>
        <div class="comments" id="reviewspart">
            <h3>Users reviews</h3>
            @if($review == null)
                No review for the moment.
            @else
            @foreach($review as $comment)
            <div class="reviewuser">
                <div class="userlogo">
                    @if ($comment->admin == 1)
                    <i class="fas fa-user-tie logouser"></i> <br><strong>{{$comment->name}}</strong>
                    @else
                    <i class="fas fa-user-circle logouser"></i> <br><strong>{{$comment->name}}</strong>
                    @endif
                </div>
                    <div class="reviewstars">
                        @for($i = 0; $i < $comment->stars; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @for($j = $comment->stars; $j < 5; $j++)
                            <i class="far fa-star"></i>
                        @endfor
                    </div>
                    <p>at {{$comment->created_at}}</p>
                    {{$comment->comment}}
                    @if(Auth::user() != null)
                    @if($comment->id_user == Auth::user()->id)
                    <a href="/update/{{$comment->id}}">supprimer</a>
                    @endif
                @endif
            </div>
            @endforeach
            @endif
            @if(Auth::user() != null)
            <div class="postreview">
                <label>Post your review for this product</label>
                <div class="reviewpost">
                    <form class="rating" action="{{action('ProductController@review')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id_product" value="{{$value->id}}">
                        <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
                        <fieldset id="rating">
      <label>
        <input type="radio" name="stars" value="1" required />
        <span class="icon">★</span>
      </label>
      <label>
        <input type="radio" name="stars" value="2" required />
        <span class="icon">★</span>
        <span class="icon">★</span>
      </label>
      <label>
        <input type="radio" name="stars" value="3" required />
        <span class="icon">★</span>
        <span class="icon">★</span>
        <span class="icon">★</span>
      </label>
      <label>
        <input type="radio" name="stars" value="4" required />
        <span class="icon">★</span>
        <span class="icon">★</span>
        <span class="icon">★</span>
        <span class="icon">★</span>
      </label>
      <label>
        <input type="radio" name="stars" value="5" required />
        <span class="icon">★</span>
        <span class="icon">★</span>
        <span class="icon">★</span>
        <span class="icon">★</span>
        <span class="icon">★</span>
      </label>
    </fieldset>

    <fieldset>
        <textarea id="reviewpost" name="comment" rows="4" cols="50" class="textarea" required>
              </textarea>
    </fieldset>
            <input type="submit" value="Submit" class="reviewbutton">
      </form>
    <br>
    <br>
          </div>
            </div>
            @else
            <div class="postreview">
                <label>You need to be connected to post a review.</label>
            </div>
    </div>
        @endif
    @endforeach


@endsection
