@php
    $field['value'] = old_empty_or_null($field['name'], '') ?? ($field['value'] ?? ($field['default'] ?? ''));

    $studentId = $field['studentId'];
    $student = \App\Models\Student::find($studentId);
    $allSubjects = \App\Models\Subject::whereNotIn('id', $field['value']->pluck('id')->toArray())->get();
@endphp

@include('crud::fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('crud::fields.inc.translatable_icon')

<table class="table table-striped">
    <thead>
        <td>Name</td>
        <td>Actions</td>
        </thead>
    <tbody>
    @foreach($field['value'] as $subject)
        <tr>
            <td>
                {{ $subject->name }}
            </td>
            <td>
                <button type="button" data-type="remove_subject" data-id="{{ $subject->id }}" class="btn btn-sm btn-link">
                    Remove
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


<div>
    <label for="new_subject">Add Subject:</label>
    <select id="new_subject" class="form-control">
        <option value="">Select a Subject</option>
        @foreach($allSubjects as $subject)
            @if (!$field['value']->contains('id', $subject->id))
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endif
        @endforeach
    </select>
    <button type="button" id="add_subject" class="btn btn-sm btn-primary mt-2">Add</button>
</div>

@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')

@push('crud_fields_styles')
    @basset('select_pivot_tableFieldStyle.css')

    @bassetBlock('backpack/crud/fields/select_pivot_table_field-style.css')
    <style>
        .select_pivot_table_field_class {
            display: none;
        }
    </style>
    @endBassetBlock
@endpush

@push('crud_fields_scripts')
    @basset('select_pivot_tableFieldScript.js')

    @bassetBlock('path/to/script.js')
    <script>
        function bpFieldInitDummyFieldElement(element) {
            console.log(element.val());
        }

        $(document).ready(function () {
            function updateFieldValue() {
                var newValue = [];

                $('tbody tr').each(function () {
                    var rowData = {};
                    rowData.name = $(this).find('td:eq(0)').text();

                    newValue.push(rowData);
                });

                @php
                    $field['value'] = json_encode([]);
                @endphp

                if (newValue.length > 0) {
                    @php
                        $field['value'] = json_encode($field['value'] ?: []);
                    @endphp
                }

                $('#field_input_{{ $field['name'] }}').val(JSON.stringify(newValue));
            }

            $('#add_subject').click(function (e) {
                var selectedSubjectId = $('#new_subject').val();
                var selectedSubjectName = $('#new_subject option:selected').text();

                $.ajax({
                    type: 'POST',
                    url: '/add-subject',
                    data: {
                        'student_id': {!! $studentId !!},
                        'subject_id': selectedSubjectId
                    }
                });

                if (selectedSubjectId !== '') {
                    var newRow = $('<tr><td>' + selectedSubjectName + '</td><td><button type="button" data-type="remove_subject" data-id="'+ selectedSubjectId +'" class="btn btn-sm btn-link">Remove</button></td></tr>');
                    $('tbody').append(newRow);

                    newRow.find('[data-type="remove_subject"]').click(function () {
                        newRow.remove();
                        updateFieldValue();
                    });

                    updateFieldValue();
                }
            });

            $(document).on('click', '[data-type="remove_subject"]', function () {
                var subjectId = $(this).data('id');
                console.log(subjectId);
                $(this).closest('tr').remove();
                updateFieldValue();

                $.ajax({
                    type: 'POST',
                    url: '/remove-subject',
                    data: {
                        'student_id': {!! $studentId !!},
                        'subject_id': subjectId
                    }
                });
            });
        });
    </script>
    @endBassetBlock
@endpush
