<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Register</title>

	<script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>

	@stack('styles')

	@vite('resources/css/app.css')
	@livewireStyles
</head>
<body>
<div class="min-h-full">
	<x-notification/>

	<x-main>
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			{{ $slot }}
		</div>
	</x-main>
</div>

@livewireScripts

@stack('scripts')
</body>
</html>
