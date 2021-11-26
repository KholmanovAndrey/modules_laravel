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
                    <h1 class="title">{{ $gallery->title }}</h1>
                    <div class="description">{{ $gallery->description }}</div>
                    <div class="isPublished">Публикация: {{ $gallery->isPublished ? 'Да' : 'Нет' }}</div>
                    <div class="isDeleted">Удалено: {{ $gallery->isDeleted ? 'Да' : 'Нет' }}</div>
                    <div class="actions flex justify-end mb-2">
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
                        <x-link :href="route('gallery.add-images', $gallery)">Новые картинки</x-link>
                    </div>
                    <div class="box">
                        <div class="image mt-2 p-2 flex justify-between items-center bg-gray-900 text-white">
                            <div class="w-1/4">Картинка</div>
                            <div class="w-1/4 pl-2">Наименование</div>
                            <div class="w-1/12 text-center">Позиция</div>
                            <div class="w-1/12 text-center">Публикация</div>
                            <div class="w-1/12 text-center">Удалено</div>
                            <div class="w-3/12 text-right">Действия</div>
                        </div>
                        @foreach ($gallery->images as $image)
                            <div class="image mt-2 flex justify-between items-center">
                                <div class="image__img w-1/4">
                                    <img
                                            src="{{ "/storage/galleries/{$gallery->id}/" . $image->image }}"
                                            alt="{{ $image->name }}">
                                </div>
                                <div class="w-1/4 pl-2">
                                    <div class="image__title">{{ $image->title }}</div>
                                    <div class="image__description">{{ $image->description }}</div>
                                </div>
                                <div class="image__position w-1/12 text-center">{{ $image->position }}</div>
                                <div class="image__isPublished w-1/12 text-center">{{ $image->isPublished ? 'Да' : 'Нет' }}</div>
                                <div class="image__isDeleted w-1/12 text-center">{{ $image->isDeleted ? 'Да' : 'Нет' }}</div>
                                <div class="image__actions w-3/12 flex justify-end flex-wrap">
                                    <div class="mr-1 mb-1">
                                        <x-link :href="route('gallery-image.show', $image)">Просмотр</x-link>
                                    </div>
                                    <div class="mr-1 mb-1">
                                        <x-link :href="route('gallery-image.edit', $image)">Редактировать</x-link>
                                    </div>
                                    <form class="mr-1 mb-1" method="POST"
                                          action="{{ route('gallery-image.publication', $image) }}">
                                        @csrf
                                        @method('PUT')
                                        <x-button>@if (!$image->isPublished) Опубликовать @else Скрыть @endif</x-button>
                                    </form>
                                    <form class="mr-1 mb-1" method="POST"
                                          action="{{ route('gallery-image.destroy', $image) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-button>@if ($image->isDeleted) Восстановить @else Удалить @endif</x-button>
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
