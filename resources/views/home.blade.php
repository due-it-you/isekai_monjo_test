<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <!-- エラー表示 -->
    <div>  
        @if ($errors->any())  
            <ul>  
                @foreach ($errors->all() as $error)  
                    <li>{{ $error }}</li>  
                @endforeach  
            </ul>  
        @endif  
    </div>

    <!-- 投稿フォーム -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("言葉の定義をしましょう。") }}
                    <button class="bg-blue-600 hover:bg-blue-500 text-white rounded px-4 py-2" onclick="location.href='{{  route('post.create') }}' ">定義する</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 検索フォーム -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <p class="text-xl font-extrabold">検索フォーム</p>
                <form action="{{ route('posts.search') }}" method="POST">   
                    @csrf
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input name="search" type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
                        <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
            </div> 
        </div>    
    </div>
        <!-- 投稿の一覧表示 -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <p class="text-xl font-extrabold">投稿一覧</p>
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
                    <form method="POST" action="{{ route('post.destroy', ['id' => $post->id]) }}">
                        @csrf
                    <button type="submit" class="btn btn-danger text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">削除</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="flex justify-center py-3">
          <li class="mx-2">
            {{ $posts->links() }}
          </li>
        </ul>
    </nav>
      
</div>
</x-app-layout>