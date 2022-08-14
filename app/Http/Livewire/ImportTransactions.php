<?php

	namespace App\Http\Livewire;

	use App\Csv;
	use App\Models\Transaction;
	use Illuminate\Support\Facades\Validator;
	use Livewire\Component;
	use Livewire\WithFileUploads;

	class ImportTransactions extends Component
	{
		use WithFileUploads;

		public $showImportModal = false;
		public $upload;
		public $columns         = [];
		public $fieldColumnMap
								= [
				'title'  => '',
				'amount' => '',
				'status' => '',
				'date'   => '',
			];

		protected $rules
			= [
				'fieldColumnMap.title'  => 'required',
				'fieldColumnMap.amount' => 'required',
			];

		protected $validationAttributes
			= [
				'fieldColumnMap.title'  => 'Title',
				'fieldColumnMap.amount' => 'Amount',
			];

		public function updatingUpload ( $value )
		: void {
			Validator::make(
				[ 'upload' => $value ],
				[ 'upload' => 'required|mimes:csv,txt' ],
			)->validate();
		}

		public function updatedUpload ()
		{
			$this->columns = Csv::from($this->upload)->columns();

			$this->guessWhichColumnsMapToWhichFields();
		}

		public function guessWhichColumnsMapToWhichFields ()
		: void
		{
			$guess = [
				'title'  => [ 'title', 'label' ],
				'amount' => [ 'amount', 'price' ],
				'status' => [ 'status', 'state' ],
				'date'   => [ 'date_for_editing', 'date', 'time' ],
			];

			foreach ( $this->columns as $column ) {
				$match = collect($guess)->search(fn ( $options ) => in_array(strtolower($column), $options));

				if ( $match ) {
					$this->fieldColumnMap[$match] = $column;
				}
			}
		}

		public function import ()
		: void
		{
			$this->validate();

			$importCount = 0;
			Csv::from($this->upload)
			   ->eachRow(function ( $row ) use ( &$importCount ) {
				   Transaction::create($this->extractFieldsFromRow($row));

				   $importCount++;
			   })
			;

			$this->reset();
			$this->emit('refreshTransactions');
			$this->notify('Import ' . $importCount . ' transactions successfully!');
		}

		public function extractFieldsFromRow ( $row )
		: array {
			$attributes = collect($this->fieldColumnMap)
				->filter()
				->mapWithKeys(function ( $heading, $field ) use ( $row ) {
					return [ $field => $row[$heading] ];
				})
				->toArray()
			;

			return $attributes
				   +
				   [ 'status' => 'success', 'date' => now() ]; // default value
		}
	}
