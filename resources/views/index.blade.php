@extends('master')

  @section('index', 'active')
  @section('content')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
      <div class="container-fluid">
        <div class="owl-banner owl-carousel">

        @if(isset($top_posts))
          @foreach ($top_posts as $post)
            <div class="item">
            <a href="/view/{{$post->id}}"><img src="{{ asset('storage/'.$post->image ?? '') }}" alt=""></a>
              <div class="item-content">
                <div class="main-content">
                  <div class="meta-category">              
                  </div>
                  <a href="/view/{{$post->id}}"><h5 style="color: white; font-style: italic;">{{ $post->title ?? ''}}</h5></a>
                  <ul class="post-info">
                    <!-- <li style="font-size: 14px;"><a  href="#">Admin</a></li> -->
                    <li style="color: white;">{{ $post->created_at->diffforHumans() ?? ''}}</li>
                    <li style="color: white;"> 
                            @if(count($post->comments) < 1)
                              {{count($post->comments)}} comment
                            @else
                              {{count($post->comments)}} comments
                            @endif
                            </li>
                  </ul>
                </div>
              </div>
            </div>
          @endforeach
        @endif 

        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->


    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">

              @if(isset($posts) && count($posts) >= 1)
                @foreach ($posts as $post)
                  <div class="col-lg-12">
                    <div class="blog-post">
                      <div class="blog-thumb">
                      <a href="/view/{{$post->id}}"><img src="{{ asset('storage/'.$post->image ?? '') }}"></a>
                      </div>
                      <div class="down-content">
                        @php
                          $tags = explode(",", $post->tags);
                        @endphp
                        <span style="font-size: 14px;">{{ $tags[0] ?? ''}}</span>
                        <a href="/view/{{$post->id}}"><h4>{{ $post->title ?? ''}}</h4></a>
                        <ul class="post-info">
                          <li><a href="/view/{{$post->id}}">Admin</a></li>
                          <li><a href="/view/{{$post->id}}">{{ $post->created_at->format('M d Y') ?? ''}}</a></li>
                          <li><a href="/view/{{$post->id}}">
                          @if(count($post->comments) < 1)
                              {{count($post->comments)}} comment
                            @else
                              {{count($post->comments)}} comments
                            @endif
                          </a></li>
                        </ul>
                        <p>{!! substr($post->description, 0, 300).'...' !!}</p>
                        <div class="post-options">
                          <div class="row">
                            <div class="col-6">
                              <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              @for($i = 0; $i < count($tags); $i++)
                                <li><a href="/search/{{$tags[$i]}}">{{$tags[$i]}}</a>@if($i < (count($tags) - 1 && !empty($tags[$i]))), @endif</li>
                              @endfor
                              </ul>
                            </div>
                            <div class="col-6">
                              <ul class="post-share">
                                <li><i class="fa fa-share-alt"></i></li>
                                <li><a href="">Facebook</a>,</li>
                                <li><a href=""> Twitter</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
                @else
                  <h4 style="margin: 0 auto;">No Post Found</h4>
              @endif   
                
                <div class="col-lg-12">
                  <div class="main-button">
                    <a href="/recent">View All Posts</a>
                  </div>
                </div>
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
                    <div class="sidebar-heading">
                      <h2>Recent Posts</h2>
                    </div>
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
                          @foreach($all_tags as $tags)
                            <li><a href="/search/{{$tags}}">{{ $tags }}</a></li>
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
    
    