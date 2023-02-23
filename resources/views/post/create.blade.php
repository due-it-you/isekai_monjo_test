<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>
    <div class="flex mx-auto w-10/12 justify-center">
            <div class="bg-white w-9/12 m-5 p-5 rounded-2xl drop-shadow-lg">
                <div>
                    <div class="text-4xl font-bold p-5 mt-4">
                        @csrf
                            <input v-model="title" name="title" type="text" placeholder="Type Title Here..." class="text-4xl font-bold">
                    </div>
                    <hr class="border-gray-300 mx-5">
                </div>
                <div>
                    <div class="p-5 mt-4">
                        <div id="app" class="bg-neutral-100">
                            <div>
                                <create-content-component></create-content-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="float-right bg-white w-3/12 m-5 rounded-2xl drop-shadow-lg">
                サイドバー
            </div>
    </div>
    <script>
        window.csrfToken = "{{ csrf_token() }}";
    </script>
</x-app-layout>

{{-- <x-app-layout>
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
</x-app-layout> --}}