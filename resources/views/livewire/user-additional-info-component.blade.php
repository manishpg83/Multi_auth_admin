<section class="mt-8">
    <header>
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
                    @error('phone')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-switch mt-2" style="padding-left: 2.50rem;">
                        <input class="form-check-input" type="checkbox" id="phone_active"
                            wire:model="active_fields.phone">
                        <label class="form-check-label" for="phone_active">Active</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label">{{ __('Designation') }}</label>
                    <input id="designation" wire:model="designation" type="text" class="form-control">
                    @error('designation')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-switch mt-2" style="padding-left: 2.50rem;">
                        <input class="form-check-input" type="checkbox" id="designation_active"
                            wire:model="active_fields.designation">
                        <label class="form-check-label" for="designation_active">Active</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">{{ __('Website') }}</label>
                    <input id="website" wire:model="website" type="text" class="form-control">
                    @error('website')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-switch mt-2" style="padding-left: 2.50rem;">
                        <input class="form-check-input" type="checkbox" id="website_active"
                            wire:model="active_fields.website">
                        <label class="form-check-label" for="website_active">Active</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="newLogo" class="form-label">{{ __('Logo') }}</label>
                    <input id="newLogo" wire:model="newLogo" type="file" class="form-control">
                    @if ($newLogo)
                        <img src="{{ $newLogo->temporaryUrl() }}" alt="New Logo Preview"
                            style="max-width: 100px; margin-top: 10px;">
                        <button wire:click.prevent="removeNewLogo" class="btn btn-sm btn-danger">Remove</button>
                    @elseif ($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="Current Logo"
                            style="max-width: 100px; margin-top: 10px;">
                        <button wire:click.prevent="removeLogo" class="btn btn-sm btn-danger"
                            style="padding: 3px 6px; font-size: 10px;">Remove</button>
                    @endif
                    @error('newLogo')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <input id="address" wire:model="address" type="text" class="form-control">
                    @error('address')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-switch mt-2" style="padding-left: 2.50rem;">
                        <input class="form-check-input" type="checkbox" id="address_active"
                            wire:model="active_fields.address">
                        <label class="form-check-label" for="address_active">Active</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telegram" class="form-label">{{ __('Telegram') }}</label>
                    <input id="telegram" wire:model="telegram" type="text" class="form-control">
                    @error('telegram')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-switch mt-2" style="padding-left: 2.50rem;">
                        <input class="form-check-input" type="checkbox" id="telegram_active"
                            wire:model="active_fields.telegram">
                        <label class="form-check-label" for="telegram_active">Active</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">{{ __('Whatsapp') }}</label>
                    <input id="whatsapp" wire:model="whatsapp" type="text" class="form-control">
                    @error('whatsapp')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-switch mt-2" style="padding-left: 2.50rem;">
                        <input class="form-check-input" type="checkbox" id="whatsapp_active"
                            wire:model="active_fields.whatsapp">
                        <label class="form-check-label" for="whatsapp_active">Active</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="skype" class="form-label">{{ __('Skype') }}</label>
                    <input id="skype" wire:model="skype" type="text" class="form-control">
                    @error('skype')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-switch mt-2" style="padding-left: 2.50rem;">
                        <input class="form-check-input" type="checkbox" id="skype_active"
                            wire:model="active_fields.skype">
                        <label class="form-check-label" for="skype_active">Active</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="imo" class="form-label">{{ __('IMO') }}</label>
                    <input id="imo" wire:model="imo" type="text" class="form-control">
                    @error('imo')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-switch mt-2" style="padding-left: 2.50rem;">
                        <input class="form-check-input" type="checkbox" id="imo_active"
                            wire:model="active_fields.imo">
                        <label class="form-check-label" for="imo_active">Active</label>
                    </div>
                </div>

                <!-- Active Social Media checkboxes -->
                <div class="mb-3">
                    <label class="form-label">{{ __('Active Social Media') }}</label>
                    <div class="row row-cols-2">
                        <div class="col">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="skype" value="skype"
                                    wire:model="active_social">
                                <label class="form-check-label" for="skype">
                                    <i class="bi bi-skype"></i> Skype
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="imo" value="imo"
                                    wire:model="active_social">
                                <label class="form-check-label" for="imo">
                                    <i class="bi bi-chat"></i> IMO
                                </label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="telegram" value="telegram"
                                    wire:model="active_social">
                                <label class="form-check-label" for="telegram">
                                    <i class="bi bi-telegram"></i> Telegram
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="whatsapp" value="whatsapp"
                                    wire:model="active_social">
                                <label class="form-check-label" for="whatsapp">
                                    <i class="bi bi-whatsapp"></i> Whatsapp
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('active_social')
                        <div class="mt-2 text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        <div class="gap-4 mt-4 d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
</section>
