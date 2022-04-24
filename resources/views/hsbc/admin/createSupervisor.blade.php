<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Supervisor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.storeSupervisor') }}">
                        @csrf

                        <label for="name">Name:</label>
                        <br></br>
                        <textarea id="name" name="name" rows="1" cols="100" value="{{ old('name') }}"></textarea>
                        <br></br>

                        <label for="email">Email:</label>
                        <br></br>
                        <textarea id="email" name="email" rows="1" cols="100" value="{{ old('email') }}"></textarea>
                        <br><br>

                        <label for="team_name">Team Name:</label>
                        <br></br>
                        <textarea id="team_name" name="team_name" rows="1" cols="100" value="{{ old('team_name') }}"></textarea>
                        <br><br>

                        <button type='sumbit'>Submit</button>
                        <a href="{{route('admin.showSupervisors')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>