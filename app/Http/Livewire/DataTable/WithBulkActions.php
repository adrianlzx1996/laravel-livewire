<?php

	namespace App\Http\Livewire\DataTable;

	trait WithBulkActions
	{
		public $selectedAll = false;
		public $selectPage  = [];
		public $selected    = [];

		public function renderingWithBulkActions ()
		{
			if ( $this->selectedAll ) $this->selectPageRows();
		}

		public function selectPageRows ()
		: void
		{
			$this->selected = $this->rows->pluck('id')->map(fn ( $id ) => (string)$id);
		}

		public function updatedSelected ()
		{
			$this->selectedAll = false;
			$this->selectPage  = [];
		}

		public function updatedSelectPage ( $value )
		{
			if ( $value ) {
				$this->selectPageRows();
				return;
			}

			$this->selected = [];
		}

		public function selectAll ()
		{
			$this->selectedAll = true;
		}

		public function getSelectedRowsQuery ()
		{
			return ( clone $this->rowsQuery )
				->unless($this->selectedAll, fn ( $query ) => $query->whereKey($this->selected))
			;
		}
	}
