@extends('master')

  @section('post-details', 'active')
  @section('content')

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>Blog Details</h4>
                <h2>{{$post->title}}</h2>
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
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="{{ asset('storage/'.$post->image ?? '') }}" alt="">
                      <p style="text-align: center; font-size: 12px;">picture: {{$post->img_desc ?? ''}}</p>
                    </div>
                    <div class="down-content">
                        @php
                          $tags = explode(",", $post->tags);
                        @endphp
                        <span style="font-size: 14px;">{{ $tags[0] ?? ''}}</span>
                      <a href="/view/{{$post->id}}"><h4>{{ $post->title ?? ''}}</h4></a>
                      <ul class="post-info">
                        <li><a href="/view/{{$post->id}}"><strong>Blog By: </strong>Topon Sharma</a></li>
                        <li><a href="/view/{{$post->id}}">{{ $post->created_at->format('M d Y') ?? ''}}</a></li>
                      </ul>
                      <p>{!! $post->description ?? '' !!}</p>
                      <div class="post-options">
                        <div class="row">
                          <div class="col-6">
                            <ul class="post-tags">
                              <li><i class="fa fa-tags"></i></li>
                              @for($i = 0; $i < count($tags); $i++)
                                <li><a href="/search/{{$tags[$i]}}">
                                  {{$tags[$i]}}</a>@if($i < (count($tags) - 1 && !empty($tags[$i]))), @endif
                                </li>
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
                <div class="col-lg-12">
                  <div class="sidebar-item comments">
                    <div class="sidebar-heading">
                    </div>
                    <div class="content">
                      <ul>
                          @foreach($post->comments as $comment)
                            @if($comment->publish == "true")
                            <li>
                              <div class="author-thumb">
                                <img src="{{ asset('assets/images/comment-author-02.jpg') }}" alt="">
                              </div>
                              <div class="right-content">
                                <h4>{{$comment->name ?? ''}}<span>{{$comment->created_at->format('M d Y') ?? ''}}</span></h4>
                                <p>{{$comment->comment ?? ''}}</p>
                              </div>
                              
                            </li>
                            @endif
                          @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item submit-comment">
                    <div class="sidebar-heading">
                      <h2>Your comment</h2>
                    </div>
                    <div class="content">
                      <form id="comment-form">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="name" type="text" id="name" placeholder="Your name" required="">
                            </fieldset>
                          </div>
                          <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="location" type="email" id="location" placeholder="Your email"  required="">
                            </fieldset>
                          </div>
                          <input type="hidden" name="post_title" id="post_title" value="{{$post->title}}">
                          <div class="col-lg-12">
                            <fieldset>
                              <textarea name="comment" rows="6" id="comment" placeholder="Type your comment" required=""></textarea>
                            </fieldset>
                          </div>
                          {{ csrf_field()}}
                          <div class="col-lg-12">
                            <fieldset>
                              <button style="width: 100%;" type="submit" class="main-button">Submit</button>
                            </fieldset>
                            <p id="success-message" style="color: green; margin-top: 5px;"></p>
                            <p id="error-message" style="color: red; margin-top: 5px;"></p>
                          </div>
                        </div>
                        
                      </form>
                    </div>
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
                      <h2>Similiar Posts</h2>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script type="text/javascript">
      $('#comment-form').on('submit', function(e){
        e.preventDefault();
        $('#success-message').text("Loading.....");
        $('#error-message').text(" ");
        var name = $('#name').val();
        var comment = $('#comment').val();
        var location = $('#location').val();
        var post_id = $('#post_id').val();
        var post_title = $('#post_title').val();

        $.ajax({
          url: "/comment",
          type: "POST",
          data:{
            "_token": "{{ csrf_token() }}",
            name: name,
            comment: comment,
            location: location,
            post_id: post_id,
            post_title: post_title
          },
          success: function(response){
            console.log(response);
            if(response.success) {
              $('#success-message').text(response.success);
				    }else{
              $('#error-message').text(response.error);
              $('#success-message').text("");
            }
          },
          error: function(response) {
            $('#error-message').text(response);
            $('#success-message').text("");
          }
        });
      });
    </script>

    
  @endsection