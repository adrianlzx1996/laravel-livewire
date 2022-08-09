<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HelloWorld extends Component
{
	public $name     = 'Haha';
	public $loud     = false;
	public $greeting = [];

	public function render ()
	{
		return view('livewire.hello-world');
	}
}
