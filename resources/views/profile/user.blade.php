
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="{{asset('public/theme_fontend/css/profile.css')}}">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<title>Profile</title>
</head>
<style>
	.text-secondary{
		font-size: 18px;
	}
</style>
<body>
	<div class="container">
		<div class="main-body">
			<!-- Breadcrumb -->
			<a class="btn btn-info col-md-12" style="margin-bottom: 10px;" href="{{ route('home') }}">Return</a>
			<!-- /Breadcrumb -->
			<div class="row gutters-sm">
				<div class="col-md-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="160">
								<div class="mt-3">
									<h3>John Doe</h4>
									<p class="text-muted" style="font-size: 16px;">Loyal customer</p>
									<button class="btn btn-primary">Change Avatar</button>
								</div>
							</div>
						</div>
					</div>					
				</div>
				<div class="col-md-8">
					<div class="card mb-3">
						<div class="card-body">							
							<div class="row" style="margin-top: 4px;">
								<div class="col-sm-3">
									<h4 class="mb-0">Full Name</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									{{ $info->name }}
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h4 class="mb-0">Email</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									{{ $info->email }}
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h4 class="mb-0">Phone</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									{{ $info->phone }}
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h4 class="mb-0">Address</h6>
								</div>
								<div class="col-sm-9 text-secondary">
									Hà Nội
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-12">
									<a class="btn btn-info" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Edit</a>
									<a class="btn btn-info" style="margin-left: 10px;" href="{{ route('changePass') }}">Change password</a>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="text-align: center;">
				<a class="btn btn-primary" href="{{ route('logoutUser') }}">Logout</a>
			</div>

		</div>
	</div>
</body>
</html>