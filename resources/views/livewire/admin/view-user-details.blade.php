<div class="max-w-6xl p-8 mx-auto mt-4 mb-14 bg-white rounded-lg shadow-xl">
    <div class="relative">
        <h3 class="px-6 py-1 mb-6 text-2xl font-bold text-white bg-blue-600 rounded-lg shadow-md">User Details</h3>
        <span class="absolute top-2 bottom-2 right-2 px-3 text-md font-semibold {{ $user->status === 'Active' ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }} rounded-full">
            {{ $user->status === 'Active' ? 'Active' : 'Inactive' }}
        </span>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 mt-8">
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">First Name:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->first_name }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Last Name:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->last_name }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Email:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->email }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Phone:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->phone }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Company Name:</span>
            <span class="text-md font-semibold text-gray-800 break-words">{{ $user->company_name }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Designation:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->designation }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Website:</span>
            <span class="text-md font-semibold text-gray-800 break-words">{{ $user->website }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Address:</span>
            <span class="text-md font-semibold text-gray-800 break-words">{{ $user->address }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Skype:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->skype }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Telegram:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->telegram }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">IMO:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->imo }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">WhatsApp:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->whatsapp }}</span>
        </div>
    
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-blue-600 mr-4">Logo:</span>
            <span class="text-md font-semibold text-gray-800 truncate max-w-xs">
                @if($user->logo)
                    <img src="{{ asset('storage/' . $user->logo) }}" alt="Logo" class="w-12 h-12 object-cover">
                @else
                    No Logo
                @endif
            </span>
        </div>
    </div>

    <h3 class="px-6 py-1 mt-10 mb-6 text-2xl font-bold text-white bg-green-600 rounded-lg shadow-md">SMTP Details</h3>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-green-600 mr-4">SMTP Host:</span>
            <span class="text-md font-semibold text-gray-800 break-words">{{ $user->smtpSettings->smtp_host ?? 'Not set' }}</span>
        </div>
        
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-green-600 mr-4">SMTP Username:</span>
            <span class="text-md font-semibold text-gray-800 break-words">{{ $user->smtpSettings->smtp_username ?? 'Not set' }}</span>
        </div>
        
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-green-600 mr-4">SMTP Port:</span>
            <span class="text-md font-semibold text-gray-800">{{ $user->smtpSettings->smtp_port ?? 'Not set' }}</span>
        </div>
        
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-green-600 mr-4">From Name:</span>
            <span class="text-md font-semibold text-gray-800 break-words">{{ $user->smtpSettings->smtp_from_name ?? 'Not set' }}</span>
        </div>
        
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-green-600 mr-4">From Email:</span>
            <span class="text-md font-semibold text-gray-800 break-words">{{ $user->smtpSettings->smtp_from_email ?? 'Not set' }}</span>
        </div>
        
        <div class="p-2 bg-gray-100 rounded-lg shadow-sm flex items-center">
            <span class="block text-sm font-medium text-green-600 mr-4">Mailer Type:</span>
            <span class="text-md font-semibold text-gray-800 break-words">{{ $user->smtpSettings->mailer_type ?? 'Not set' }}</span>
        </div>
    </div>

    <div class="mt-10">
        <h3 class="px-6 py-1 mb-6 text-2xl font-bold text-white bg-purple-600 rounded-lg shadow-md">User's Client List</h3>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 text-left">Name</th>
                        <th class="p-2 text-left">Email</th>
                        <th class="p-2 text-left">Company</th>
                        <th class="p-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($user->clients as $client)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2">{{ $client->first_name }} {{ $client->last_name }}</td>
                        <td class="p-2">{{ $client->email }}</td>
                        <td class="p-2">{{ $client->company_name }}</td>
                        <td class="p-2">
                            <span class="px-2 py-1 text-sm font-semibold {{ $client->status === 'Active' ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }} rounded-full">
                                {{ $client->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
