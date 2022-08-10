<?php

	namespace App\Http\Livewire;

	use Livewire\Component;

	class HelloWorld extends Component
	{
		public $names    = [ 'Jelly', 'Man', 'Chico' ];
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
		public function mount ( $name )
		{
			$this->name = $name;
		}

		/**
		 * This function will be called everytime the component is rendered, after mount method
		 *
		 * @return void
		 */
		public function hydrate ()
		: void
		{
			$this->name = 'hydrated@';
		}

		public function updatedName ()
		{
			$this->name = ucwords($this->name);
		}

		public function render ()
		{
			return view('livewire.hello-world');
		}

		public function refreshChildren ()
		{
			$this->emit('refreshChildren', 'foo');
		}
	}
