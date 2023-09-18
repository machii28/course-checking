<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Operations\SetupSubjectOperation;
use App\Http\Requests\StudentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StudentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StudentCrudController extends CrudController
{
    use SetupSubjectOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation {
        index as traitIndex;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/student');
        CRUD::setEntityNameStrings('student', 'students');
    }

    public function index()
    {
        return $this->traitIndex();
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'student_number',
            'label' => 'Student No.'
        ]);

        $this->crud->addColumn([
            'name' => 'user.name',
            'label' => 'Student'
        ]);

        $this->crud->addColumn([
            'name' => 'course.course',
            'label' => 'Course'
        ]);

        $this->crud->addColumn([
            'name' => 'year_level',
            'label' => 'Year Level'
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(StudentRequest::class);

        CRUD::addField([
            'name' => 'student_number',
            'label' => 'Student Number',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'course_id',
            'label' => 'Course',
            'type' => 'select',
            'entity' => 'course',
            'attribute' => 'course',
            'model' => 'App\Models\Course',
        ]);

        CRUD::addField([
            'name' => 'year_level',
            'label' => 'Year Level',
            'type' => 'select_from_array',
            'options' => ['1st Year' => '1st Year', '2nd Year' => '2nd Year', '3rd Year' => '3rd Year', '4th Year' => '4th Year'],
        ]);
    }

    protected function setupShowOperation()
    {
        $subjects = $this->crud->getCurrentEntry()->subjects;

        $this->crud->column([
            'name' => 'course.course',
            'label' => 'Course'
        ]);

        $this->crud->column([
            'name' => 'year_level',
            'label' => 'Current Year Level'
        ]);

        $this->crud->column([
            'name' => 'subjects',
            'label' => 'Subjects',
            'type' => 'custom_html',
            'value' => view('vendor.backpack.custom.student-subject-show', compact('subjects'))->render()
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
