<x-app-layout>
    @if (auth()->user()->type === 'provider')
        @livewire('provider')
    @else
        @livewire('seeker')
    @endif
</x-app-layout>
