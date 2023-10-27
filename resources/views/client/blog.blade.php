@extends('layouts.client.index')
@section('title', 'Blog')
@section('content')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @if ($posts->count() > 0)
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic set-bg" data-setbg="{{ $post->cover }}">
                                </div>
                                <div class="blog__item__text">
                                    <h6><a href="{{ route('client.blog-detail', $post->slug) }}">{{ $post->title }}</a>
                                    </h6>
                                    <ul>
                                        <li>by <span>{{ $post->user->full_name }}</span></li>
                                        <li> {{ $post->created_at->format('M d, Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="col-lg-12 text-center">
                    <a href="#" class="primary-btn load-btn">Load more posts</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
