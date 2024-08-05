<!-- resources/views/livewire/smtp-form-component.blade.php -->
<section class="mt-8">
    <header>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update SMTP Settings.') }}
        </p>
    </header>

    <form wire:submit.prevent="updateSmtpSettings">
        <!-- Existing form fields -->
        <div class="mb-3 row">
            <div class="col-md-6 mt-2">
                <label for="smtp_host">SMTP Host</label>
                <input wire:model.defer="smtp_host" type="text" class="form-control" id="smtp_host" required>
                @error('smtp_host')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-2">
                <label for="smtp_username">SMTP Username</label>
                <input wire:model.defer="smtp_username" type="text" class="form-control" id="smtp_username" required>
                @error('smtp_username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-2">
                <label for="smtp_password">SMTP Password</label>
                <input wire:model.defer="smtp_password" type="password" class="form-control" id="smtp_password"
                    required>
                @error('smtp_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-2">
                <label for="smtp_port">SMTP Port</label>
                <input wire:model.defer="smtp_port" type="text" class="form-control" id="smtp_port" required>
                @error('smtp_port')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-2">
                <label for="smtp_from_name">From Name</label>
                <input wire:model.defer="smtp_from_name" type="text" class="form-control" id="smtp_from_name"
                    required>
                @error('smtp_from_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-2">
                <label for="smtp_from_email">From Email</label>
                <input wire:model.defer="smtp_from_email" type="email" class="form-control" id="smtp_from_email"
                    required>
                @error('smtp_from_email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6 mt-2">
                <label for="mailer_type">Mailer Type</label>
                <select wire:model="mailer_type" class="form-control @error('mailer_type') is-invalid @enderror" id="mailer_type" required>
                    <option value="" selected>Select Mailer Type</option> <!-- Default option -->
                    <option value="Gmail">Gmail</option>
                    <option value="Brevo">Brevo</option>
                    <option value="GetResponse">GetResponse</option>
                </select>
                @error('mailer_type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="gap-2 mt-4 d-flex align-items-center justify-content-end">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            <button wire:click="sendTestEmail" class="btn btn-secondary">{{ __('Send Test Email') }}</button>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <!-- Loader -->

    </form>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('smtp-saved', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'SMTP Settings Updated',
                    text: 'Your SMTP settings have been updated successfully!',
                    showConfirmButton: false,
                    timer: 2000
                });
            });

            Livewire.on('email-sent', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Test Email Sent',
                    text: 'A test email has been sent to your email address!',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });
    </script>
</section>
