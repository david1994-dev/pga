<x-app-layout>
    @if (session('status') == 'question-stored')
        <div class="mb-4 font-medium text-sm bold text-center text-white" style="background: green ; padding: 10px">
            {{ __('Question created successfully') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản trị') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-[100vh]">
                <div class="p-6 text-gray-900">
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        STT
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Câu hỏi
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        SL người trả lời
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Người Tạo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $question->title }}
                                    </th>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('question.statistical', $question->id) }}">{{ $question->userQuestions->count() }}</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ @$question->createdBy->name }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
