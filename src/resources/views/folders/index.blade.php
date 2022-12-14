<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フォルダ管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message />
                    <section class="text-gray-600 body-font">
                        <div class="flex justify-end w-full p-2 mb-4">
                            <a href="{{route('folders.create')}}" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</a>
                        </div>
                        <div class="flex flex-wrap -m-4">
                            @foreach ($folders as $folder)
                            <div class="lg:w-1/4 md:w-1/3 sm:w-1/2 w-full p-4">
                                <div class="mt-4">
                                    <a href="{{ route('folders.edit', ['folder' => $folder->id]) }}">
                                        <div class="folder_top"></div>
                                        <div class="folder_main">
                                            <p class="folder_name">{{ $folder->name }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    {{ $folders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>