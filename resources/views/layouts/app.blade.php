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
	<link rel="stylesheet" href="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.css">
	<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>
	<link
		href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
		rel="stylesheet"
	/>

	@vite('resources/css/app.css')
	@livewireStyles
</head>
<body>
<div class="min-h-full">
	@auth
		<x-header/>
	@endauth
	<x-notification/>
	{{--	<x-page.breadcrumb/>--}}

	<x-main>
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			{{ $slot }}
		</div>
	</x-main>
</div>

@livewireScripts

@stack('scripts')
<script src="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.umd.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
</body>
</html>
