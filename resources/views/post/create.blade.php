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
                タグ：
                <input name="tag_label" id="tag_search" placeholder="タグの入力欄"/>
            </div>
            <div>
                <textarea name="content" placeholder="内容の入力"></textarea>
            </div>
            <button>送信</button>
        </form>
    </div>
</x-app-layout>