<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Title -->
    <title>Login | Prime Pages Admin</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

    <!-- Template -->
    <link rel="stylesheet" href="{{ asset('graindashboard/css/graindashboard.css') }}">
  </head>

  <body class="">

    <main class="main">

      <div class="content">

			<div class="container-fluid pb-5">

				<div class="row justify-content-md-center">
					<div class="card-wrapper col-12 col-md-4 mt-5">
						<div class="brand text-center mb-3">
							<a href="/"><img src="{{ asset('img/logo.png') }}"></a>
						</div>
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Login</h4>
								<form id="login-form">
									<div class="form-group">
										<label for="username">Username</label>
										<input id="username" type="text" class="form-control" name="username" required="" autofocus="">
										<span class="text-danger" id="username-error"></span>
									</div>

									<div class="form-group">
										<label for="password">Password
										</label>
										<input id="password" type="password" class="form-control" name="password" required="">
										<span class="text-danger" id="password-error"></span>
										<!-- <div class="text-right">
											<a href="password-reset.html" class="small">
												Forgot Your Password?
											</a>
										</div> -->
									</div>

									<div class="form-group">
										<div class="form-check position-relative mb-2">
										  <input type="checkbox" class="form-check-input d-none" id="remember_token" name="remember_token" value="true">
										  <label class="checkbox checkbox-xxs form-check-label ml-1" for="remember_token"
												 data-icon="&#xe936">Remember Me</label>
										</div>
									</div>
									{{ csrf_field()}}
									<div class="form-group no-margin">
										<button id="submit" type="submit" class="btn btn-primary btn-block">
											Sign In
										</button>
										<div style="text-align: center;" class="form-group">
            								<b><span class="text-success" id="success-message"></span><b>
										</div>
										<div style="text-align: center;" class="form-group">
            								<b><span class="text-danger" id="error-message"></span><b>
        								</div>
									</div>
									
								</form>
							</div>
						</div>
						<footer class="footer mt-3">
							<div class="container-fluid">
								<div class="footer-content text-center small">
									<span class="text-muted">&copy; 2020 Prime Pages Admin. All Rights Reserved.</span>
								</div>
							</div>
						</footer>
					</div>
				</div>



			</div>

      </div>
    </main>

	<script src="{{ asset('graindashboard/js/graindashboard.js') }}"></script>
	<script src="{{ asset('graindashboard/js/graindashboard.vendor.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	$('#login-form').on('submit', function(e){
		e.preventDefault();
		$('#username-error').text('');
		$('#password-error').text('');
		$('#error-message').text('');
		$('#success-message').text("Loading.....");		

		var username = $('#username').val();
		var password = $('#password').val();
		var remember_me = $('input#remember_token');
		var remember_token;
		if(remember_me.is(":checked")){
			remember_token = remember_me.val();
		} else {
			remember_token = "";
		}
		$.ajax({
			url: "/login_admin",
			type: "POST",
			data:{
				username:username,
				password:password,
				remember_token: remember_token,
			},
			success: function(response){
				console.log(response);
				if(response.success) {
					$('#success-message').text(response.success);
					window.location = "admin/comments";
				} else{
					$('#success-message').text('');
					$('#error-message').text(response.error);
				}
			},
			error: function(response) {
            //   $('#username-error').text(response.responseJSON.errors.username);
            //   $('#password-error').text(response.responseJSON.errors.password);  
          }
		});

	});
	</script>
  </body>
</html>