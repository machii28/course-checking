<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

/**
 * Class ReportController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ReportController extends Controller
{
    public function index()
    {
        return view('admin.report', [
            'title' => 'Report',
            'breadcrumbs' => [
                trans('backpack::crud.admin') => backpack_url('dashboard'),
                'Report' => false,
            ],
            'page' => 'resources/views/admin/report.blade.php',
            'controller' => 'app/Http/Controllers/Admin/ReportController.php',
        ]);
    }
}
