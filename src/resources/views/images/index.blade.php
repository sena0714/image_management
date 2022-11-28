<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            画像管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-flash-message />
                    <section class="text-gray-600 body-font">
                        <div class="flex justify-end w-full p-2 mb-4">
                            <a href="{{route('images.create')}}" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</a>
                        </div>
                        <div class="flex flex-wrap -m-4">
                            @foreach ($images as $image)
                            <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                                <div class="mt-4">
                                    <h2 class="text-gray-900 title-font text-lg font-medium">{{ $image->title }}</h2>
                                </div>
                                <a href="{{ route('images.edit', ['image' => $image->id]) }}" class="block relative h-48 rounded overflow-hidden">
                                    <img src="{{ asset('storage/images/'.$image->filename) }}" class="bg-cover h-40">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </section>
                    {{ $images->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>