<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Grades') }}
        </h2>
    </x-slot>

    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-800 text-white">
                        <tr class="text-center">
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Professor</th>
                            <th class="px-4 py-2">Grade</th>
                            <th class="px-4 py-2">Year Level</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($subjects as $studentSubject)
                            <tr class="text-center">
                                <td class="px-4 py-2">{{ $studentSubject->subject->name }}</td>
                                <td class="px-4 py-2">{{ $studentSubject->professor->user->name }}</td>
                                <td class="px-4 py-2">{{ $studentSubject->grade }}</td>
                                <td class="px-4 py-2">{{ $studentSubject->year_level }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
