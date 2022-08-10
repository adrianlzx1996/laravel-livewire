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
<div class="hidden lg:block">
	<div class="flex items-center space-x-2">
		<button type="button"
		        class="bg-gray-50 flex-shrink-0 rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-purple-500">
			<span class="sr-only">View notifications</span>
			<x-icons.notification/>
		</button>

		<!-- Profile dropdown -->
		<div x-data="dropdown"
		     @keydown.escape.stop="open = false; focusButton()" @click.away="onClickAway($event)"
		     class="relative flex-shrink-0">
			<div>
				<button type="button"
				        class="bg-white rounded-full flex text-sm ring-2 ring-white ring-opacity-20 focus:outline-none focus:ring-opacity-100"
				        id="user-menu-button" x-ref="button" @click="onButtonClick()"
				        @keyup.space.prevent="onButtonEnter()" @keydown.enter.prevent="onButtonEnter()"
				        aria-expanded="false" aria-haspopup="true" x-bind:aria-expanded="open.toString()"
				        @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()">
					<span class="sr-only">Open user menu</span>
					<img class="h-8 w-8 rounded-full"
					     src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
					     alt="">
				</button>
			</div>

			<div x-show="open" x-transition:leave="transition ease-in duration-75"
			     x-transition:leave-start="transform opacity-100 scale-100"
			     x-transition:leave-end="transform opacity-0 scale-95"
			     class="origin-top-right z-40 absolute -right-2 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
			     x-ref="menu-items" x-description="Dropdown menu, show/hide based on menu state."
			     x-bind:aria-activedescendant="activeDescendant" role="menu" aria-orientation="vertical"
			     aria-labelledby="user-menu-button" tabindex="-1" @keydown.arrow-up.prevent="onArrowUp()"
			     @keydown.arrow-down.prevent="onArrowDown()" @keydown.tab="open = false"
			     @keydown.enter.prevent="open = false; focusButton()" @keyup.space.prevent="open = false; focusButton()"
			     style="display: none;">

				<a href="{{ route('profile') }}"
				   class="block px-4 py-2 text-sm text-gray-700 @if(Route::is('profile')) bg-gray-50 @endif"
				   x-state:on="Active"
				   x-state:off="Not Active"
				   :class="{ 'bg-gray-100': activeIndex === 0 }" role="menuitem" tabindex="-1" id="user-menu-item-0"
				   @mouseenter="activeIndex = 0" @mouseleave="activeIndex = -1" @click="open = false; focusButton()">Your
					Profile</a>

				<a href="#" class="block px-4 py-2 text-sm text-gray-700" :class="{ 'bg-gray-100': activeIndex === 1 }"
				   role="menuitem" tabindex="-1" id="user-menu-item-1" @mouseenter="activeIndex = 1"
				   @mouseleave="activeIndex = -1" @click="open = false; focusButton()">Settings</a>

				<a href="#" class="block px-4 py-2 text-sm text-gray-700" :class="{ 'bg-gray-100': activeIndex === 2 }"
				   role="menuitem" tabindex="-1" id="user-menu-item-2" @mouseenter="activeIndex = 2"
				   @mouseleave="activeIndex = -1" @click="open = false; focusButton()">Sign out</a>

			</div>

		</div>

	</div>
</div>

<script>
	function dropdown(e = {open: !1}) {

		return {
			init() {
				(this.items = Array.from(
					this.$el.querySelectorAll('[role="menuitem"]')
				)),
					this.$watch("open", () => {
						this.open && (this.activeIndex = -1);
					});
			},
			activeDescendant: null,
			activeIndex: null,
			items: null,
			open: e.open,
			focusButton() {
				this.$refs.button.focus();
			},
			onButtonClick() {
				(this.open = !this.open),
				this.open &&
				this.$nextTick(() => {
					this.$refs["menu-items"].focus();
				});
			},
			onButtonEnter() {
				(this.open = !this.open),
				this.open &&
				((this.activeIndex = 0),
					(this.activeDescendant =
						this.items[this.activeIndex].id),
					this.$nextTick(() => {
						this.$refs["menu-items"].focus();
					}));
			},
			onArrowUp() {
				if (!this.open)
					return (
						(this.open = !0),
							(this.activeIndex = this.items.length - 1),
							void (this.activeDescendant =
								this.items[this.activeIndex].id)
					);
				0 !== this.activeIndex &&
				((this.activeIndex =
					-1 === this.activeIndex
						? this.items.length - 1
						: this.activeIndex - 1),
					(this.activeDescendant = this.items[this.activeIndex].id));
			},
			onArrowDown() {
				if (!this.open)
					return (
						(this.open = !0),
							(this.activeIndex = 0),
							void (this.activeDescendant =
								this.items[this.activeIndex].id)
					);
				this.activeIndex !== this.items.length - 1 &&
				((this.activeIndex = this.activeIndex + 1),
					(this.activeDescendant = this.items[this.activeIndex].id));
			},
			onClickAway(e) {
				if (this.open) {
					const t = [
						"[contentEditable=true]",
						"[tabindex]",
						"a[href]",
						"area[href]",
						"button:not([disabled])",
						"iframe",
						"input:not([disabled])",
						"select:not([disabled])",
						"textarea:not([disabled])",
					]
						.map((e) => `${e}:not([tabindex='-1'])`)
						.join(",");
					(this.open = !1), e.target.closest(t) || this.focusButton();
				}
			},
		};

	}
</script>
