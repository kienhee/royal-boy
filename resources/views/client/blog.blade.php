@extends('layouts.client.index')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-blog set-bg" data-setbg="{{ asset('client') }}/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Our Blog</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            @if ($posts->count() > 0)
            @foreach ($posts as $item)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{ $item->cover }}">
                    </div>
                    <div class="blog__item__text">
                        <span><img src="{{ asset('client') }}/img/icon/calendar.png" alt="">
                            {{ $item->created_at->format('d M Y') }}</span>
                        <h5>{{ $item->title }}</h5>
                        <a href="{{ route('client.blog-detail', $item->slug) }}">Đọc thêm</a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12">

                <h3 class="text-center">Không tìm thấy bài viết!</h3>
            </div>
            @endif
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>

    </div>
</section>
<!-- Blog Section End -->
@endsection