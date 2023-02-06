<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('定義する') }}
        </h2>
    </x-slot>

    <div style="width:50%; margin: 0 auto; text-align:center;">
        @if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li class="text-red-600 font-bold">{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	    @endif
        <form action="{{ route('post.store') }}" method="POST">
            @csrf
            <div>
                名前：
                <input name="name" value="名前の入力欄"/>
            </div>
            <div>
                タイトル：
                <input name="title" placeholder="タイトルの入力欄"/>
            </div>
            <div>
                <textarea name="content" placeholder="内容の入力"></textarea>
            </div>

            <div class="m-2 p-2">
                <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select
                    tags</label>
                <select id="tags" name="tags[]"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->tag_label }}</option>
                    @endforeach
                </select>
            </div>

            <button>送信</button>
        </form>
    </div>
</x-app-layout>