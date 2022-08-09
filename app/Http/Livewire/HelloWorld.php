<?php

	namespace App\Http\Livewire;

	use Illuminate\Http\Request;
	use Livewire\Component;

	class HelloWorld extends Component
	{
		public $name     = 'Haha';
		public $loud     = false;
		public $greeting = [];

		public function resetName ( $name = "Hehe" )
		{
			$this->name = $name;
		}

		/**
		 * First time this component is rendered, this function will be called
		 *
		 * @return void
		 */
		public function mount ( Request $request, $name )
		{
			$this->name = $request->input('name', $name);
		}

		public function render ()
		{
			return view('livewire.hello-world');
		}
	}
