<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
                        <form action="{{ route('users.index') }}" method="GET" class="mb-4">
                            <b>Start date:</b>
                            <br/>
                            From:
                            <x-input type="text" name="start_date_from" id="start_date_from" value="{{ request('start_date_from') }}" />
                            To:
                            <x-input type="text" name="start_date_to" id="start_date_to" value="{{ request('start_date_to') }}" />
                            <x-button class="ml-4">Filter</x-button>
                        </form>

                        <table class="min-w-full divide-y divide-gray-200 border">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</span>
                                </th>
                                <th class="px-6 py-3 bg-gray-50 text-left">
                                    <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Start date</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            @foreach($users as $user)
                                <tr class="bg-white">
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        {{ $user->start_date->format('m/d/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
    <script>
        var picker1 = new Pikaday({
            field: document.getElementById('start_date_from'),
            format: 'MM/DD/YYYY',
        });
        var picker2 = new Pikaday({
            field: document.getElementById('start_date_to'),
            format: 'MM/DD/YYYY',
        });
    </script>

</x-app-layout>
