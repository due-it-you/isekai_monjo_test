<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('更新する') }}
        </h2>
    </x-slot>

    <div id="app" class="bg-neutral-300">
        <div id="editor">
            <edit-component></edit-component>
        </div>
    </div>
</x-app-layout>