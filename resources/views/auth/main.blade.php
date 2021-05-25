<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('theme/img/icons/icon-48x48.png') }}" />

	<title>{{ config('app.name') }}</title>

	<link href="{{ asset('theme/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-6 col-lg-4 mx-auto d-table h-100">
					<div class="d-table-cell align-middle pt-5">

						@yield('content')

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="{{ asset('theme/js/app.js') }}"></script>

</body>
</html>