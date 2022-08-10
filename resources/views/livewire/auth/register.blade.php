<form action="" wire:submit.prevent="register">
	<div class="form-group">
		<label for="name">Name</label>
		<input wire:model.lazy="name" type="text" class="form-control" id="name" name="name" placeholder="Name"
		       value="{{ old('name') }}">
		@error('name') {{ $message }} @enderror
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input wire:model="email" type="email" class="form-control" id="email" name="email" placeholder="Email"
		       value="{{ old('email') }}">
		@error('email') {{ $message }} @enderror
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input wire:model.lazy="password" type="password" class="form-control" id="password" name="password"
		       placeholder="Password">
		@error('password') {{ $message }} @enderror
	</div>
	<div class="form-group">
		<label for="passwordConfirmation">Confirm Password</label>
		<input wire:model.lazy="passwordConfirmation" type="password" class="form-control" id="passwordConfirmation"
		       name="passwordConfirmation"
		       placeholder="Confirm Password">
		@error('passwordConfirmation') {{ $message }} @enderror
	</div>
	<button wire:click="register" type="submit" class="btn btn-primary">Register</button>
</form>
