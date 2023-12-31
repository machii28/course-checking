<div class="card">
    <div class="card-body">
        <h4 class="card-title">Subjects</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Professor</th>
                    <th>Year Level</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->subject->name }}</td>
                    <td>{{ $subject->grade }}</td>
                    <td>{{ $subject->professor->user->name }}</td>
                    <td>{{ $subject->year_level }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
