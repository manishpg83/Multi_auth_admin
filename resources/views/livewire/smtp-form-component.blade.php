<div>
    <form wire:submit.prevent="updateSmtpSettings">
        <div class="form-group">
            <label for="smtp_host">SMTP Host</label>
            <input wire:model.defer="smtp_host" type="text" class="form-control" id="smtp_host" required>
            @error('smtp_host')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="smtp_username">SMTP Username</label>
            <input wire:model.defer="smtp_username" type="text" class="form-control" id="smtp_username" required>
            @error('smtp_username')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="smtp_password">SMTP Password</label>
            <input wire:model.defer="smtp_password" type="password" class="form-control" id="smtp_password" required>
            @error('smtp_password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="smtp_port">SMTP Port</label>
            <input wire:model.defer="smtp_port" type="text" class="form-control" id="smtp_port" required>
            @error('smtp_port')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="smtp_from_name">From Name</label>
            <input wire:model.defer="smtp_from_name" type="text" class="form-control" id="smtp_from_name" required>
            @error('smtp_from_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="smtp_from_email">From Email</label>
            <input wire:model.defer="smtp_from_email" type="email" class="form-control" id="smtp_from_email" required>
            @error('smtp_from_email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="mailer_type">Mailer Type</label>
            <select wire:model.defer="mailer_type" class="form-control" id="mailer_type" required>
                <option value="Gmail">Gmail</option>
                <option value="Brevo">Brevo</option>
                <option value="GetResponse">GetResponse</option>
            </select>
            @error('mailer_type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </form>

    @if (session('status') === 'smtp-saved')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'SMTP Settings Updated',
                    text: 'Your SMTP settings have been updated successfully!',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        </script>
    @endif
</div>
