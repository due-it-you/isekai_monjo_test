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
                    <h2>{{ $post->title }}</h2>
                    @foreach ($post->content['blocks'] as $block)
                        @if ($block['type'] === 'header')
                            <h{{ $block['data']['level'] }} class="block_h{{ $block['data']['level'] }}">{{ $block['data']['text'] }}</h{{ $block['data']['level'] }}>

                        @elseif ($block['type'] === 'paragraph')
                            <p>{{ $block['data']['text'] }}</p>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>