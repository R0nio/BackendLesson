<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Главная') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-solid border-2 border-gray-300  ">
                <div class="p-6 text-gray-900">
                    Добро пожаловать! <br>Ниже представлен список нашего товара
                </div>
            </div>
            <div class="grid grid-cols-4 mt-4 justify-items-center gap-4">

                @if($products->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-solid border-2 border-gray-300 w-[280px] h-[400px] flex flex-row justify-center p-4">
                    <p>Ничего нету</p>
                </div>
                @endif

                @foreach($products as $product)
                <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg border-solid border-2 border-gray-300 w-[280px] h-[400px] flex flex-col justify-center items-center p-4">
                    <img src="{{ $product->path_picture }}" class="w-[200px] h-[250px]"></img>
                    <p>Название продукта: {{ $product->name }}</p>
                    <p>Описание: {{ $product->description }}</p>
                    <p> Цена: {{ $product->price }} ₽</p>
                    <div>
                        <a href="{{ route('products.edit', $product->id) }}"></a>
                        <form action="{{ route('products.destroy', $product->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>