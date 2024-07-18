<form wire:submit.prevent="submit">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" wire:model="first_name" class="form-control">
                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" wire:model="last_name" class="form-control">
                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" wire:model="email" class="form-control">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" id="company_name" wire:model="company_name" class="form-control">
                @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
