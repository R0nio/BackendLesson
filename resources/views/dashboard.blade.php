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
                <div class=" bg-white overflow-hidden shadow-sm sm:rounded-lg border-solid border-2 border-gray-300  flex flex-col justify-center items-center p-4">
                    <img src="{{ $product->path_picture }}" class="w-[200px] h-[200px]"></img>
                    <p>Название продукта: {{ $product->name }}</p>
                    <p>Описание: {{ $product->description }}</p>
                    <p>Категория: {{ $product->category->category_name }}</p>
                    <p> Цена: {{ $product->price }} ₽</p>
                    <div>
                        <a href="{{ route('products.edit', $product->id) }}"></a>
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a href="{{ route('products.edit', $product->id) }}">
                            Изменить
                        </a>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('comment.create', $product->id) }}">
                            @csrf
                            <input type="text" name="description" placeholder="Оставьте комментарий...">
                            <button type="submit">
                                Опубликовать комментарий
                            </button>
                        </form>
                    </div>
                    <div class="flex w-full flex-col">
                        <div class="flex justify-start font-bold">
                            Комментарии: 
                        </div>
                        <div class="flex flex-col bg-slate-300 p-5">
                            @foreach ($product->comments as $comment )
                                <div class="flex flex-col w-full border bg-white rounded-md m-1 ">
                                    <div class="border flex justify-between">
                                       <div> {{ $comment->user->name }}</div><div>{{ $comment->created_at }}</div>
                                    </div>
                                    <div class="flex justify-center">
                                        {{ $comment->description }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>