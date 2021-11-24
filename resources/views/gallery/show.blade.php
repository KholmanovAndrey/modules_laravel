<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($gallery->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="description">{{ $gallery->description }}</div>
                    <div class="actions flex mb-1">
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
                    <div class="buttons flex">
                        <x-link :href="route('gallery-image.create')">Новое фото</x-link>
                    </div>
                    <div class="box">
                        @foreach ($gallery->images as $image)
                            <div class="image">
                                <div class="image__img"><img src="{{ $image->url }}" alt="{{ $image->name }}"></div>
                                <div class="image__title">{{ $image->title }}</div>
                                <div class="image__description">{{ $image->description }}</div>
                                <div class="image__description">{{ $image->description }}</div>
                                <div class="image__actions flex">
                                    <x-link class="mr-1" :href="route('gallery-image.show', $image)">Просмотр</x-link>
                                    <x-link class="mr-1" :href="route('gallery-image.edit', $image)">Редактировать</x-link>
                                    <form class="mr-1" method="POST"
                                          action="{{ route('gallery-image.publication', $image) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-button>@if ($gallery->isPublished) Опубликовать @else Скрыть @endif</x-button>
                                    </form>
                                    <form class="mr-1" method="POST"
                                          action="{{ route('gallery-image.destroy', $image) }}">
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
