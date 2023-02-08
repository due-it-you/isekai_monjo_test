<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @foreach($posts as $post)
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-7 border border-gray-500">
                    <p class="font-bold font-xl">{{ $post->title }}</p>
                    <p>{{ $post->content }}</p>
                    <p>{{ $post->created_at }}</p>
                    <p>{{ $post->name }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>