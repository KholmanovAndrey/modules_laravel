<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Галереи') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="buttons flex">
                        <x-link :href="route('gallery.create')">Новая галерея</x-link>
                    </div>
                    <div class="filters mt-2">
                        <a href="{{ route('gallery.index') }}">Все</a>
                        <a href="{{ route('gallery.index', ['value' => 'isPublished']) }}">Опубликованные</a>
                        <a href="{{ route('gallery.index', ['value' => 'isDeleted']) }}">Удаленные</a>
                    </div>
                    <div class="box">
                        <div class="image mt-2 p-2 flex justify-between items-center bg-gray-900 text-white">
                            <div class="w-1/2">Наименование</div>
                            <div class="w-1/12 text-center">Публикация</div>
                            <div class="w-1/12 text-center">Удалено</div>
                            <div class="w-4/12 text-right">Действия</div>
                        </div>
                        @foreach ($galleries as $gallery)
                        <div class="item mt-2 flex justify-between items-center">
                            <div class="title w-1/2">
                                <div>{{ $gallery->title }}</div>
                                <div>{{ $gallery->description }}</div>
                            </div>
                            <div class="isPublished w-1/12 text-center">{{ $gallery->isPublished ? 'Да' : 'Нет' }}</div>
                            <div class="isDeleted w-1/12 text-center">{{ $gallery->isDeleted ? 'Да' : 'Нет' }}</div>
                            <div class="actions w-4/12 flex flex-wrap justify-end">
                                <div class="mr-1 mb-1">
                                    <x-link :href="route('gallery.show', $gallery)">Просмотр</x-link>
                                </div>
                                <div class="mr-1 mb-1">
                                    <x-link :href="route('gallery.edit', $gallery)">Редактировать</x-link>
                                </div>
                                <form method="POST" class="mr-1 mb-1"
                                      action="{{ route('gallery.publication', $gallery) }}">
                                    @csrf
                                    @method('PUT')
                                    <x-button>@if (!$gallery->isPublished) Опубликовать @else Скрыть @endif</x-button>
                                </form>
                                <form method="POST" class="mr-1 mb-1"
                                      action="{{ route('gallery.destroy', $gallery) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-button>@if ($gallery->isDeleted) Восстановить @else Удалить @endif</x-button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
