<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список категорий') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 gap-4">


                @foreach($categories as $category)
                <div class="bg-gray-200 max-w-[310px] border-2 border-gray-500 p-6 h-[180px]">
                    <p class="w-50 font-medium text-xl mb-3">Название категории: <br>{{ $category->category_name }} </p>
                    <div class="flex w-full justify-between h-10 items-center mt-6">


                        <a class="w-[120px] h-[48px] border-2 border-gray-400 flex justify-center items-center bg-white text-[16px] font-medium " href="{{ route('categories.edit', $category->id) }}">Edit</a>
                        <form class="w-auto" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="w-[80px] h-[48px] border-2 border-gray-400 bg-white text-[16px] font-medium flex justify-center items-center" type="submit">Delete</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</x-app-layout>