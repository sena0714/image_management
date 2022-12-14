<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フォルダ登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-24 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <x-input-error :messages="$errors->all()" class="mb-4" />
                                <form method="post" action="{{ route('folders.store') }}">
                                    @csrf
                                    <div class="flex flex-wrap -m-2">
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label class="leading-7 text-sm text-gray-600">フォルダ名</label>
                                                <input type="text" name="name" required class="w-full  bg-opacity-50 rounded border border-gray-300 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <button type="button" id="image_select" class="bg-gray-200 border border-black py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">画像を選択</button>
                                            </div>
                                        </div>
                                        <div class="p-2 w-full flex justify-around mt-4">
                                            <a href="{{ route('folders.index') }}" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</a>
                                            <button type="submit" class="text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg">登録</button>
                                        </div>
                                    </div>

                                    <div id="modal_background" class="modal_background"></div>
                                    <div id="modal" class="modal_wrapper">
                                        <div class="modal_container">
                                            @foreach ($images as $image)
                                                <div class="modal_element">
                                                    <p>
                                                        <label for="img_{{ $image->id }}"><input type="checkbox" name="images[]" value="{{ $image->id }}" id="img_{{ $image->id }}">{{ $image->title }}</label>
                                                    </p>
                                                    <img src="{{ asset('storage/images/'.$image->filename) }}" alt="">
                                                </div>
                                            @endforeach
                                            <div class="w-full text-center mt-4">
                                                <button type="button" id="image_close" class="bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">閉じる</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>

    <script>
        'use strict'

        document.getElementById('image_select').addEventListener('click', function() {
            document.getElementById('modal_background').classList.add('open');
            document.getElementById('modal').classList.add('open');
        });

        document.getElementById('image_close').addEventListener('click', function() {
            document.getElementById('modal_background').classList.remove('open');
            document.getElementById('modal').classList.remove('open');
        });
    </script>
</x-app-layout>