<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Фото галереи') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="buttons flex">
                        <x-link :href="route('gallery.create')">Новая галерея</x-link>
                    </div>
                    <div class="filters">
                        <a href="{{ route('gallery.index') }}">Все</a>
                        <a href="{{ route('gallery.index', ['value' => 'isPublished']) }}">Опубликованные</a>
                        <a href="{{ route('gallery.index', ['value' => 'isDeleted']) }}">Удаленные</a>
                    </div>
                    <div class="box">
                        @php
                            foreach ($galleries as $gallery) :
                        @endphp
                        <div class="item">
                            <div class="title">{{ $gallery->title }}</div>
                            <div class="title">{{ $gallery->isPublished }}</div>
                            <div class="title">{{ $gallery->isDeleted }}</div>
                            <div class="actions flex">
                                <x-link class="mr-1" :href="route('gallery.show', $gallery)">Просмотр</x-link>
                                <x-link class="mr-1" :href="route('gallery.edit', $gallery)">Редактировать</x-link>
                                <form method="POST" class="mr-1"
                                      action="{{ route('gallery.publication', $gallery) }}">
                                    @csrf
                                    @method('PUT')
                                    <x-button>@if (!$gallery->isPublished) Опубликовать @else Скрыть @endif</x-button>
                                </form>
                                <form method="POST" class="mr-1"
                                      action="{{ route('gallery.destroy', $gallery) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-button>@if ($gallery->isDeleted) Восстановить @else Удалить @endif</x-button>
                                </form>
                            </div>
                        </div>
                        @php endforeach @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
