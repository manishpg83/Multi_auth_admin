<section>
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Profile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your Profile.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update.names') }}" class="mt-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="first_name" class="form-label">{{ __('First Name') }}</label>
            <input id="first_name" name="first_name" type="text" class="form-control" value="{{ old('first_name', $user->first_name) }}" required autofocus autocomplete="first_name">
            @error('first_name')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
            <input id="last_name" name="last_name" type="text" class="form-control" value="{{ old('last_name', $user->last_name) }}" required autofocus autocomplete="last_name">
            @error('last_name')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}" required readonly>
        </div>

        <div class="mb-3">
            <label for="company_name" class="form-label">{{ __('Company Name') }}</label>
            <input id="company_name" name="company_name" type="text" class="form-control" value="{{ old('company_name', $user->company_name) }}" required autocomplete="company_name">
            @error('company_name')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center gap-4 justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
</section>
<hr>
<section class="mt-8">
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Additional Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update additional profile information.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update.details') }}" class="mt-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('Phone') }}</label>
                    <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone', $user->phone) }}" autocomplete="phone">
                    @error('phone')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="designation" class="form-label">{{ __('Designation') }}</label>
                    <input id="designation" name="designation" type="text" class="form-control" value="{{ old('designation', $user->designation) }}" autocomplete="designation">
                    @error('designation')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">{{ __('Website') }}</label>
                    <input id="website" name="website" type="text" class="form-control" value="{{ old('website', $user->website) }}" autocomplete="website">
                    @error('website')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">{{ __('Logo') }}</label>
                    <input id="logo" name="logo" type="file" class="form-control" onchange="previewImage(this)">
                    <img id="logo-preview" src="{{ $user->logo ? asset('storage/' . $user->logo) : '' }}" alt="Logo Preview" style="max-width: 100px; margin-top: 10px;">
                    @error('logo')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <input id="address" name="address" type="text" class="form-control" value="{{ old('address', $user->address) }}" autocomplete="address">
                    @error('address')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telegram" class="form-label">{{ __('Telegram') }}</label>
                    <input id="telegram" name="telegram" type="text" class="form-control" value="{{ old('telegram', $user->telegram) }}" autocomplete="telegram">
                    @error('telegram')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">{{ __('Whatsapp') }}</label>
                    <input id="whatsapp" name="whatsapp" type="text" class="form-control" value="{{ old('whatsapp', $user->whatsapp) }}" autocomplete="whatsapp">
                    @error('whatsapp')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="skype" class="form-label">{{ __('Skype') }}</label>
                    <input id="skype" name="skype" type="text" class="form-control" value="{{ old('skype', $user->skype) }}" autocomplete="skype">
                    @error('skype')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="imo" class="form-label">{{ __('IMO') }}</label>
                    <input id="imo" name="imo" type="text" class="form-control" value="{{ old('imo', $user->imo) }}" autocomplete="imo">
                    @error('imo')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="active_social" class="form-label">{{ __('Active Social Media') }}</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-globe"></i></span>
                        <select id="active_social" name="active_social" class="form-select">
                            <option value="skype" @if(old('active_social', $user->active_social) === 'skype') selected @endif>
                                <i class="bi bi-skype"></i> Skype
                            </option>
                            <option value="telegram" @if(old('active_social', $user->active_social) === 'telegram') selected @endif>
                                <i class="bi bi-telegram"></i> Telegram
                            </option>
                            <option value="imo" @if(old('active_social', $user->active_social) === 'imo') selected @endif>
                                <i class="bi bi-chat"></i> IMO
                            </option>
                            <option value="whatsapp" @if(old('active_social', $user->active_social) === 'whatsapp') selected @endif>
                                <i class="bi bi-whatsapp"></i> Whatsapp
                            </option>
                        </select>
                    </div>
                    @error('active_social')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-4 justify-content-end mt-4">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>
</section>

@if (session('status') === 'names-updated')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Profile Updated',
                text: 'Your Profile has been updated successfully!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>
@endif
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logo-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>