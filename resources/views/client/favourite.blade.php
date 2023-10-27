@extends('layouts.client.index')
@section('title', 'Favourites')
@section('content')
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>Favourites</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <ul class="filter__controls">
                    <li class="active" data-filter="*">All</li>
                    @foreach (getAllCategories() as $category)
                    @if ($category->category_id !=0)

                    <li data-filter=".{{$category->slug}}">{{$category->name}}</li>
                    @endif
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="row property__gallery" id="property__gallery">
            

        </div>
    </div>
</section>
@endsection