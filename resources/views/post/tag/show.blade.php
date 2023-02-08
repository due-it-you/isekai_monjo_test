<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('検索結果') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @foreach ($posts as $post)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-7 border border-gray-500">
                <p class="text-xl font-bold">{{ $post->title }}</p>
                @foreach($post->tags as $tag)
                <div>
                    <a href="/posts/search?tag={{ $tag->tag_label }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">#{{ $tag->tag_label }}</a>
                </div>
                @endforeach
                <p>{{ $post->content }}</p>
                <p>{{ $post->created_at }}</p>
                <p>by {{ $post->user->name }}</p>
            </div>
            @endforeach
        </div>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="flex justify-center py-3">
          <li class="mx-2">
            {{ $posts->links() }}
          </li>
        </ul>
    </nav>
</x-app-layout>