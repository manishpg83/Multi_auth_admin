<!-- resources/views/livewire/smtp-form-component.blade.php -->
<section class="mt-8">
    <header>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update SMTP Settings.') }}
        </p>
    </header>
    <form wire:submit.prevent="saveAndSendTestEmail">
        <div class="mb-3 row">
            <div class="mt-2 col-md-6">
                <label for="mailer_type" class="block text-sm font-medium text-gray-700">Mailer Type</label>
                <select wire:model="mailer_type" wire:change="changeMailerType($event.target.value)"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md @error('mailer_type') border-red-500 @enderror"
                    id="mailer_type" required>
                    <option value="">Select Mailer Type</option>
                    <option value="Gmail">Gmail</option>
                    <option value="Brevo">Brevo</option>
                    <option value="GetResponse">GetResponse</option>
                </select>
                @error('mailer_type')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <div class="mt-2 col-md-6">
                <label for="smtp_host" class="block text-sm font-medium text-gray-700">SMTP Host</label>
                <input wire:model.defer="smtp_host" type="text"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('smtp_host') border-red-500 @enderror"
                    id="smtp_host" required>
                @error('smtp_host')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-2 col-md-6">
                <label for="smtp_username" class="block text-sm font-medium text-gray-700">SMTP Username</label>
                <input wire:model.defer="smtp_username" type="text"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('smtp_username') border-red-500 @enderror"
                    id="smtp_username" required>
                @error('smtp_username')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <div class="mt-2 col-md-6">
                <label for="smtp_password" class="block text-sm font-medium text-gray-700">SMTP Password</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input wire:model.defer="smtp_password" 
                        type="{{ $passwordVisibility ? 'text' : 'password' }}"
                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md @error('smtp_password') border-red-500 @enderror"
                        id="smtp_password" required>
                    <button type="button" wire:click="togglePasswordVisibility"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center">
                        <i class="{{ $passwordVisibility ? 'fas fa-eye-slash' : 'fas fa-eye' }} text-gray-400"></i>
                    </button>
                </div>
                @error('smtp_password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-2 col-md-6">
                <label for="smtp_port" class="block text-sm font-medium text-gray-700">SMTP Port</label>
                <input wire:model.defer="smtp_port" type="number"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('smtp_port') border-red-500 @enderror"
                    id="smtp_port" required>
                @error('smtp_port')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <div class="mt-2 col-md-6">
                <label for="smtp_from_name" class="block text-sm font-medium text-gray-700">From Name</label>
                <input wire:model.defer="smtp_from_name" type="text"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('smtp_from_name') border-red-500 @enderror"
                    id="smtp_from_name" required>
                @error('smtp_from_name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-2 col-md-6">
                <label for="smtp_from_email" class="block text-sm font-medium text-gray-700">From Email</label>
                <input wire:model.defer="smtp_from_email" type="email"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('smtp_from_email') border-red-500 @enderror"
                    id="smtp_from_email" required>
                @error('smtp_from_email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-4 flex justify-end space-x-3">
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Save and Send Test Email') }}
            </button>
            <button type="button" wire:click="saveSmtpSettings"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ __('Save') }}
            </button>
            <button type="button" onclick="showHint()"
                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-200 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Hint') }}
            </button>
        </div>

        <div wire:loading class="mt-4">
            <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-indigo-500 hover:bg-indigo-400 transition ease-in-out duration-150 cursor-not-allowed">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            </div>
        </div>
    </form>
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

    <script>
        function showHint() {
            document.getElementById('hintModal').classList.remove('hidden');
        }

        function hideHint() {
            document.getElementById('hintModal').classList.add('hidden');
        }

        document.addEventListener('livewire:load', function() {
            Livewire.on('smtp-saved-and-email-sent', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'SMTP settings saved and test email sent successfully!',
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

            Livewire.on('smtp-validation-failed', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid SMTP Settings',
                    text: 'Please check your SMTP credentials and try again.',
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        });
    </script>
</section>
