{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Users" icon="la la-user" :link="backpack_url('user')" />
<x-backpack::menu-item title="Courses" icon="la la-chalkboard" :link="backpack_url('course')" />
<x-backpack::menu-item title="Professors" icon="la la-user-tie" :link="backpack_url('professor')" />
<x-backpack::menu-item title="Students" icon="la la-user-graduate" :link="backpack_url('student')" />
<x-backpack::menu-item title="Subjects" icon="la la-book-open" :link="backpack_url('subject')" />
<x-backpack::menu-item title="Curricula" icon="la la-folder" :link="backpack_url('curriculum')" />
<x-backpack::menu-item title="Report" icon="la la-chart-line" :link="backpack_url('report')" />
