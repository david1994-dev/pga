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
                        <table class="table">
                            <thead class="thead-dark">
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
                                <tr @if($questionUser->score === count($questionUser->answer) && $loop->iteration <= 3) style="background:#6fec9f" @endif>
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        {{ $questionUser->user_answer }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-question-{{ $questionUser->id }}">
                                            {{ $questionUser->score }} / {{ count($questionUser->answer) }}
                                        </button>
                                    </td>
                                    <td>
                                        {{ @$questionUser->created_at }}
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="modal-question-{{ $questionUser->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Câu trả lời:</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($questionUser->answer as $answer)
                                                <p>- {{ $answer }}</p>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                        </table>
                        {{ $questionUsers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
