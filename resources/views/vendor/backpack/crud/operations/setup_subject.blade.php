@extends(backpack_view('blank'))

@section('header')
    <section class="header-operation container-fluid animated fadeIn d-flex mb-2 align-items-baseline d-print-none">
        <h2>
            <span class="text-capitalize mb-0">Setup Subject</span>
        </h2>
    </section>
@endsection

@section('content')
    <div class="container-fluid animated fadeIn">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('student.addSubject', ['studentId' => $student->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="year_level" value="{{ $student->year_level }}">

                    <div class="mb-3">
                        <label for="subjectSelect" class="form-label">Select Subject</label>
                        <select id="subjectSelect" class="form-select" name="subject_id">
                            @foreach($subjectSelections as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="professorSelect" class="form-label">Select Professor</label>
                        <select id="professorSelect" class="form-select" name="professor_id">
                            @foreach($professorSelections as $professor)
                                <option value="{{ $professor->id }}">{{ $professor->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary">Add Subject</button>
                </form>
            </div>
        </div>
        <div class="table-content row">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>
                        <th>Name</th>
                        <th>Professor</th>
                        <th>Year Level</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td>{{ $subject->subject->name }}</td>
                                <td>{{ $subject->professor->user->name }}</td>
                                <td>{{ $subject->year_level }}</td>
                                <td>
                                    <form method="POST" action="{{ route('student.removeSubject', ['studentId' => $student->id, 'subjectId' => $subject->subject->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <button type="submit" class="btn btn-sm btn-link">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
