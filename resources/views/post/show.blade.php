<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="flex h-screen">
        <div class="bg-red-200 w-9/12 m-3">
           メイン 
        </div>
        <div class="float-right bg-blue-200 w-3/12 m-3">
            サイドバー
        </div>
    </div>
</x-app-layout>