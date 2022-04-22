<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Web Agent') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.storeWebAgent') }}">
                        @csrf

                        <label for="name">Name:</label>
                        <br></br>
                        <textarea id="name" name="name" rows="1" cols="100" value="{{ old('name') }}"></textarea>
                        <br></br>

                        <label for="email">Email:</label>
                        <br></br>
                        <textarea id="email" name="email" rows="1" cols="100" value="{{ old('email') }}"></textarea>
                        <br><br>

                        <select name="team_name">
                            @foreach ($teams as $team)
                                <option value="{{ $team->name }}"
                                    @if ($team->name == old('team_name'))
                                        selected="selected"
                                    @endif
                                >{{ $team->name }}</option>
                            @endforeach
                        </select>
                        <br></br>

                        <button type='sumbit'>Submit</button>
                        <a href="{{route('admin.showWebAgents')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>