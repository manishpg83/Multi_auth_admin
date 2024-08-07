<div class="max-w-4xl p-6 mx-auto mt-1 bg-white rounded-lg shadow-lg">
    <h2 class="mb-6 text-3xl font-bold text-gray-900">User Details</h2>
    
    <div class="space-y-4">
        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">ID:</span>
            <span class="text-gray-900">{{ $user->user_id }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">First Name:</span>
            <span class="text-gray-900">{{ $user->first_name }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Last Name:</span>
            <span class="text-gray-900">{{ $user->last_name }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Email:</span>
            <span class="text-gray-900">{{ $user->email }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Phone:</span>
            <span class="text-gray-900">{{ $user->phone }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Company Name:</span>
            <span class="text-gray-900">{{ $user->company_name }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Designation:</span>
            <span class="text-gray-900">{{ $user->designation }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Logo:</span>
            <span class="text-gray-900">{{ $user->logo }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Website:</span>
            <span class="text-gray-900">{{ $user->website }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Address:</span>
            <span class="text-gray-900">{{ $user->address }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Skype:</span>
            <span class="text-gray-900">{{ $user->skype }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Telegram:</span>
            <span class="text-gray-900">{{ $user->telegram }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">IMO:</span>
            <span class="text-gray-900">{{ $user->imo }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">WhatsApp:</span>
            <span class="text-gray-900">{{ $user->whatsapp }}</span>
        </div>
        <div class="flex items-center">
            <span class="w-32 font-semibold text-gray-700">Status:</span>
            <span class="text-gray-900">{{ $user->status }}</span>
        </div>
    </div>
</div>
