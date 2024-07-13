<section class="mt-8">
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your Profile.') }}
        </p>
    </header>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="mt-6">
        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                <input id="first_name" name="first_name" type="text" class="form-control" wire:model="first_name" required autofocus>
                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
                <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                <input id="last_name" name="last_name" type="text" class="form-control" wire:model="last_name" required autofocus>
                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <div class="col-md-6">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control" wire:model="email" required readonly>
            </div>
            <div class="col-md-6">
                <label for="company_name" class="form-label">{{ __('Company Name') }}</label>
                <input id="company_name" name="company_name" type="text" class="form-control" wire:model="company_name" required>
                @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="gap-4 mt-4 d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
</section>
