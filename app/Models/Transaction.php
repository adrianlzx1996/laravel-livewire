<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;

	class Transaction extends Model
	{
		use HasFactory;

		public $casts = [ 'date' => 'date' ];

		public function getStatusColorAttribute ()
		{
			return [
					   'new'     => 'blue',
					   'success' => 'green',
					   'failed'  => 'red',
				   ][$this->status] ?? 'slate';
		}
	}
