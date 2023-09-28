<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-center items-center">
                    <div class="p-6 text-center w-1/2">
                        <form action="{{ route('student') }}" method="GET">
                            <label for="student_id" class="block font-medium text-sm text-gray-700">Student Number:</label>
                            <input type="text" id="student_id" name="student_id" class="mt-1 p-2 border border-gray-300 rounded-md w-3/4" value="{{ request()->get('student_id') }}">

                            <div class="mt-4">
                                <button type="submit" class="w-1/2 px-4 py-2 text-white bg-indigo-500 rounded-md hover:bg-blue-600">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if ($student)
                <div class="bg-white mt-10 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-center items-center">
                        <div class="p-6 text-center w-full">
                            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                                <thead class="bg-gray-800 text-white">
                                    <tr class="text-center">
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Professor</th>
                                        <th class="px-4 py-2">Grade</th>
                                        <th class="px-4 py-2">Year Level</th>
                                        <th class="px-4 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700">
                                    @foreach($student->subjects as $subject)
                                        <tr class="text-center">
                                            <td class="px-4 py-2">{{ $subject->subject->name }}</td>
                                            <td class="px-4 py-2">{{ $subject->professor->user->name }}</td>
                                            <td class="px-4 py-2">
                                                {{ $subject->grade }}
                                            </td>
                                            <td class="px-4 py-2">{{ $subject->year_level }}</td>
                                            <td class="px-4 py-2">
                                                @if ($subject->is_approved)
                                                    <span class="bg-red-400 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-400 dark:text-white">Approved</span>
                                                @else
                                                    <form method="POST" action="{{ route('grade.approve', ['subjectId' => $subject->id]) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('POST') }}
                                                        <button type="submit" class="text-xs text-blue-900">Approve Grade</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white mt-10 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex justify-center items-center">
                        <div class="p-6 text-center w-1/2">
                            <h1>No Student Data Loaded</h1>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
