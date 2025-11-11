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
            <div class="mt-5 flex flex-col gap-5">
                @if ($products->isEmpty())
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-solid border-2 border-gray-300  flex flex-row justify-center p-4">
                        <p>Ничего нету</p>
                    </div>
                @endif

                @foreach ($products as $product)
                    <div
                        class=" bg-white overflow-hidden shadow-sm sm:rounded-lg border-solid border-2 border-gray-300  flex  justify-between items-center p-4">
                        <div class="flex gap-5 items-center">
                            <div class="w-[200px] h-[200px]">
                                <img src="{{ $product->path_picture }}" class="w-[200px] h-[200px]"></img>
                            </div>
                            <div class="flex flex-col ">
                                <p>Название продукта: {{ $product->name }}</p>
                                <p>Описание: {{ $product->description }}</p>
                                <p>Категория: {{ $product->category->category_name }}</p>
                                <p> Цена: {{ $product->price }} ₽</p>
                            </div>
                        </div>

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
                        <div class="w-[400px]">
                            <form class="flex flex-col justify-center " method="POST"
                                action="{{ route('comment.create', $product->id) }}">
                                @csrf
                                <input type="text" name="description" placeholder="Оставьте комментарий...">
                                <button type="submit"
                                    class="text-center border my-2 p-1 border-black rounded-lg bg-white transition-all hover:bg-slate-300">
                                    Опубликовать
                                </button>
                            </form>

                            <div class="flex w-full flex-col">
                                <div class="flex justify-start font-bold">
                                    Комментарии:
                                </div>

                                @if ($product->comments->count() <= 0)
                                    <div class="flex justify-center bg-slate-200 rounded-lg">
                                        <div class="opacity-30">
                                            На этот товар нету отзывов!
                                        </div>

                                    </div>
                                @else
                                    <div
                                        class="flex flex-col bg-slate-200 p-5 h-[100px] overflow-y-auto overflow-x-hidden">
                                        @foreach ($product->comments as $comment)
                                            <div class="flex flex-col w-full border bg-white rounded-md m-1 ">
                                                <div class="border flex justify-between">
                                                    <div class="flex justify-start gap-2">
                                                        <div> {{ $comment->user->name }}</div>
                                                        <div>{{ $comment->created_at }}</div>
                                                    </div>
                                                    <div class="mr-1 hover:underline transition-all">
                                                        <form method="POST" action="{{route('comment.delete', $comment->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="underline" type="submit">
                                                                Удалить
                                                            </button>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                                <div class="flex justify-center">
                                                    {{ $comment->description }}
                                                </div>
                                            </div>
                                        @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
            </div>
            @endforeach

        </div>
    </div>
    </div>
</x-app-layout>
