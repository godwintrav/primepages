@extends('admin.master')

    @section('comments', 'active')
    @section('content')

    <div class="content">
        <div class="py-4 px-3 px-md-4">

            <div class="mb-3 mb-md-4 d-flex justify-content-between">
                <div class="h3 mb-0">Comments</div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-3 mb-md-4">
                        <div class="card-header">
                            <h5 class="font-weight-semi-bold mb-0">Recent Comments</h5>
                        </div>

                        <div class="card-body pt-0">
                            <div class="table-responsive-xl">
                                <table class="table text-nowrap mb-0">
                                    <thead>
                                    <tr>
                                        <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                        <th class="font-weight-semi-bold border-top-0 py-2">Name</th>
                                        <th class="font-weight-semi-bold border-top-0 py-2">Comment</th>
                                        <!-- <th class="font-weight-semi-bold border-top-0 py-2">Amount</th> -->
                                        <th class="font-weight-semi-bold border-top-0 py-2">Status</th>
                                        <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @if(isset($comments))
                                        @foreach ($comments as $comment)

                                            <tr>
                                                <td class="py-3">{{$i}}</td>
                                                <td class="py-3">
                                                    <div>{{$comment->name}}</div>
                                                    <div class="text-muted">{{$comment->location}}</div>
                                                </td>
                                                <td class="py-3">
                                                    @if(strlen($comment->comment) > 50)
                                                        {{substr($comment->comment, 0 , 50)}}.....
                                                    @else
                                                        {{$comment->comment}}
                                                    @endif    
                                                </td>
                                                <!-- <td class="py-3">$1,230.00</td> -->
                                                <td class="py-3">
                                                    @if($comment->publish == "false")
                                                        <span class="badge badge-pill badge-warning">Pending</span>
                                                    @else
                                                        <span class="badge badge-pill badge-success">Published</span>
                                                    @endif
                                                </td>
                                                <td class="py-3">
                                                    <div class="position-relative">
                                                        <a id="dropDown{{$comment->id}}Invoker" class="link-dark d-flex" href="#" aria-controls="dropDown{{$comment->id}}" aria-haspopup="true" aria-expanded="false" data-unfold-target="#dropDown{{$comment->id}}" data-unfold-event="click" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                                                            <i class="gd-more-alt icon-text"></i>
                                                        </a>

                                                        <ul id="dropDown{{$comment->id}}" class="unfold unfold-light unfold-top unfold-right position-absolute py-3 mt-1 unfold-css-animation unfold-hidden fadeOut" aria-labelledby="dropDown{{$comment->id}}Invoker" style="min-width: 150px; animation-duration: 300ms; right: 0px;">
                                                            <li class="unfold-item">
                                                                <a class="unfold-link media align-items-center text-nowrap" href="/admin/comment/{{$comment->id}}">
                                                                    <i class="gd-eye unfold-item-icon mr-3"></i>
                                                                    <span class="media-body">View comment</span>
                                                                </a>
                                                            </li>
                                                            @if($comment->publish == "false")
                                                                <li class="unfold-item">
                                                                    <a class="unfold-link media align-items-center text-nowrap" href="/admin/publish/{{$comment->id}}">
                                                                        <i class="gd-pencil unfold-item-icon mr-3"></i>
                                                                        <span class="media-body">Publish</span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li class="unfold-item">
                                                                <a class="unfold-link media align-items-center text-nowrap" href="/admin/delete-comment/{{$comment->id}}">
                                                                    <i class="gd-close unfold-item-icon mr-3"></i>
                                                                    <span class="media-body">Delete</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp  

                                        @endforeach
                                    @endif   

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        @endsection