<section class="mt-8">
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Additional Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update additional profile information.') }}
        </p>
    </header>

    <form wire:submit.prevent="updateAdditionalInfo" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                    <input id="phone" wire:model="phone" type="text" class="form-control">
                    @error('phone') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label">{{ __('Designation') }}</label>
                    <input id="designation" wire:model="designation" type="text" class="form-control">
                    @error('designation') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">{{ __('Website') }}</label>
                    <input id="website" wire:model="website" type="text" class="form-control">
                    @error('website') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="newLogo" class="form-label">{{ __('Logo') }}</label>
                    <input id="newLogo" wire:model="newLogo" type="file" class="form-control">
                    @if ($newLogo)
                        <img src="{{ $newLogo->temporaryUrl() }}" alt="New Logo Preview" style="max-width: 100px; margin-top: 10px;">
                        <button wire:click.prevent="removeNewLogo" class="btn btn-sm btn-danger">Remove</button>
                    @elseif ($logo)
                        <img src="{{ asset('storage/'. $logo) }}" alt="Current Logo" style="max-width: 100px; margin-top: 10px;">
                        <button wire:click.prevent="removeLogo" class="btn btn-sm btn-danger">Remove</button>
                    @endif
                    @error('newLogo') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <input id="address" wire:model="address" type="text" class="form-control">
                    @error('address') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="telegram" class="form-label">{{ __('Telegram') }}</label>
                    <input id="telegram" wire:model="telegram" type="text" class="form-control">
                    @error('telegram') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">{{ __('Whatsapp') }}</label>
                    <input id="whatsapp" wire:model="whatsapp" type="text" class="form-control">
                    @error('whatsapp') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="skype" class="form-label">{{ __('Skype') }}</label>
                    <input id="skype" wire:model="skype" type="text" class="form-control">
                    @error('skype') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="imo" class="form-label">{{ __('IMO') }}</label>
                    <input id="imo" wire:model="imo" type="text" class="form-control">
                    @error('imo') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="active_social" class="form-label">{{ __('Active Social Media') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-globe"></i></span>
                        <select id="active_social" wire:model="active_social" class="form-select">
                            <option value="skype"><i class="bi bi-skype"></i> Skype</option>
                            <option value="telegram"><i class="bi bi-telegram"></i> Telegram</option>
                            <option value="imo"><i class="bi bi-chat"></i> IMO</option>
                            <option value="whatsapp"><i class="bi bi-whatsapp"></i> Whatsapp</option>
                        </select>
                    </div>
                    @error('active_social') <div class="mt-2 text-danger">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="gap-4 mt-4 d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
</section>