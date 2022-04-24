<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Supervisor: {{$user->name}} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><b>Email:</b> {{$user->email}}</p>
                    <p></p>


                    @if ($webAgents == null)
                    <p><b>Team:</b></p>
                    <p><b>No Team Members</b></p>
                    @endif

                    @if (!$webAgents == null)
                    <p><b>Team:</b> {{$user->supervises->name}}</p>
                    <p><b>{{$user->supervises->name}}'s Members:</b></p>
                    <ul>
                        @foreach ($webAgents as $webAgent)
                            <li><a href="{{ route('admin.webAgentDetails', ['user' => $webAgent]) }}">{{ $webAgent->name }}</a></li>
                        @endforeach
                    </ul>
                    <p></p>
                    @endif

                    @if (Auth::user()->role == 'Admin')
                            <form action="{{ route('admin.editSupervisor', ['user' => $user]) }}" method="post">
                                @csrf
                                @method('GET')
                                <button type='sumbit'>Edit</button>
                            </form>
                            <form action="{{ route('admin.destroySupervisor', ['user' => $user]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='sumbit'>Delete</button>
                            </form>
                    @endif
                    <a href="{{route('admin.showSupervisors')}}">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>