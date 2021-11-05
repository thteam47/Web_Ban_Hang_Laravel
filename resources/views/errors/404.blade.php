<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="{{asset('public/theme_fontend/css/404.css')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>404 Error Page</title>
</head>
<body>

	<section id="not-found">
		<div id="title">404 Error Page
			<br>
			{{ $exception->getMessage() }}
		</div>

		<div class="circles">
			<p>404<br>
				<small>PAGE NOT FOUND</small>
			</p>
			<span class="circle big"></span>
			<span class="circle med"></span>
			<span class="circle small"></span>
		</div>
	</section>
</body>
</html>
