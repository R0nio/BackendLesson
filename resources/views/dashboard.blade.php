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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-solid border-2 border-gray-300 w-[280px] h-[400px]">
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
