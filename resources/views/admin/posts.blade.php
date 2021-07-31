@extends('admin.master')

    @section('posts', 'active')
    @section('content')

    <div class="content">
        <div class="py-4 px-3 px-md-4">
            <div class="card mb-3 mb-md-4">

                <div class="card-body">
                    <!-- Breadcrumb -->
                    <nav class="d-none d-md-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Blogs</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Blogs</li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->

                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">Blogs</div>
                    </div>


                    <!-- Users -->
                    <div class="table-responsive-xl">
                        <table class="table text-nowrap mb-0">
                            <thead>
                            <tr>
                                <th class="font-weight-semi-bold border-top-0 py-2">#</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Title</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Tags</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Date Created</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Status</th>
                                <th class="font-weight-semi-bold border-top-0 py-2">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                                @if(isset($posts))
                                    @foreach ($posts as $post)

                                        <tr>
                                            <td class="py-3">{{ $i }}</td>
                                            <td class="align-middle py-3">
                                                <div class="d-flex align-items-center">
                                                    {{ substr($post->title, 0, 50).'...' }}
                                                </div>
                                            </td>
                                            <td class="py-3">{{ $post->tags }}</td>
                                            <td class="py-3">{{ $post->created_at}}</td>
                                            <td class="py-3">
                                                <span class="badge badge-pill badge-success">Verified</span>
                                            </td>
                                            <td class="py-3">
                                                <div class="position-relative">
                                                    <a class="link-dark d-inline-block" href="/admin/edit/{{$post->id}}">
                                                        <i class="gd-pencil icon-text"></i>
                                                    </a>
                                                    <a class="link-dark d-inline-block" href="/admin/delete/{{$post->id}}">
                                                        <i class="gd-trash icon-text"></i>
                                                    </a>
                                                    <a class="link-dark d-inline-block" href="/admin/view-post/{{$post->id}}">
                                                        <i class="gd-eye icon-text"></i>
                                                    </a>
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
                        <!-- <div class="card-footer d-block d-md-flex align-items-center d-print-none">
                            <div class="d-flex mb-2 mb-md-0">Showing 1 to 8 of 24 Entries</div>

                            <nav class="d-flex ml-md-auto d-print-none" aria-label="Pagination"><ul class="pagination justify-content-end font-weight-semi-bold mb-0">				<li class="page-item">				<a id="datatablePaginationPrev" class="page-link" href="#!" aria-label="Previous"><i class="gd-angle-left icon-text icon-text-xs d-inline-block"></i></a>				</li><li class="page-item d-none d-md-block"><a id="datatablePaginationPage0" class="page-link active" href="#!" data-dt-page-to="0">1</a></li><li class="page-item d-none d-md-block"><a id="datatablePagination1" class="page-link" href="#!" data-dt-page-to="1">2</a></li><li class="page-item d-none d-md-block"><a id="datatablePagination2" class="page-link" href="#!" data-dt-page-to="2">3</a></li><li class="page-item">				<a id="datatablePaginationNext" class="page-link" href="#!" aria-label="Next"><i class="gd-angle-right icon-text icon-text-xs d-inline-block"></i></a>				</li>				</ul></nav>
                        </div> -->
                    </div>
                    <!-- End Users -->
                </div>
            </div>


        </div>

        @endsection