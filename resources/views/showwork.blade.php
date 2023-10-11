<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Modal --}}
                    @foreach ($course as $c)
                        <div class="modal fade" id="editstd{{ $c->user_id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">ให้คะแนน</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('givepoint') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label">คะแนน:</label>
                                                <input type="number" id="quantity" name="point" min="0" max={{ $detail[0]->work_maxpoint }}>
                                            </div>
                                            <div class="mb-3">
                                                <select name="stat">
                                                    <option value="ส่งแล้ว" selected> ส่งแล้ว </option>
                                                    <option value="ยังไม่ส่ง"> ยังไม่ส่ง </option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="std_id" value="{{ $c->user_id }}">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">ยกเลิก</button>
                                        <button type="submit" class="btn btn-success">บันทึก</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Body --}}
                    @foreach ($detail as $d)
                        ชื่องาน : {{ $d->work_name }}<br>
                        คะแนนเต็ม : {{ $d->work_maxpoint }}<br>
                        กำหนดส่ง : {{ $d->work_finish }}
                        <hr>
                    @endforeach
                    <table class="table table-hover" border="1">
                        <thead>
                            <tr>
                                <th scope="col">รหัสนักศึกษา</th>
                                <th scope="col">ชื่อนักศึกษา</th>
                                <th scope="col">คะแนน</th>
                                <th scope="col">สถานะ</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @foreach ($course as $c)
                            <tr>
                                <th>
                                    {{ $c->std }}
                                </th>
                                <th>
                                    {{ $c->name }}
                                </th>
                                <th>
                                    {{ $c->point }} / {{ $detail[0]->work_maxpoint }}
                                </th>
                                <th>
                                    {{ $c->date_process }}
                                </th>
                                <th>
                                    @if(Auth::user()->roles == 1)
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editstd{{ $c->user_id }}">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                                    @endif

                                </th>
                                <th>

                                </th>
                                <th>

                                </th>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
