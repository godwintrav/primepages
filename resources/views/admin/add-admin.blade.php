@extends('admin.master')

    @section('add-admin', 'active')
    @section('content')

    <div class="content">
        <div class="py-4 px-3 px-md-4">
            <div class="card mb-3 mb-md-4">

                <div class="card-body">
                    <!-- Breadcrumb -->
                    <nav class="d-none d-md-block" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Create Admin</a>
                            </li>
                        </ol>
                    </nav>
                    <!-- End Breadcrumb -->

                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">Create New Admin</div>
                    </div>


                    <!-- Form -->
                    <div>
                        <form action="/create_admin" method="POST">
                            <div class="form-row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">Full Name</label>
                                    <input type="text" class="form-control" value="" id="name" name="name" placeholder="Full Name">
                                    @error('name')
                                        <span >
                                            <p style="color: red;">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" value="" id="username" name="username" placeholder="Username">
                                    @error('username')
                                        <span >
                                            <p style="color: red;">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-12">
                                    <div class="font-weight-semi-bold h5 mb-3">Password</div>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" value="" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" value="" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                    @error('password')
                                        <span >
                                            <p style="color: red;">{{ $message }}</p>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                            {{ csrf_field()}}
                            <button type="submit" class="btn btn-primary float-right">Create Admin</button>
                            @if(isset($msg))
                                <span >
                                    <p style="color: green;">{{ $msg }}</p>
                                </span>
                            @endif    
                        </form>
                    </div>
                    <!-- End Form -->
                </div>
            </div>


        </div>

        @endsection