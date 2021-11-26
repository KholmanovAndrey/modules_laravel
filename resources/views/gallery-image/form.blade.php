<?php
/**
 * @var \App\Models\GalleryImage $image
 */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавление/Редактирование картинки') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="form">
                        <form method="POST"
                              action="@if (!$galleryImage->id) {{ route('gallery-image.store') }}
                                      @else{{ route('gallery-image.update', $galleryImage) }}@endif">
                            @csrf
                            @if ($galleryImage->id) @method('PUT') @endif

                            <div class="mb-2">
                                <x-label for="title" :value="__('Наименование')" />

                                <x-input
                                        id="title"
                                        class="block mt-1 w-full"
                                        type="text"
                                        name="title"
                                        :value="$galleryImage->title ?? old('title')"
                                        required autofocus />
                            </div>

                            <div class="mb-2">
                                <x-label for="name" :value="__('Название для вкладки alt')" />

                                <x-input
                                        id="name"
                                        class="block mt-1 w-full"
                                        type="text"
                                        name="name"
                                        :value="$galleryImage->name ?? old('name')"
                                        required />
                            </div>

                            <div class="mb-2">
                                <x-label for="description" :value="__('Описание')" />

                                <x-input
                                        id="description"
                                        class="block mt-1 w-full"
                                        type="text"
                                        name="description"
                                        :value="$galleryImage->description ?? old('description')"
                                        required />
                            </div>

                            <div class="mb-2">
                                <x-label for="position" :value="__('Описание')" />

                                <x-input
                                        id="position"
                                        class="block mt-1 w-full"
                                        type="text"
                                        name="position"
                                        :value="$galleryImage->position ?? old('position')"
                                        required />
                            </div>

                            <div class="mb-2">
                                <x-label for="isPublished" :value="__('Публикация')" />

                                <x-select
                                        id="isPublished"
                                        class="block mt-1 w-full"
                                        name="isPublished"
                                        required>
                                    <option value="1" @if ($galleryImage->isPublished) selected="selected" @endif>Опубликованно</option>
                                    <option value="0" @if (!$galleryImage->isPublished) selected="selected" @endif>Скрыто</option>
                                </x-select>
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
