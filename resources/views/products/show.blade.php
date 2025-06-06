@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
   <div class="row w-75">
       <div class="col-5 offset-1">
           <img src="{{ asset('img/dummy.png')}}" class="w-100 img-fluid">
       </div>
       <div class="col">
           <div class="d-flex flex-column">
               <h1 class="">
                   {{$product->name}}
               </h1>
               <p class="">
                   {{$product->description}}
               </p>
               <hr>
               <p class="d-flex align-items-end">
                   ￥{{$product->price}}(税込)
               </p>
               <hr>
           </div>
           @auth
           <form method="POST" class="m-3 align-items-end">
               @csrf
               <input type="hidden" name="id" value="{{$product->id}}">
               <input type="hidden" name="name" value="{{$product->name}}">
               <input type="hidden" name="price" value="{{$product->price}}">
               <div class="form-group row">
                   <label for="quantity" class="col-sm-2 col-form-label">数量</label>
                   <div class="col-sm-10">
                       <input type="number" id="quantity" name="qty" min="1" value="1" class="form-control w-25">
                   </div>
               </div>
               <input type="hidden" name="weight" value="0">
               <div class="row">
                   <div class="col-7">
                       <button type="submit" class="btn samuraimart-submit-button w-100">
                           <i class="fas fa-shopping-cart"></i>
                           カートに追加
                       </button>
                   </div>
                   <div class="col-5">
                        @if (Auth::user()->favorite_products()->where('product_id', $product->id)->exists())
                            <a href="{{ route('favorites.destroy', $product->id) }}" class="btn samuraimart-favorite-button text-dark w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                                <i class="fa fa-heart"></i>
                                お気に入り解除
                            </a>
                        @else
                            <a href="{{ route('favorites.store', $product->id) }}" class="btn samuraimart-favorite-button text-dark w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                                <i class="fa fa-heart"></i>
                                お気に入り
                            </a>
                        @endif
                   </div>
               </div>
           </form>
           <form action="{{ route('favorites.destroy', $product->id) }}" id="favorites-destroy-form" method="post" class="d-none">
                @csrf
                @method('delete')
           </form>
           <form action="{{ route('favorites.store', $product->id) }}" id="favorites-store-form" method="post" class="d-none">
                @csrf
           </form>
           @endauth
       </div>

       <div class="offset-1 col-11">
           <hr class="w-100">
           <h3 class="float-left">カスタマーレビュー</h3>
       </div>

       <div class="offset-1 col-10">
           <div class="row">
                @foreach ($reviews->all() as $review)
                    <div>
                        <p class="h3">{{ $review->content }}</p>
                        <label for="">{{ $review->created_at }} {{ $review->user->name }}</label>
                    </div>
                @endforeach
           </div><br />

           @auth
           <div class="row">
                <div class="offset-md-5 col-md-5">
                    <form action="{{ route('reviews.store') }}" method="post">
                        @csrf
                        <h4>レビュー内容</h4>
                        @error('content')
                            <strong>レビュー内容を入力してください</strong>
                        @enderror
                        <textarea name="content" id="" class="form-control m-2"></textarea>
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn samuraimart-submit-button ml-2">レビューを追加</button>
                    </form>
                </div>
           </div>
           @endauth
       </div>
   </div>
</div>
@endsection