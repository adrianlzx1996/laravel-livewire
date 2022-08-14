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
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>

@stack('scripts')
<script src="https://unpkg.com/trix@2.0.0-beta.0/dist/trix.umd.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
{{--<script>--}}
{{--	let animations = [];--}}

{{--	Livewire.hook('message.received', () => {--}}
{{--		let things = Array.from(document.querySelectorAll('[animate-move]'));--}}

{{--		animations = things.map(thing => {--}}
{{--			let oldTop = thing.getBoundingClientRect().top;--}}

{{--			return () => {--}}
{{--				let newTop = thing.getBoundingClientRect().top;--}}

{{--				thing.animate([--}}
{{--					{transform: `translateY(${oldTop - newTop}px)`},--}}
{{--					{transform: `translateY(0px)`},--}}
{{--				], {--}}
{{--					duration: 1000,--}}
{{--					easing: 'ease',--}}
{{--				});--}}
{{--			}--}}
{{--		});--}}

{{--		things.forEach(thing => {--}}
{{--			thing.getAnimations().forEach(animation => animation.finish())--}}
{{--		})--}}
{{--	})--}}
{{--	Livewire.hook('message.processed', () => {--}}
{{--		while (animations.length) {--}}
{{--			animations.shift()();--}}
{{--		}--}}
{{--	})--}}

{{--	let root = document.querySelector('[drag-root]');--}}

{{--	root.querySelectorAll('[drag-item]').forEach(el => {--}}
{{--		el.addEventListener('dragstart', e => {--}}
{{--			e.target.setAttribute('dragging', true);--}}
{{--		});--}}

{{--		el.addEventListener('drop', e => {--}}
{{--			e.target.classList.remove('bg-yellow-100')--}}

{{--			//get the dragging element--}}
{{--			//insert it before the drop target--}}

{{--			let draggingEl = root.querySelector('[dragging]');--}}

{{--			e.target.before(draggingEl)--}}

{{--			let component = Livewire.find(e.target.closest('[wire\\:id]').getAttribute('wire:id'));--}}

{{--			let orderIds = Array.from(root.querySelectorAll('[drag-item]')).map(el => el.getAttribute('drag-item'));--}}

{{--			let method = root.getAttribute('drag-root');--}}

{{--			component.call(method, orderIds);--}}
{{--		});--}}
{{--		el.addEventListener('dragenter', e => {--}}
{{--			e.target.classList.add('bg-yellow-100')--}}
{{--			e.preventDefault(); // to enable drop listener--}}
{{--		});--}}
{{--		el.addEventListener('dragover', e => {--}}
{{--			e.preventDefault(); // to enable drop listener--}}
{{--		});--}}
{{--		el.addEventListener('dragleave', e => {--}}
{{--			e.target.classList.remove('bg-yellow-100')--}}
{{--		});--}}
{{--		el.addEventListener('dragend', e => {--}}
{{--			e.target.removeAttribute('dragging');--}}

{{--		});--}}
{{--	})--}}
{{--</script>--}}
</body>
</html>
