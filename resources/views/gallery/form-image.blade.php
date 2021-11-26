<?php
/**
 * @var \App\Models\Gallery $gallery
 */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавление/Редактирование галереи') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="form">
                        <form method="POST"
                              action="{{ route('gallery.store-images', $gallery) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="mb-2">
                                <x-label for="files" :value="__('Добавление файлов')" />


                                <x-input
                                        id="files"
                                        type="file"
                                        name="files[]"
                                        accept="image/jpeg,image/png,image/gif"
                                        placeholder="Choose files"
                                        multiple />
                            </div>

                            <x-button>
                                {{ __('Сохранить') }}
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
