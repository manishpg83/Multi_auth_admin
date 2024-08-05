@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <!-- Upload Client Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">
                Upload Client
            </h2>
            <div class="mt-4">
                @livewire('client-form-component')
            </div>
        </div>

        <!-- Bulk Upload Clients Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-10">
            <h2 class="text-2xl font-semibold mb-4 flex items-center">
                Bulk Upload Clients
                <!-- Hint Button -->
                <button id="show-hint" class="ml-4 flex items-center bg-blue-500 text-white py-1 px-2 text-sm rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <span class="mr-1">Hint</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13l3 3 3-3m0-6l-3 3-3-3"></path>
                    </svg>
                </button>
            </h2>
            
            <!-- Modal -->
            <div id="csv-hint-modal" class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 overflow-hidden">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">CSV Format Hint</h3>
                        <button id="close-modal" class="text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="text-gray-600 mb-4">
                        To bulk upload clients, please prepare your CSV file with the following format:
                    </p>
                    <pre class="bg-gray-100 rounded-lg p-4">
                        <code class="whitespace-pre-wrap">
                            first_name,last_name,email,company_name

                            John,Doe,john.doe@example.com,ExampleCorp
                        </code>
                    </pre>
                </div>
            </div>
            
            <div class="mt-4">
                @livewire('bulk-client-upload-component')
            </div>
        </div>
    </div>

    <!-- JavaScript to Toggle Modal Visibility -->
    <script>
        document.getElementById('show-hint').addEventListener('click', function() {
            document.getElementById('csv-hint-modal').classList.remove('hidden');
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('csv-hint-modal').classList.add('hidden');
        });

        // Close modal if clicked outside of it
        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('csv-hint-modal')) {
                document.getElementById('csv-hint-modal').classList.add('hidden');
            }
        });
    </script>
@endsection
