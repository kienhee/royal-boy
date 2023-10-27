@extends('layouts.client.index')
@section('title', $post->title)
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="{{ route('client.blog') }}">Blog</a>
                        <span>{{ $post->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="blog__details__content">
                        <div class="blog__details__item">
                            <img src="{{ $post->cover }}" alt="{{ $post->title }}">
                            <div class="blog__details__item__title">
                                <h4>{{ $post->title }}</h4>
                                <ul>
                                    <li>by <span>{{ $post->user->full_name }}</span></li>
                                    <li>{{ $post->created_at->format('M d, Y') }}</li>
                                    <li>39 Comments</li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog__details__desc">
                            {!! $post->content !!}
                        </div>

                        <div class="blog__details__tags">
                            @foreach (explode(',', $post->tags) as $tag)
                                <a href="{{ $tag }}">#{{ $tag }}</a>
                            @endforeach
                        </div>
                        <div class="blog__details__btns">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    @if ($previous)
                                        <div class="blog__details__btn__item">
                                            <h6><a href="{{ route('client.blog-detail', $previous->slug) }}"><i
                                                        class="fa fa-angle-left"></i> Previous posts</a></h6>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    @if ($next)
                                        <div class="blog__details__btn__item blog__details__btn__item--next">

                                            <h6><a href="{{ route('client.blog-detail', $next->slug) }}">Next posts <i
                                                        class="fa fa-angle-right"></i></a></h6>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                        {{-- <div class="blog__details__comment">
                            <h5>3 Comment</h5>
                            <a href="#" class="leave-btn">Leave a comment</a>
                            <div class="blog__comment__item">
                                <div class="blog__comment__item__pic">
                                    <img src="{{ asset('client') }}/img/blog/details/comment-1.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                        mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog__comment__item blog__comment__item--reply">
                                <div class="blog__comment__item__pic">
                                    <img src="{{ asset('client') }}/img/blog/details/comment-2.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Consequat consetetur dissentiet, ceteros commune perpetua mei et. Simul viderer
                                        facilisis egimus ulla mcorper.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog__comment__item">
                                <div class="blog__comment__item__pic">
                                    <img src="{{ asset('client') }}/img/blog/details/comment-3.jpg" alt="">
                                </div>
                                <div class="blog__comment__item__text">
                                    <h6>Brandon Kelley</h6>
                                    <p>Duis voluptatum. Id vis consequat consetetur dissentiet, ceteros commune perpetua
                                        mei et. Simul viderer facilisis egimus tractatos splendi.</p>
                                    <ul>
                                        <li><i class="fa fa-clock-o"></i> Seb 17, 2019</li>
                                        <li><i class="fa fa-heart-o"></i> 12</li>
                                        <li><i class="fa fa-share"></i> 1</li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="blog__sidebar">
                        {{-- <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <ul>
                                <li><a href="#">All <span>(250)</span></a></li>
                                <li><a href="#">Fashion week <span>(80)</span></a></li>
                                <li><a href="#">Street style <span>(75)</span></a></li>
                                <li><a href="#">Lifestyle <span>(35)</span></a></li>
                                <li><a href="#">Beauty <span>(60)</span></a></li>
                            </ul>
                        </div> --}}
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Feature posts</h4>
                            </div>
                            @foreach ($relateds as $post)
                                <a href="{{ route('client.blog-detail', $post->slug) }}" class="blog__feature__item">
                                    <div class="blog__feature__item__pic">
                                        <img src="{{ $post->cover }}" width="110px" height="73px"
                                            style="object-fit: cover" alt="{{ $post->title }}">
                                    </div>
                                    <div class="blog__feature__item__text">
                                        <h6>{{ $post->title }}</h6>
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                    </div>
                                </a>
                            @endforeach


                        </div>
                        <div class="blog__sidebar__item">
                            <div class="section-title">
                                <h4>Tags cloud</h4>
                            </div>
                            <div class="blog__sidebar__tags">
                                @foreach ($tags as $tag)
                                    <a href="#">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endsection
