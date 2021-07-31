@extends('admin.master')

    @section('add-blog', 'active')
    @section('tinyMce')
    <script src='https://cdn.tiny.cloud/1/sk646bkxncso3iy9fd2f431wkxkm57j47b6apa3uwweq3xjn/tinymce/5/tinymce.min.js' referrerpolicy="origin">
    </script>
    <script>
        tinymce.init({
        selector: '#description'
        });
    </script>
    @endsection
    @section('content')

    <div class="content">
        <div class="py-4 px-3 px-md-4">
            <div class="card mb-3 mb-md-4">

                <div class="card-body">
                    <!-- Breadcrumb -->
                    <nav class="d-none d-md-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Posts</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Post</li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->

                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">Create New Post</div>
                    </div>


                    <!-- Form -->
                    <div>
                        <form method="post" action="/admin/create-post" enctype="multipart/form-data">
                        	<div style="margin-bottom: 10px;" class="form-row">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" value="" id="title" name="title" placeholder="">
                                @error('title')
                                    <span >
                                        <p style="color: red;">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div style="margin-bottom: 10px;" class="form-row">                 
                                <label for="description">Description</label>
                                <textarea rows="6" type="text" class="form-control" value="" id="description" name="description" placeholder=""></textarea>
                                @error('description')
                                    <span >
                                        <p style="color: red;">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Blog image">
                                    @error('image')
                                        <span >
                                            <p style="color: red;">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="img_desc">Image Description</label>
                                    <input type="text" class="form-control" id="img_desc" name="img_desc" placeholder="image description">
                                    @error('img_desc')
                                        <span >
                                            <p style="color: red;">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div style="margin-bottom: 10px;" class="form-row">
                                <label for="tags">Tags</label>
                                <input type="text" class="form-control" value="" id="tags" name="tags" placeholder="Music, Entertainment">
                                @error('img_desc')
                                    <span >
                                        <p style="color: red;">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            {{ csrf_field()}}
                            <button type="submit" class="btn btn-primary float-right">Create</button>
                            @if(isset($msg))
                                <span >
                                    <p style="color: green; text-align: center;">{{ $msg }}</p>
                                </span>
                            @endif   
                        </form>
                    </div>
                    <!-- End Form -->
                </div>
            </div>


        </div>

        @endsection