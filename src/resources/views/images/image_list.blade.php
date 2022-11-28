<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            画像一覧
        </h2>
    </x-slot>

    <div class="content_wrapper">
        <div class="content_container">
            <div class="side_container">
                <a href="{{ route('image_list.index') }}" class="folder_change_link {{ !isset($folderId) ? 'action' : ''}}">すべて</a>

                @foreach ($folders as $folder)
                    <a href="{{ route('image_list.filtering', ['folder' => $folder->id]) }}" class="folder_change_link {{(isset($folderId) && $folderId === $folder->id) ? 'action' : ''}}">{{ $folder->name }}</a>
                @endforeach
            </div>
            <div class="main_container">
                <div class="flex flex-wrap -m-4">
                    @foreach ($images as $image)
                    <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                        <div class="mt-4">
                            <h2 class="text-gray-900 title-font text-lg font-medium">
                                <button type="button" class="js_image_download">download!</button>
                                {{ $image->title }}
                            </h2>
                        </div>
                        <img src="{{ asset('storage/images/'.$image->filename) }}" class="bg-cover h-40">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>