<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('定義する') }}
        </h2>
    </x-slot>

    <div style="width:50%; margin: 0 auto; text-align:center;">
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

            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">タグを選んでください。</label>
            <select name="tag_label" id="tag_label" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option disabled value="0">タグを選択してください。</option>
                <option value="歌い手">歌い手</option>
                <option value="Vtuber">Vtuber</option>
                <option value="アニメ">アニメ</option>
                <option value="漫画">漫画</option>
            </select>

            <button>送信</button>
        </form>
    </div>
</x-app-layout>