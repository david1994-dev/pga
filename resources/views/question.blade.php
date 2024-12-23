<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản trị') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('question.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="question" class="block text-gray-700 text-sm font-bold mb-2">Câu hỏi:</label>
                            <input type="text" name="question" id="question" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-4">
                            <label for="answer" class="block text-gray-700 text-sm font-bold mb-2">Đáp án: (Phân cách nhau bằng dấu ','. Ví dụ: mèo,chó,gà)</label>
                            <textarea name="answers" id="answer" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"> </textarea>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="submit" class="hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" style="background: blue">
                                Lưu
                            </button>
                            <a href="{{ route('dashboard') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" style="background: red">
                                Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
