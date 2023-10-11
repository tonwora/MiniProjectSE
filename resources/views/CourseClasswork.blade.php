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
                            <h1 class="card-title">งานของคุณ</h1>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
