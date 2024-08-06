<!-- resources/views/livewire/smtp-form-component.blade.php -->
<section class="mt-8">
    <header>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update SMTP Settings.') }}
        </p>
    </header>
    <form wire:submit.prevent="updateSmtpSettings">
        <!-- Move mailer_type field to the top -->
        <div class="mb-3 row">
            <div class="mt-2 col-md-6">
                <label for="mailer_type">Mailer Type</label>
                <select wire:model="mailer_type" wire:change="changeMailerType($event.target.value)"
                    class="form-control @error('mailer_type') is-invalid @enderror" id="mailer_type" required>
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
        <!-- Rest of the fields -->
        <div class="mb-3 row">
            <div class="mt-2 col-md-6">
                <label for="smtp_host">SMTP Host</label>
                <input wire:model.defer="smtp_host" type="text" class="form-control" id="smtp_host" required>
                @error('smtp_host')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2 col-md-6">
                <label for="smtp_username">SMTP Username</label>
                <input wire:model.defer="smtp_username" type="text" class="form-control" id="smtp_username" required>
                @error('smtp_username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2 col-md-6">
                <label for="smtp_password">SMTP Password</label>
                <input wire:model.defer="smtp_password" type="password" class="form-control" id="smtp_password"
                    required>
                @error('smtp_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2 col-md-6">
                <label for="smtp_port">SMTP Port</label>
                <input wire:model.defer="smtp_port" type="text" class="form-control" id="smtp_port" required>
                @error('smtp_port')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2 col-md-6">
                <label for="smtp_from_name">From Name</label>
                <input wire:model.defer="smtp_from_name" type="text" class="form-control" id="smtp_from_name"
                    required>
                @error('smtp_from_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2 col-md-6">
                <label for="smtp_from_email">From Email</label>
                <input wire:model.defer="smtp_from_email" type="email" class="form-control" id="smtp_from_email"
                    required>
                @error('smtp_from_email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="gap-2 mt-4 d-flex align-items-center justify-content-end">
            <button wire:click="sendTestEmail" class="btn btn-secondary">{{ __('Send Test Email') }}</button>
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            <button type="button" class="btn btn-secondary" onclick="showHint()">{{ __('Hint') }}</button>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        
        <!-- Hint Modal -->
        <div id="hintModal" class="fixed inset-0 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="max-w-md p-6 mx-auto bg-white rounded shadow-md overflow-y-auto max-h-[80vh]">
                <h2 class="mb-4 text-xl font-semibold">How to Fill SMTP Settings</h2>
                <p><strong>Mailer Type:</strong> Select the type of mailer you are using (e.g., Gmail, Brevo,
                    GetResponse).</p>
                <p><strong>SMTP Host:</strong> The server address of your SMTP provider (e.g., smtp.gmail.com for
                    Gmail).</p>
                <p><strong>SMTP Username:</strong> Your SMTP account username.</p>
                <p><strong>SMTP Password:</strong> Your SMTP account password.</p>
                <p><strong>SMTP Port:</strong> The port used by your SMTP server (e.g., 587 for Gmail).</p>
                <p><strong>From Name:</strong> The name that will appear in the 'From' field of your emails.</p>
                <p><strong>From Email:</strong> The email address that will appear in the 'From' field of your emails.
                </p>
                <div class="mt-4 text-right">
                    <button type="button" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700"
                        onclick="hideHint()">Close</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function showHint() {
            document.getElementById('hintModal').classList.remove('hidden');
        }

        function hideHint() {
            document.getElementById('hintModal').classList.add('hidden');
        }

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
