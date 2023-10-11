<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @foreach ($course as $c)
            Dashboard > {{ $c->course_name }}
            @endforeach

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container-fluid">
                        <div class="modal fade" id="addwork" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มงาน</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('course.addwork') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">ชื่องาน:</label>
                                            <input name="name" type="text" class="form-control"
                                                id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">คำแนนเต็ม:</label>
                                            <input name="point" type="text" class="form-control"
                                                id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">กำหนดส่ง:</label>
                                            <input name="date" type="text" class="form-control"
                                                id="recipient-name">
                                        </div>
                                        <input type="hidden" name="course_id" value="{{ $c->id }}">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-success">เพิ่ม</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @foreach ($works as $w)
                    <div class="modal fade" id="editwork{{ $w->work_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขงาน</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('dashboard.Editwork') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="recipient-name"
                                                class="col-form-label">ชื่องาน:</label>
                                            <input name="name" type="text" value="{{ $w->work_name }}"
                                                class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name"
                                                class="col-form-label">คะแนนเต็ม:</label>
                                            <input name="point" type="text" value="{{ $w->work_maxpoint }}"
                                                class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">กำหนดส่ง:</label>
                                            <input name="date" type="text" value="{{ $w->work_finish }}"
                                                class="form-control" id="recipient-name">
                                        </div>
                                        <input type="hidden" name="id" value="{{ $w->work_id }}">

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
                    <div class="card mb-3 mt-3">
                        @foreach ($course as $c)
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                  <a class="nav-link" aria-current="page" href="/course/detail/{{ $c->id }}">Stream</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link active" aria-current="page" href="/course/detail/work/{{ $c->id }}">Classwork</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="/course/detail/people/{{ $c->id }}">People</a>
                                </li>
                              </ul>
                        @endforeach
                        <div class="card-body">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                งานและการบ้าน
                            </h2>
                            @foreach ($course as $c)
                            @if(Auth::user()->id == $c->teacher_id)
                            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                            data-bs-target="#addwork">เพิ่มงาน</button>
                            @endif
                            @endforeach
                        <h5 class="mt-3">ข้อมูลการบ้าน/งานที่สั่ง( {{ $work_count }} )</h5>
                        <table class="table table-hover mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่องาน</th>
                                    <th scope="col">คะแนนเต็ม</th>
                                    <th scope="col">ช่วงกำหนดเวลา</th>
                                    @if(Auth::user()->role == 1)
                                    <th scope="col">สร้างเมื่อ</th>
                                    <th scope="col">ทำเสร็จแล้ว</th>
                                    <th scope="col">กำลังทำ</th>
                                    <th scope="col">ยังไม่เริ่มทำ</th>
                                    @endif

                                </tr>
                            </thead>
                        @foreach ($works as $w)
                        <tr>
                            <th scope="row">{{ $w->work_id }}</th>
                            <td><a href="/showwork/{{ $w->work_id }}"
                                style="text-decoration: underline;">{{ $w->work_name }}</td>
                            <td>{{ $w->work_maxpoint }}</td>
                            <td>{{ $w->work_finish }}</td>
                            @if(Auth::user()->role == 1)
                            <td>{{ $w->created_at }}</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            @endif
                            <td>
                                @foreach ($course as $c)
                            @if(Auth::user()->roles == 1)
                            <button type="button"
                                    class="btn btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editwork{{ $w->work_id }}">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </button>
                            @endif
                            @endforeach

                            </td>
                            <td>
                                @foreach ($course as $c)
                            @if(Auth::user()->id == $c->teacher_id)
                            <a
                                    href="/course/deletework/{{ $w->work_id }}"><button
                                        type="button"
                                        class="btn btn-danger"
                                        onclick="return confirm('คุณจะลบ {{ $w->work_name }} ออกหรือไม่?')"><i
                                            class="bi bi-trash"></i>Delete</button></a>
                            @endif
                            @endforeach
                            </td>
                        </tr>
                        @endforeach
                        </table>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
