<?php

	namespace App\Http\Livewire;

	use Illuminate\Support\Arr;
	use Livewire\Component;

	class Things extends Component
	{
		public $things
			= [
				[ 'id' => 1, 'title' => 'Do dishes' ],
				[ 'id' => 2, 'title' => 'Dust shelves' ],
				[ 'id' => 3, 'title' => 'Clean Counters' ],
				[ 'id' => 4, 'title' => 'Fold Laundry' ],
				[ 'id' => 5, 'title' => 'Scrub Toilet' ],
			];

		public function shuffle ()
		{
			$this->things = Arr::shuffle($this->things);
		}

		public function reorder ( $orderIds )
		{
			$this->things = collect($orderIds)->map(function ( $id ) {
				return collect($this->things)->where('id', (int)$id['value'])->first();
			})->toArray();
		}
	}
