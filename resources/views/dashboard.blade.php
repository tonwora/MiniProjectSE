<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                 <div class="container-fluid">
                    {{-- Body --}}
                    <!-- Button to open the "Add Course" modal -->
                    @if(Auth::user()->roles == 1)
                    <button type="button" class="btn btn-outline-success mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        เพิ่มวิชา
                    </button>
                    @endif
                    <!-- Modal for Editing Course -->
                    @foreach ($courses as $course)
                    <div class="modal fade" id="EditModal_{{ $course->course_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขวิชา</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('dashboard.courseEdit') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">รหัสวิชา:</label>
                                            <input name="code" type="text" class="form-control" value="{{ $course->course_code }}" id="recipient-name">
                                            <input name="id" type="hidden" value="{{ $course->id }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">ชื่อวิชา:</label>
                                            <input name="name" type="text" class="form-control" value="{{ $course->course_name }}" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">รายละเอียดวิชา:</label>
                                            <textarea name="info" class="form-control" id="message-text">{{ $course->course_info }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">ภาค:</label>
                                            <input name="term" type="number" class="form-control" value="{{ $course->course_term }}" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for "recipient-name" class="col-form-label">ปีการศึกษา:</label>
                                            <input name="year" type="text" class="form-control" value="{{ $course->course_year }}" id="recipient-name">
                                        </div>
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-outline-primary">บันทึก</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    @endforeach


                    <!-- Modal for Adding Course -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">เพิ่มวิชา</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('dashboard.create') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">รหัสวิชา:</label>
                                            <input name="id" type="text" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">ชื่อวิชา:</label>
                                            <input name="name" type="text" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">รายละเอียดวิชา:</label>
                                            <textarea name="info" class="form-control" id="message-text"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">ภาค:</label>
                                            <input name="term" type="number" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">ปีการศึกษา:</label>
                                            <input name="year" type="text" class="form-control" id="recipient-name">
                                        </div>
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                    <button type="submit" class="btn btn-outline-primary">เพิ่มวิชา</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->roles == 1)
                    <div class="card mt-3">
                        <div class="card-header"><h2 class="font-semibold text-xl text-gray-800 leading-tight mt-3">
                            {{ __('รายวิชาของคุณ') }}
                        </h2></div>
                        <table class="table table-hover mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">ชื่อวิชา</th>
                                    <th scope="col">ภาค/ปีการศึกษา</th>
                                    <th scope="col">สร้างเมื่อ</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            @foreach($courses as $course)
                            @if($course->teacher_id == Auth::user()->id)
                            <tbody>
                                <tr>
                                    <td><a href="/course/detail/{{ $course->id }}">{{ $course->course_code }} {{ $course->course_name }}</a></td>
                                    <td>{{ $course->course_term }}/{{ $course->course_year }}</td>
                                    <td>{{ $course->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#EditModal_{{ $course->course_id }}">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                    </td>
                                    <td><a href="/course/delete/{{ $course->id }}"><button type="button" class="btn btn-outline-danger" onclick="return confirm('คุณจะลบวิชานี้จริงหรือไม่?')"><i class="bi bi-trash"></i>Delete</button></a></td>
                                </tr>
                            </tbody>

                            @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header"><h2 class="font-semibold text-xl text-gray-800 leading-tight mt-3">
                            {{ __('รายวิชาสำหรับผู้ช่วยสอน') }}
                        </h2></div>
                        <table class="table table-hover mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">ชื่อวิชา</th>
                                    <th scope="col">ภาค/ปีการศึกษา</th>
                                    <th scope="col">เพิ่มเมื่อ</th>
                                    <th scope="col">อาจารย์</th>
                                </tr>
                            </thead>
                            @foreach($courses as $course)
                            @foreach ($ta as $t)
                            @if($course->id == $t->course_id && $t->email == Auth::user()->email)
                            <tbody>
                                <tr>
                                    <td><a href="/course/detail/{{ $course->id }}">{{ $course->course_code }} {{ $course->course_name }}</a></td>
                                    <td>{{ $course->course_term }}/{{ $course->course_year }}</td>
                                    <td>{{ $t->created_at }}</td>
                                    <td>@foreach ($users as $user)
                                        @if($user->id == $course->teacher_id)
                                        {{ $user->name }}
                                        @endif
                                    @endforeach</td>
                                </tr>
                            </tbody>
                            @endif
                            @endforeach
                            @endforeach
                        </table>
                    </div>

                    @elseif(Auth::user()->roles == 3)
                    <div class="card-header"><h2 class="font-semibold text-xl text-gray-800 leading-tight mt-3">
                            {{ __('รายวิชาสำหรับนักศึกษา') }}
                        </h2></div>
                    <table class="table table-hover mt-3">
                        <thead>
                            <tr>
                                <th scope="col">ชื่อวิชา</th>
                                <th scope="col">ภาค/ปีการศึกษา</th>
                                <th scope="col">อาจารย์</th>
                            </tr>
                        </thead>
                        @foreach($courses as $course)
                        @foreach ($students as $std)
                        @if($course->id == $std->course_id && $std->email == Auth::user()->email)
                        <tbody>
                            <tr>
                                <td><a href="/course/detail/{{ $course->id }}">{{ $course->course_code }} {{ $course->course_name }}</a></td>
                                <td>{{ $course->course_term }}/{{ $course->course_year }}</td>
                                <td>@foreach ($users as $user)
                                    @if($user->id == $course->teacher_id)
                                    {{ $user->name }}
                                    @endif
                                @endforeach</td>
                            </tr>
                        </tbody>
                        @endif
                        @endforeach
                        @endforeach
                    </table>
                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
