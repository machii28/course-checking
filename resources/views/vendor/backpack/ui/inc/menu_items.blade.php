{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Courses" icon="la la-question" :link="backpack_url('course')" />

<x-backpack::menu-item title="Professors" icon="la la-question" :link="backpack_url('professor')" />
<x-backpack::menu-item title="Students" icon="la la-question" :link="backpack_url('student')" />
<x-backpack::menu-item title="Subjects" icon="la la-question" :link="backpack_url('subject')" />