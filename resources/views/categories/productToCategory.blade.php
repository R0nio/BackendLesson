<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Категории') }}
        </h2>
    </x-slot>
    <div class="space-y-8">
    @foreach($categories as $category)
        <div class="border-b-2 border-gray-300 pb-2">
            <h1 class="text-2xl font-bold text-gray-800">{{ $category->category_name }}</h1>
        </div>

        @if($category->products->isEmpty())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-300 w-full p-6 text-center">
                <p class="text-gray-500">В этой категории пока нет товаров</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-4 ">
                @foreach($category->products as $product)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-300 flex flex-col justify-between p-4 h-full">
                        @if($product->path_picture)
                            <img src="{{ $product->path_picture }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-md">
                                <span class="text-gray-500">Нет изображения</span>
                            </div>
                        @endif
                        <div class="mt-4 flex-grow">
                            <h3 class="font-semibold text-lg mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $product->description }}</p>
                            <p class="text-green-600 font-bold text-lg mb-4">{{ $product->price }} ₽</p>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <a href="{{ route('products.edit', $product->id) }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Изменить
                            </a>
                            <form method="POST" action="{{ route('products.destroy', $product->id) }}" 
                                  onsubmit="return confirm('Удалить этот товар?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
</div>
</x-app-layout>