@extends('master')

  @section($active, 'active')
  @section('content')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>{{$active}} Posts</h4>
                <h2>Our {{$active}} Blog Entries</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                @if(isset($posts) && count($posts) >= 1)
                  @foreach ($posts as $post)
                    <div class="col-lg-6">
                      <div class="blog-post">
                        <div class="blog-thumb">
                          <a href="/view/{{$post->id}}"><img src="{{ asset('storage/'.$post->image ?? '') }}" alt=""></a>
                        </div>
                        <div class="down-content">
                          @php
                            $tags = explode(",", $post->tags);
                          @endphp
                          <span style="font-size: 14px;">{{ $tags[0] ?? ''}}</span>
                          <a href="/view/{{$post->id}}"><h4>{{ $post->title ?? ''}}</h4></a>
                          <ul class="post-info">
                            <li><a href="/view/{{$post->id}}"><strong>Blog by: </strong>Topon Sharma</a></li>
                            <li><a href="/view/{{$post->id}}">{{ $post->created_at->format('M d Y') ?? ''}}</a></li>
                          </ul>
                          <p>
                          @if(strlen($post->description) > 200)
                            {!! substr($post->description, 0 , 200) !!}.....
                          @else
                            {!! $post->description !!}
                          @endif 
                          </p>
                          <div class="post-options">
                            <div class="row">
                              <div class="col-lg-12">
                                <ul class="post-tags">
                                  <li><i class="fa fa-tags"></i></li>
                                  @for($i = 0; $i < count($tags); $i++)
                                    <li><a href="/search/{{$tags[$i]}}">{{$tags[$i]}}</a>@if($i < (count($tags) - 1 && !empty($tags[$i]))), @endif</li>
                                  @endfor
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @else
                  <h4>No Post Found</h4>
                @endif
                
                <!-- <div class="col-lg-12">
                  <ul class="page-numbers">
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                  </ul>
                </div> -->
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                <div class="col-lg-12">
                  <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="/search">
                      <input type="text" name="search" class="searchText" placeholder="type to search..." autocomplete="on">
                    </form>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item recent-posts">
                    <!-- <div class="sidebar-heading">
                      <h2>Recent Posts</h2>
                    </div> -->
                    <div class="content">
                      <ul>
                        @if(isset($similiar_posts))
                          @foreach($similiar_posts as $post)
                            <li><a href="/view/{{$post->id}}">
                              <h6 style="color: #f48840; font-weight: bold;">{{ $post->title}}</h6>
                              <span>{{ $post->created_at->diffforHumans() ?? ''}}</span>
                            </a></li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-lg-12">
                  <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                      <h2>Categories</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <li><a href="#">- Nature Lifestyle</a></li>
                        <li><a href="#">- Awesome Layouts</a></li>
                        <li><a href="#">- Creative Ideas</a></li>
                        <li><a href="#">- Responsive Templates</a></li>
                        <li><a href="#">- HTML5 / CSS3 Templates</a></li>
                        <li><a href="#">- Creative &amp; Unique</a></li>
                      </ul>
                    </div>
                  </div>
                </div> -->
                <div class="col-lg-12">
                  <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                      <h2>Tag Clouds</h2>
                    </div>
                    <div class="content">
                      <ul>
                        @if(isset($all_tags))
                          @foreach($all_tags as $tag)
                            <li><a href="/search/{{$tag}}">{{ $tag }}</a></li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endsection
    
    