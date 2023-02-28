<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>
    <div class="flex mx-auto w-10/12 justify-center">
            <div class="bg-white w-9/12 m-5 p-5 rounded-2xl drop-shadow-lg">
                <div>
                    <div class="text-4xl font-bold p-5 mt-4">
                        @csrf
                            <p class="text-4xl font-bold">{{ $post->title }}</p>
                    </div>
                    <hr class="border-gray-300 mx-5">
                </div>
                <div>
                    <div class="p-5 mt-4">
                        <div id="app" class="bg-neutral-100">
                            <div>
                                <edit-content-component :post="{{ $post }}"></edit-content-component>
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