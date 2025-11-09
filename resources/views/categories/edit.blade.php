<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактрование категории') }}
        </h2>
    </x-slot>
    <div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-200 max-w-full border-2 border-gray-500 p-6 h-auto">
                    <form action="{{ route ('categories.update', $category->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <label for="category_name">Новое название категории</label>
                        <input class="w-full" type="text" name="category_name" placeholder="Например: гарнитура">
                        <br>
                        <button class="w-auto border-2 border-gray-400 p-1 bg-white mt-3 text-[16px] font-medium" type="submit">Обновить</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>