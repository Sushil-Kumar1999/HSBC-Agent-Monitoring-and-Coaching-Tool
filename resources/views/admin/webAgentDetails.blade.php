<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Web Agent: {{$user->name}} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><b>Email:</b> {{$user->email}}</p>
                    <p><b>Supervisor:</b><a href="{{route('admin.supervisorDetails', [$supervisor])}}"> {{$supervisor->name}}</a></p>
                    <p><b>Team:</b> {{$user->team()->first()->name}}</p>
                    <p></p>


                    @if (Auth::user()->role == 'Admin')
                            <form action="{{ route('admin.editWebAgent', ['user' => $user]) }}" method="post">
                                @csrf
                                @method('GET')
                                <button type='sumbit'>Edit</button>
                            </form>
                            <form action="{{ route('admin.destroyWebAgent', ['user' => $user]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='sumbit'>Delete</button>
                            </form>
                    @endif
                    <a href="{{route('admin.showWebAgents')}}">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>