<div
	x-data="{
		messages: [],
		remove(message) {
			this.messages.splice(this.messages.indexOf(message), 1);
		}
	}"
	@notify.window="let message = $event.detail; messages.push(message); setTimeout(() => { remove(message); }, 3000)"
	aria-live="assertive"
	class="fixed inset-0 flex flex-col items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start z-50 space-y-4">
	<template x-for="(message, messageIndex) in messages" :key="messageIndex">
		<div class="w-full flex flex-col items-center space-y-4 sm:items-end">
			<!-- Notification panel, dynamically insert this into the live region when it needs to be displayed -->

			<div x-transition:enter="transform ease-out duration-300 transition"
			     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
			     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
			     x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
			     x-transition:leave-end="opacity-0"
			     class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
				<div class="p-4">
					<div class="flex items-start">
						<div class="flex-shrink-0">
							<x-icons.check/>
						</div>
						<div class="ml-3 w-0 flex-1 pt-0.5">
							<p class="text-sm font-medium text-gray-900" x-text="message"></p>
						</div>
						<div class="ml-4 flex-shrink-0 flex">
							<button @click="remove(message);"
							        class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
								<span class="sr-only">Close</span>
								<x-icons.close/>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</template>
</div>
