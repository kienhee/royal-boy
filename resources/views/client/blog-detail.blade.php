@extends('layouts.client.index')
@section('content')
<section class="blog-hero spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9 text-center">
                <div class="blog__hero__text">
                    <h2>{{ $post->title }}</h2>
                    <ul>
                        <li>By {{ $post->user->full_name }}</li>
                        <li> {{ $post->created_at->format('M d, Y') }}</li>
                        <li>8 Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12">
                <div class="blog__details__pic">
                    <img src="{{ $post->cover }}" alt="{{ $post->title }}">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="blog__details__content">
                    <div class="blog__details__share">
                        <span>Chia sẻ</span>
                        <ul>
                            <li><a target="_blank" rel="nofollow" href="http://www.facebook.com/sharer.php?u={{ url()->current() }}"><i class="fa fa-facebook"></i></a></li>
                            <li><a target="_blank" rel="nofollow" href="http://twitter.com/share?url={{ url()->current() }}&text={{ $post->title }}" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a target="_blank" rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    {!! $post->content !!}
                    <div class="blog__details__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{ $post->user->avatar }}" alt="Author {{ $post->user->full_name }}">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h5>{{ $post->user->full_name }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">

                                <div class="blog__details__tags">
                                    @foreach (explode(',', $post->tags) as $tag)
                                    <a href="/tim-kiem?keyword={{ $tag }}">#{{ $tag }}</a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="blog__details__btns">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                @if ($previous)
                                <a href="{{ route('client.blog-detail', $previous->slug) }}" class="blog__details__btns__item">
                                    <p><span class="arrow_left"></span> Bài đọc trước</p>
                                    <h5>{{$previous->title}}</h5>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="blog__details__btns__item">
                                    <p><span class=""></span> Bạn đang đọc</p>
                                    <h5>{{$post->title}}</h5>
                                </a>
                                @endif

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                @if ($next)
                                <a href="{{ route('client.blog-detail', $next->slug) }}" class="blog__details__btns__item blog__details__btns__item--next">
                                    <p>Bài đọc tiếp <span class="arrow_right"></span></p>
                                    <h5>{{$next->title}}</h5>
                                </a>
                                @else
                                <a href="javascript:void(0)" class="blog__details__btns__item blog__details__btns__item--next">
                                    <p>Bạn đang đọc <span class=""></span></p>
                                    <h5>{{$post->title}}</h5>
                                </a>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="blog__details__comment">
                        <h4>Leave A Comment</h4>
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <input type="text" placeholder="Phone">
                                </div>
                                <div class="col-lg-12 text-center">
                                    <textarea placeholder="Comment"></textarea>
                                    <button type="submit" class="site-btn">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection