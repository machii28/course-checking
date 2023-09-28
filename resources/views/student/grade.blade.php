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
                            <th class="px-4 py-2">Approved</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($subjects as $studentSubject)
                            <tr class="text-center">
                                <td class="px-4 py-2">{{ $studentSubject->subject->name }}</td>
                                <td class="px-4 py-2">{{ $studentSubject->professor->user->name }}</td>
                                <td class="px-4 py-2">
                                    {{ $studentSubject->grade }}
                                    <button class="border-gray-100 text-xs" onclick="openModal('{{ $studentSubject->id }}', '{{ $studentSubject->grade }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-indigo-700">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </button>
                                </td>
                                <td class="px-4 py-2">{{ $studentSubject->year_level }}</td>
                                <td class="px-4 py-2">
                                    @if ($studentSubject->is_approved)
                                        <span class="bg-red-400 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-400 dark:text-white">Approved</span>
                                    @else
                                        <span class="bg-red-400 text-white text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-400 dark:text-white">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="gradeModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-10 transition-opacity" style="--tw-bg-opacity: 0.65 !important"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <form id="gradeForm" action="{{ route('grades.save', ['gradeId' => 12]) }}" method="POST">
                <div class="modal-content py-4 text-left px-6">
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">Input Grade</p>
                        <button class="modal-close p-2 rounded-md focus:outline-none focus:shadow-outline-gray" onclick="closeModal()">&times;</button>
                    </div>
                    <div class="m-2">
                        {{ csrf_field() }}
                        <input id="gradeDetails" type="text" name="grade" class="text">
                    </div>
                    <div>
                        <button class="bg-indigo-500 text-white text-center w-full mt-2 p-2" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript to handle modal -->
    <script>
        function openModal(id, grade) {
            const modal = document.getElementById('gradeModal');
            const gradeDetails = document.getElementById('gradeDetails');
            const gradeForm = document.getElementById('gradeForm');
            gradeDetails.value = grade;
            gradeForm.action = `/${id}/save-grade`;

            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('gradeModal');
            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>
