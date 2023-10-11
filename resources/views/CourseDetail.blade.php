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
                    @foreach ($posts as $post)
                    <div class="modal fade" id="editModal_{{ $post->id }}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขโพสต์</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="{{ route('dashboard.EditPost') }}">
                                @csrf
                                <div class="mb-3">
                                  <textarea name="info" class="form-control" id="message-text">{{ $post->post_info }}</textarea>
                                  <input type="hidden" value="{{ $post->id }}" name="id">
                                </div>
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
                    @foreach ($comments as $comment)
                    <div class="modal fade" id="editModal_{{ $comment->id }}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">แก้ไขความคิดเห็น</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form method="POST" action="{{ route('dashboard.EditComment') }}">
                                @csrf
                                <div class="mb-3">
                                  <textarea name="info" class="form-control" id="message-text">{{ $comment->comment_info }}</textarea>
                                  <input type="hidden" value="{{ $comment->id }}" name="id">
                                </div>
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

                    {{-- Body --}}
                    <div class="card mb-3 mt-3">
                        @foreach ($course as $c)
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                  <a class="nav-link active" aria-current="page" href="/course/detail/{{ $c->id }}">Stream</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="/course/detail/work/{{ $c->id }}">Classwork</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="/course/detail/people/{{ $c->id }}">People</a>
                                </li>
                              </ul>
                              @endforeach
                        <div class="card-body">
                          @foreach ($course as $c)
                          <p class="card-text">รหัสวิชา:{{ $c->course_code }}</p>
                          <p class="card-text">ชื่อวิชา:{{ $c->course_name }}</p>
                          <p class="card-text">เทอม:{{ $c->course_term }}</p>
                          <p class="card-text">ปีการศึกษา:{{ $c->course_year }}</p>
                          <p class="card-text">คำอธิบายรายวิชา:{{ $c->course_info }}</p>
                          @endforeach
                        </div>
                    </div>
                    <div class="card mb-3 mt-3">
                        <form method="POST" action="{{ route('dashboard.AddPost') }}">
                            @csrf
                            <div class="input-group">
                                <span class="input-group-text">{{ Auth::user()->name }}:</span>
                                <textarea name="info" class="form-control" aria-label="With textarea" placeholder="โพสต์ประกาศสำหรับวิชานี้..."></textarea>
                                <span class="input-group-text"><input type="submit" value="Post">
                                </span>
                              </div>
                              <input name="user" type="hidden" value="{{ Auth::user()->id }}">
                              @foreach ($course as $c)
                              <input name="course" type="hidden" value="{{ $c->id }}">
                              @endforeach
                        </form>
                    </div>
                    @foreach ($posts as $post)
                    @foreach ($users as $user)
                    @if($user->id == $post->user_id)
                    <div class="card mb-3 mt-3">
                        <div class="card-header">
                          <h1>{{ $user->name }}</h1>
                          <p><small>{{ \Carbon\Carbon::parse($post->created_at)->format('F j') }}</small></p>
                        </div>
                        <div class="card-body">
                            <p>{{ $post->post_info }}</p><br>
                            <footer class="blockquote-footer"><button type="button" class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapseComment_{{ $post->id }}" aria-expanded="false" aria-controls="collapseComment_{{ $post->id }}">Class comment</button>
                                @if(Auth::user()->id == $post->user_id)
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal_{{ $post->id }}">Edit</button>
                                <a href="/course/post/delete/{{ $post->id }}"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                                @endif
                            </footer>
                            <div class="collapse" id="collapseComment_{{ $post->id }}">
                                <div class="card mb-3 mt-3">
                                    <form method="POST" action="{{ route('dashboard.AddComment') }}">
                                        @csrf
                                        <div class="input-group">
                                            <span class="input-group-text">{{ Auth::user()->name }}:</span>
                                            <textarea name="info" class="form-control" aria-label="With textarea" placeholder="แสดงความคิดเห็น..."></textarea>
                                            <span class="input-group-text"><input type="submit" value="Comment">
                                            </span>
                                          </div>
                                          <input name="user" type="hidden" value="{{ Auth::user()->id }}">
                                          <input name="post" type="hidden" value="{{ $post->id }}">
                                    </form>
                                </div>
                                @foreach ($comments as $comment)

                                @if($comment->post_id == $post->id)
                                <div class="card mb-3 mt-3">
                                    <div class="card-header">
                                        <h1>@foreach ($users as $user) @if($user->id == $comment->user_id)
                                            {{ $user->name }}
                                        @endif @endforeach</h1>
                                        <p><small>{{ \Carbon\Carbon::parse($comment->created_at)->format('F j') }}</small></p>
                                      </div>
                                      <div class="card-body">
                                        <p>{{ $comment->comment_info }}</p><br>
                                        @if(Auth::user()->id == $comment->user_id)
                                        <footer class="blockquote-footer"><button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal_{{ $comment->id }}">Edit</button>
                                        @endif
                                        @if(Auth::user()->id == $comment->user_id || Auth::user()->roles == 1)
                                        <a href="/course/post/comment/delete/{{ $comment->id }}"><button type="button" class="btn btn-outline-danger">Delete</button></a>
                                        @endif
                                    </footer>
                                      </div>
                                </div>
                                @endif

                                @endforeach
                              </div>
                          </blockquote>
                        </div>
                      </div>
                    @endif
                    @endforeach
                    @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
