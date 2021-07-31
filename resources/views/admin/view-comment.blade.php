@extends('admin.master')
    @section('comments', 'active')
    @section('content')

    <div class="content">
        <div class="py-4 px-3 px-md-4">
            <div class="card mb-3 mb-md-4">

                <div class="card-body">
                    <!-- Breadcrumb -->
                    <nav class="d-none d-md-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Comments</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">View Comment</li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->

                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">Comment</div>
                    </div>


                    <!-- Form -->
                    <div>
                        
                        	<div style="margin-bottom: 10px;" class="form-row">
                                <label for="name">Name</label>
                                <input readonly="true" type="text" class="form-control" value="{{$comment->name ?? ''}}" id="name" placeholder="">
                            </div>
                            <div style="margin-bottom: 10px;" class="form-row">                 
                                <label for="comment">Comment</label>
                                <textarea readonly="true" rows="5" type="text" class="form-control" value="" id="comment" placeholder="">{{$comment->comment ?? ''}}</textarea>
                            </div>
                            <div style="margin-bottom: 10px;" class="form-row">
                                <label for="location">Location</label>
                                <input readonly="true" type="text" class="form-control" value="{{$comment->location ?? ''}}" id="location" placeholder="">
                            </div>
                            @if($comment->publish == "false")
                                <a href="/admin/publish/{{$comment->id}}"><button style="margin-left: 10px; background-color: green; border-color: green;"  class="btn btn-primary float-right">Publish</button></a>
                            @endif    
                            <a href="/admin/delete-comment/{{$comment->id}}"><button style="margin-left: 10px; background-color: red; border-color: red;"  class="btn btn-primary float-right">Delete</button></a>
                            <a href="/admin/view-post/{{$comment->post_id}}"><button class="btn btn-primary float-right">View Post</button></a>
                            @if(isset($msg))
                                <span >
                                    <p style="color: red; text-align: center;">{{ $msg }}</p>
                                </span>
                            @endif   
                    </div>
                    <!-- End Form -->
                </div>
            </div>


        </div>

        @endsection