<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\Professor;
use App\Models\Student;
use App\Models\StudentSubject;
use App\Models\Subject;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Prologue\Alerts\Facades\Alert;

trait SetupSubjectOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupSetupSubjectRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{studentId}/setup-subject', [
            'as'        => $routeName.'.setupSubject',
            'uses'      => $controller.'@setupSubject',
            'operation' => 'setupSubject',
        ]);

        Route::post($segment.'/{studentId}/add-subject', [
            'as' => $routeName . '.addSubject',
            'uses' => $controller .  '@addSubject',
            'operation' => 'setupSubject'
        ]);

        Route::post($segment . '/{studentId}/{subjectId}/remove-subject', [
            'as' => $routeName . '.removeSubject',
            'uses' => $controller . '@removeSubject',
            'operation' => 'setupSubject'
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupSetupSubjectDefaults()
    {
        CRUD::allowAccess('setupSubject');

        CRUD::operation('setupSubject', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
            // CRUD::addButton('top', 'setup_subject', 'view', 'crud::buttons.setup_subject');
             CRUD::addButton('line', 'setup_subject', 'view', 'crud::buttons.setup-subject');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function setupSubject($studentId): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        CRUD::hasAccessOrFail('setupSubject');
        $student = Student::find($studentId);
        $subjects = $student->subjects;

        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Setup Subject '.$this->crud->entity_name;
        $this->data['subjects'] = $subjects;
        $this->data['student'] = $student;
        $this->data['subjectSelections'] = Subject::whereNotIn('id', $subjects->pluck('subject_id'))->get();
        $this->data['professorSelections'] = Professor::get();

        return view('crud::operations.setup_subject', $this->data);
    }

    public function addSubject($studentId, Request $request)
    {
        $studentSubject = new StudentSubject();
        $studentSubject->year_level = $request->get('year_level');
        $studentSubject->professor_id = $request->get('professor_id');
        $studentSubject->subject_id = $request->get('subject_id');
        $studentSubject->student_id = $studentId;
        $studentSubject->save();

        Alert::success('<strong>Success !</strong><br>Subject Saved Successfully')->flash();

        return Redirect::back();
    }

    public function removeSubject($studentId, $subjectId)
    {
        $student = StudentSubject::where('subject_id', $subjectId)
            ->where('student_id', $studentId)
            ->delete();

        Alert::success('<strong>Success !</strong>Subject was removed successfully')->flash();

        return Redirect::back();
    }
}
