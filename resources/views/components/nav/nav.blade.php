<!-- Links section -->
<div class="hidden lg:block lg:ml-10">
	<div class="flex space-x-4">
		<!-- Current: "bg-gray-100", Default: "hover:text-gray-700" -->
		<a href="#" class="bg-gray-100 px-3 py-2 rounded-md text-sm font-medium text-gray-900"
		   aria-current="page">Dashboard</a>

		<a href="#"
		   class="hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium text-gray-900">Jobs</a>

		<a href="#"
		   class="hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium text-gray-900">Applicants</a>

		<a href="#"
		   class="hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium text-gray-900">Company</a>
	</div>
</div>

<div class="flex-1 px-2 flex justify-center lg:ml-6 lg:justify-end">
	<x-search/>
</div>
<div class="flex lg:hidden">
	<!-- Mobile menu button -->
	<button type="button"
	        class="bg-gray-50 p-2 inline-flex items-center justify-center rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-purple-500"
	        aria-controls="mobile-menu" aria-expanded="false">
		<span class="sr-only">Open main menu</span>
		<!--
		  Heroicon name: outline/menu

		  Menu open: "hidden", Menu closed: "block"
		-->
		<svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
		     stroke="currentColor" aria-hidden="true">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
			      d="M4 6h16M4 12h16M4 18h16"/>
		</svg>
		<!--
		  Heroicon name: outline/x

		  Menu open: "block", Menu closed: "hidden"
		-->
		<svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
		     stroke="currentColor" aria-hidden="true">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
			      d="M6 18L18 6M6 6l12 12"/>
		</svg>
	</button>
</div>

<!-- Actions section -->
<div class="hidden lg:block lg:ml-4">
	<div class="flex items-center">
		<button type="button"
		        class="bg-gray-50 flex-shrink-0 rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-purple-500">
			<span class="sr-only">View notifications</span>
			<!-- Heroicon name: outline/bell -->
			<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
			     stroke="currentColor" aria-hidden="true">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
				      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
			</svg>
		</button>

		<!-- Profile dropdown -->
		<div class="ml-3 relative flex-shrink-0">
			<div>
				<button type="button"
				        class="bg-gray-50 rounded-full flex text-sm text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-purple-500"
				        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
					<span class="sr-only">Open user menu</span>
					<img class="rounded-full h-8 w-8"
					     src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
					     alt="">
				</button>
			</div>

			<!--
			  Dropdown menu, show/hide based on menu state.

			  Entering: "transition ease-out duration-100"
				From: "transform opacity-0 scale-95"
				To: "transform opacity-100 scale-100"
			  Leaving: "transition ease-in duration-75"
				From: "transform opacity-100 scale-100"
				To: "transform opacity-0 scale-95"
			-->
			<div
				class="origin-top-right absolute z-10 right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
				role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
				tabindex="-1">
				<!-- Active: "bg-gray-100", Not Active: "" -->
				<a href="#" class="block py-2 px-4 text-sm text-gray-700" role="menuitem" tabindex="-1"
				   id="user-menu-item-0"> Your Profile </a>

				<a href="#" class="block py-2 px-4 text-sm text-gray-700" role="menuitem" tabindex="-1"
				   id="user-menu-item-1"> Settings </a>

				<a href="#" class="block py-2 px-4 text-sm text-gray-700" role="menuitem" tabindex="-1"
				   id="user-menu-item-2"> Sign out </a>
			</div>
		</div>
	</div>
</div>
