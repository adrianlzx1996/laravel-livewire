<?php

	namespace App\Models;

	use Carbon\Carbon;
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;

	class Transaction extends Model
	{
		use HasFactory;

		const STATUSES
			= [
				'new'        => 'New',
				'processing' => 'Processing',
				'success'    => 'Success',
				'failed'     => 'Failed',
			];

		protected $fillable = [ 'title', 'date', 'status' ];
		protected $casts    = [ 'date' => 'date' ];

		public function getStatusColorAttribute ()
		{
			return [
					   'new'     => 'blue',
					   'success' => 'green',
					   'failed'  => 'red',
				   ][$this->status] ?? 'slate';
		}

		public function getDateForHumansAttribute ()
		{
			return $this->date->format('M d, Y');
		}

		public function getEditingDateAttribute ()
		{
			return $this->date->format('m/d/Y');
		}

		public function setEditingDateAttribute ( $value )
		{
			$this->date = Carbon::parse($value);

		}
	}
