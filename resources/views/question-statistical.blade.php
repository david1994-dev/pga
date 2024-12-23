<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thống kê câu hỏi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h3>{{ $question->title }}</h3>
                    </div>
                    <div class="relative overflow-x-auto pt-3">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        STT
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Người trả lời
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Số lượng câu đúng
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Giờ trả lời
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questionUsers as $questionUser)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $questionUser->user_answer }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $questionUser->score }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ @$questionUser->created_at }}
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
