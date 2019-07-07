@extends('layouts.app')

@section('page-header')
    <div class="page-header text-center">
        <div class="dark-overlay">
          <h2 class="text-center mb-0">Our Collections</h2>
        </div>
    </div>
@endsection
@section('content')
  {{-- Features --}}
  <div class="row align-items-center py-4" id="collections-feature">
    <div class="col-md-4">
      <div class="row ">
        <div class="col-md-3 px-0 text-right">
          <img src="{{asset('images/dress.png')}}" height="100">
        </div>
        <div class="col-md-9 text-left" >
          <p class="mb-0 collections-count counter-dresses">598</p>
          <p class="mb-0 collections-description text-uppercase">Dresses Rented</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row ">
        <div class="col-md-3 px-0 text-right">
          <img src="{{asset('images/heart.png')}}" height="80">
        </div>
        <div class="col-md-9 text-left" >
          <p class="mb-0 collections-count counter-clients">550</p>
          <p class="mb-0 collections-description text-uppercase">Satisfied Clients</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row ">
        <div class="col-md-3 px-0 text-right">
          <img src="{{asset('images/diamond.png')}}" height="80">
        </div>
        <div class="col-md-9 text-left" >
          <p class="mb-0 collections-count counter-arrivals">50</p>
          <p class="mb-0 collections-description text-uppercase">Arrivals every month</p>
        </div>
      </div>
    </div>
  </div>

  {{-- Main Content --}}
  <div class="row py-4" id="collectionsContent">
    {{-- Filter Section --}}
    <div class="col-md-3">
      <h3 class="mb-4 header-style">FILTERS <span class="float-right"><a href="/collections" class="btn">Clear</a></span></h3>

      <form action="/collections/search" method="GET" class="my-3">
        @csrf
        <input type="text" name="keyword" placeholder="Search an item..." class="form-control">
      </form>
      <h4 class="btn btn-block text-center btn-collections-filter" data-toggle="collapse" href="#multiCollapseExample1" role="button">Categories <i class="fas fa-caret-down"></i></h4>
      <ul class="list-unstyled list-group collapse multi-collapse" id="multiCollapseExample1">
            <li class="list-group-item"><a href="/collections">All</a></li>
        @foreach (\App\Category::all() as $category)
            <li class="list-group-item"><a href="/collections/filter/category/{{$category->id}}">{{$category->name}}</a></>
        @endforeach
      </ul>
    </div>

    {{-- Dress Section --}}
    <div class="col-md-9">
      <h3 class="mb-4 header-style">DRESSES</h3>
        <div class="row text-center">
          @foreach ($products as $product)
          <div class="col-md-4">
            <div class="card mb-3">
            <img src="/{{$product->img_path}}" class="card-img-top" height="250">
            <div class="card-body py-2">
              <a href="/collections/{{$product->id}}" class="card-title text-uppercase font-weight-bold">{{$product->name}}</a>
              <p class="card-text">&#8369; {{number_format($product->price)}}</p>
            </div>
            </div>
          </div>
          @endforeach
        </div>
    </div>
  </div>
@endsection
