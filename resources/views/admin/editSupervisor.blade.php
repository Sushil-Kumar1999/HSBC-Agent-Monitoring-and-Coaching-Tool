<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Supervisor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.updateSupervisor', $user) }}">
                        @csrf

                        <label for="name">Name:</label>
                        <br></br>
                        <textarea input type="text" id="name" name="name" rows="1" cols="50" value="{{ old('name') }}"
                            >{{$user->name}}</textarea>
                        <br></br>

                        <label for="email">Email:</label>
                        <br></br>
                        <textarea input type="text" id="email" name="email" rows="1" cols="50" value="{{ old('email') }}"
                            >{{$user->email}}</textarea>
                        <br></br>

                        <label for="team_name">Team Name:</label>
                        <br></br>
                        <textarea input type="text" id="team_name" name="team_name" rows="1" cols="50" value="{{ old('team_name') }}"
                            >{{$user->supervises()->first()->name}}</textarea>
                        <br></br>

                        <button type='sumbit'>Edit</button>
                        <a href="{{route('admin.supervisorDetails', [$user])}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>