<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update History') }}
        </h2>
    </x-slot>
    <div class="flex mx-auto w-10/12 justify-center">
            <div class="bg-white w-9/12 m-5 p-5 rounded-2xl drop-shadow-lg">
                <div>
                    @foreach ($postRevisionsArray as $postRevision)
                        <br>{{ $postRevision['created_at'] }}{{ "  " }}{{ $postRevision['user_id'] }}</br>
                        <br>{{ $postRevision['rev_content'] }}</br>
                    @endforeach
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