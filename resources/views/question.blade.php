<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản trị') }}
        </h2>
    </x-slot>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="mb-4 font-medium text-sm bold text-center text-white" style="background: red ; padding: 10px">{{ $error }}</div>
        @endforeach
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('question.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="question" class="block text-gray-700 text-sm font-bold mb-2">Câu hỏi:</label>
                            <textarea name="question" id="question" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required> </textarea>
                        </div>
                        <div class="mb-4">
                            <div class="flex items-center justify-between pb-1">
                                <label for="answer" class="block text-gray-700 text-sm font-bold mb-2">Đáp án (Checked với đáp án đúng)</label>
                                <button type="button" id="addMoreAnswer" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded">
                                    + Thêm đáp án
                                </button>
                            </div>
                            <div class="jsAnswerWrapper">
                                <div class="flex gap-4 ">
                                    <input type="text" name="answer_1" id="answer_1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    <div class="inline-flex items-center">
                                        <label class="flex items-center cursor-pointer relative">
                                            <input type="checkbox" value="1" name="is_correct_1" class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-300 checked:bg-slate-800 checked:border-slate-800" id="check" />
                                            <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            </span>
                                        </label>
                                    </div>
                                    <img class="jsDeleteAnswer" src = "{{ asset('/icon/trash.svg') }}" style="width: 23px; cursor: pointer"/>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('dashboard') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" style="background: red">
                                Hủy
                            </a>
                            <button id="sumbit" type="submit" class="hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" style="background: blue">
                                Lưu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="module">
        let count = 1;
        $('#addMoreAnswer').on('click', function() {
            count++;
            let html = `
                <div class="flex gap-4 pt-1">
                    <input type="text" name="answer_${count}" id="answer_${count}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <div class="inline-flex items-center">
                        <label class="flex items-center cursor-pointer relative">
                            <input type="checkbox" value="1" name="is_correct_${count}" class="peer h-5 w-5 cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-slate-300 checked:bg-slate-800 checked:border-slate-800" id="check" />
                            <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            </span>
                        </label>
                    </div> 
                    <img class="jsDeleteAnswer" src = "{{ asset('/icon/trash.svg') }}" style="width: 23px; cursor: pointer"/>
                </div>
            `

            $('.jsAnswerWrapper').append(html);
        });

        $('.jsAnswerWrapper').on('click', '.jsDeleteAnswer', function() {
            $(this).parent().remove();
        });
    </script>
</x-app-layout>
