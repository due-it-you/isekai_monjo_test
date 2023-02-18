<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('更新する') }}
        </h2>
    </x-slot>

    <div style="width:50%; margin: 0 auto; text-align:center;" id="editor">
        @if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li class="text-red-600 font-bold">{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	    @endif
        <form  method="POST">
            @csrf
            <div>
                名前：
                <input name="name" value="{{ $post->user->name }}"/>
            </div>
            <div>
                タイトル：
                <input name="title" value="{{ $post->title }}"/>
            </div>
            <div>
                タグ：
                <input name="tag_label" id="tag_search" value=""/>
            </div>
            <div>
                <textarea name="content">{{ $post->content }}</textarea>
            </div>
            <button>送信</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script>
        const editor = new EditorJS({
    
            holder: 'editor',
    
            tools: {
                header: Header,        
            }
    
    });
    </script>
</x-app-layout>