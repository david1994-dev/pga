<x-app-layout>
    <style>
        .filter-red{
            filter: invert(20%) sepia(86%) saturate(7243%) hue-rotate(357deg) brightness(105%) contrast(114%);
        }
    </style>
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
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">
                                        STT
                                    </th>
                                    <th scope="col">
                                        Câu hỏi
                                    </th>
                                    <th scope="col">
                                        SL người trả lời
                                    </th>
                                    <th scope="col">
                                        Người Tạo
                                    </th>
                                    <th scope="col">
                                        Link
                                    </th>
                                    <th scope="col">
                                        Hành động
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                <tr>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        {{ $question->title }}
                                    </td>
                                    <td>
                                        <a href="{{ route('question.statistical', $question->id) }}">{{ $question->userQuestions->count() }}</a>
                                    </td>
                                    <td>
                                        {{ @$question->createdBy->name }}
                                    </td>
                                    <td>
                                        {{ route('question.show', $question->uuid) }}
                                    </td>
                                    <td>
                                        <img class="jsDeleteQuestion filter-red" src = "{{ asset('/icon/trash.svg') }}" style="width: 23px; cursor: pointer" data-id={{ $question->id }}/>
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
    <script type="module">
        $('.jsDeleteQuestion').on('click', function() {
            let id = $(this).data('id');
            if(confirm('Bạn có chắc chắn muốn xóa câu hỏi này không?')) {
                $.ajax({
                    url: `/question/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if(response.status == 'success') {
                            window.location.reload();
                        }
                    }
                });
            }
        });
    </script>
</x-app-layout>
