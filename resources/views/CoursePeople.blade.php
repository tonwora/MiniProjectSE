<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @foreach ($course as $c)
            Dashboard > {{ $c->course_name }}
            @endforeach

        </h2>
    </x-slot>
    @foreach ($course as $c)
    @foreach ($students as $std)
    @if($c->id == $std->course_id)
    <div class="modal fade" id="editModal_{{ $std->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขรายบุคคล</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('dashboard.EditStd') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">รหัสนักศึกษา:</label>
                            <input name="id" type="text" value="{{ $std->stdcode }}" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">ชื่อ-นามสกุล:</label>
                            <input name="name" type="text" value="{{ $std->name }}" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">อีเมล:</label>
                            <input name="email" type="email" value="{{ $std->email }}" class="form-control" id="recipient-name">
                        </div>
                        <input type="hidden" name="course_id" value="{{ $c->id }}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-outline-success">บันทึก</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endforeach
    @foreach ($course as $c)
    @foreach ($ta as $t)
    @if($c->id == $t->course_id)
    <div class="modal fade" id="editModal_{{ $t->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขรายบุคคล</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('dashboard.EditTA') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">ชื่อ-นามสกุล:</label>
                            <input name="name" type="text" value="{{ $t->name }}" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">อีเมล:</label>
                            <input name="email" type="email" value="{{ $t->email }}" class="form-control" id="recipient-name">
                        </div>
                        <input type="hidden" name="course_id" value="{{ $c->id }}">
                        <input type="hidden" name="id" value="{{ $t->id }}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-outline-success">บันทึก</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endforeach
    @foreach ($course as $c)
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">นำเข้ารายบุคคล</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('dashboard.Addstd') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">รหัสนักศึกษา:</label>
                            <input name="id" type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">ชื่อ-นามสกุล:</label>
                            <input name="name" type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">อีเมล:</label>
                            <input name="email" type="email" class="form-control" id="recipient-name">
                        </div>
                        <input type="hidden" name="course_id" value="{{ $c->id }}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-outline-success">เพิ่ม</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    {{-- Add TA --}}
    <div class="modal fade" id="AddTAModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">นำเข้าผู้ช่วยสอน</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('dashboard.AddTA') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">ชื่อ-นามสกุล:</label>
                            <input name="name" type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">อีเมล:</label>
                            <input name="email" type="email" class="form-control" id="recipient-name">
                        </div>
                        <input type="hidden" name="course_id" value="{{ $c->id }}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-outline-success">เพิ่ม</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    {{-- import excel TA --}}
    <div class="modal fade" id="excelModalTA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">นำเข้าไฟล์excel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form id="excel-csv-import-form" method="POST"  action="{{ url('import-excel-csv-file-TA') }}" accept-charset="utf-8" enctype="multipart/form-data">
 
                            @csrf
                                     
                              <div class="row">
                   
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <input type="file" name="file" placeholder="Choose file">
                                      </div>
                                      @error('file')
                                          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                      @enderror
                                  </div>              
                              </div>     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-outline-success" id="submit">เพิ่ม</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    {{-- import excel std --}}
    <div class="modal fade" id="excelModalStd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">นำเข้าไฟล์excel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form id="excel-csv-import-form" method="POST"  action="{{ url('import-excel-csv-file') }}" accept-charset="utf-8" enctype="multipart/form-data">
 
                            @csrf
                                     
                              <div class="row">
                   
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <input type="file" name="file" placeholder="Choose file">
                                      </div>
                                      @error('file')
                                          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                      @enderror
                                  </div>              
                              </div>     
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-outline-success"  id="submit">เพิ่ม</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @endforeach
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container-fluid">
                    {{-- Body --}}
                    <div class="card mb-3 mt-3">
                        @foreach ($course as $c)
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                  <a class="nav-link" aria-current="page" href="/course/detail/{{ $c->id }}">Stream</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="/course/detail/work/{{ $c->id }}">Classwork</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link active" aria-current="page" href="/course/detail/people/{{ $c->id }}">People</a>
                                </li>
                              </ul>
                              @endforeach
                        <div class="card-body">
                            @foreach ($course as $c)
                            @if(Auth::user()->roles == 1 && $c->teacher_id == Auth::user()->id )
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#excelModalTA">นำเข้าไฟล์ Excel</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#AddTAModal">นำเข้ารายบุคคล</button>
                            @endif
                            @endforeach
                            <h1 class="card-title mt-3">รายชื่อผู้ช่วยสอน</h1>
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">ชื่อ-นามสกุล</th>
                                    <th scope="col">อีเมล</th>
                                    @if(Auth::user()->roles == 1 && $c->teacher_id == Auth::user()->id )
                                    <th scope="col">วันที่เพิ่ม</th>
                                    @endif
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course as $c)
                                    @foreach ($ta as $t)
                                    @if($c->id == $t->course_id)
                                    <tr>
                                        <td>{{ $t->name }}</td>
                                        <td>{{ $t->email }}</td>
                                        @if(Auth::user()->roles == 1 && $c->teacher_id == Auth::user()->id )
                                        <td>{{ $t->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal_{{ $t->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                        </td>
                                        <td><a href="/course/deleteTA/{{ $t->id }}"><button type="button" class="btn btn-outline-danger" onclick="return confirm('คุณจะลบ {{ $t->name }} ออกจากรายวิชา {{ $c->course_name }} จริงหรือไม่?')"><i class="bi bi-trash"></i>Delete</button></a></td>
                                        @endif
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                    </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                @foreach ($course as $c)
                                @if(Auth::user()->roles == 1 && $c->teacher_id == Auth::user()->id )
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#excelModalStd">นำเข้าไฟล์ Excel</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">นำเข้ารายบุคคล</button>
                                @endif
                                @endforeach
                            <h1 class="card-title mt-3">รายชื่อนักศึกษา</h1>
                            <table class="table table-hover">
                                <thead>
                                  <tr>
                                    <th scope="col">รหัสนักศึกษา</th>
                                    <th scope="col">ชื่อ-นามสกุล</th>
                                    <th scope="col">อีเมล</th>
                                    @if(Auth::user()->roles == 1 && $c->teacher_id == Auth::user()->id )
                                    <th scope="col">วันที่เพิ่ม</th>
                                    @endif
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($course as $c)
                                    @foreach ($students as $std)
                                    @if($c->id == $std->course_id)
                                    <tr>
                                        <th scope="row">{{ $std->stdcode }}</th>
                                        <td>{{ $std->name }}</td>
                                        <td>{{ $std->email }}</td>
                                        @if(Auth::user()->roles == 1 && $c->teacher_id == Auth::user()->id )
                                        <td>{{ $std->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal_{{ $std->id }}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                        </td>
                                        <td><a href="/course/deleteStudent/{{ $std->id }}"><button type="button" class="btn btn-outline-danger" onclick="return confirm('คุณจะลบ {{ $std->name }} ออกจากรายวิชา {{ $c->course_name }} จริงหรือไม่?')"><i class="bi bi-trash"></i>Delete</button></a></td>
                                        @endif
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </tbody>
                              </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
