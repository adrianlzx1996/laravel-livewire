<?php

	namespace Database\Factories;

	use Illuminate\Database\Eloquent\Factories\Factory;

	/**
	 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
	 */
	class TransactionFactory extends Factory
	{
		/**
		 * Define the model's default state.
		 *
		 * @return array<string, mixed>
		 */
		public function definition ()
		{
			return [
				'title'  => 'Payment for ' . $this->faker->name(),
				'amount' => $this->faker->numberBetween(100, 1000),
				'status' => $this->faker->randomElement([ 'new', 'processing', 'success', 'failed' ]),
				'date'   => $this->faker->dateTimeBetween('-1 year', 'now'),
			];
		}
	}
