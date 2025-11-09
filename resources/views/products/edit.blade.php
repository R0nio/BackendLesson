<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактрование продукта') }}
        </h2>
    </x-slot>
    <div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-200 max-w-full border-2 border-gray-500 p-6 h-auto">
                    <form action="{{ route ('products.update', $category->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <label for="name">Название продукта</label>
                        <input class="w-full" type="text" name="name" placeholder="Диван">
                        <br>
                        <label for="description">Описание</label>
                        <input class="w-full" type="text" name="description" placeholder="Красивый диван">
                        <br>
                        <label for="price">Цена</label>
                        <input class="w-full" type="number" name="price" placeholder="1000.00">
                        <br>
                        <label for="path_picture">Картинка</label>
                        <input class="w-full" type="file" name="path_picture">
                        <button class="w-auto border-2 border-gray-400 p-1 bg-white mt-3 text-[16px] font-medium" type="submit">Обновить</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>