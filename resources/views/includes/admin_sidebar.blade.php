{{-- @include('layouts.menu') --}}
<li class="app-sidebar__heading">Welcome To The Admin Panel</li>
{{-- Dashboard --}}
@can('dashboard-view')

<li class="">
    <a href="{{route('admin.dashboard')}}" class="{{ request()->route()->getName() == 'admin.dashboard' ? 'mm-active' : ''}}">
        <i class="metismenu-icon pe-7s-box2"></i>
        Dashboard
    </a>
</li>
@endcan
<li class="app-sidebar__heading">Application  MENU</li>
{{-- Users --}}
@can('user-view')
@if(Route::has('admin.users.index'))
<li class="">
    <a href="{{route('admin.users.index')}}" class="{{ Request::is('rt-admin/users**') ? 'mm-active' : '' }}">
        <i class="metismenu-icon pe-7s-users"></i>
        Users
    </a>
</li>
@endif
@endcan

{{-- Contacts --}}
@can('contact-view')
@if(Route::has('admin.contacts'))
<li class="">
    <a href="{{route('admin.contacts')}}" class="{{ request()->route()->getName() == 'admin.contacts' ? 'mm-active' : ''}}">
        <i class="metismenu-icon pe-7s-network"></i>
        Contacts
    </a>
</li>
@endif
@endcan
{{-- Feedbacks --}}
@can('feedback-view')
@if(Route::has('admin.feedbacks'))
<li class="">
    <a href="{{route('admin.feedbacks')}}" class="{{ request()->route()->getName() == 'admin.feedbacks' ? 'mm-active' : ''}}">
        <i class="metismenu-icon pe-7s-note2"></i>
        Feedbacks
    </a>
</li>
@endif
@endcan
<li class="app-sidebar__heading">System Menu</li>

{{-- Setting --}}
<li>
    <a href="#">
        <i class="metismenu-icon pe-7s-settings"></i>
        Settings
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        @can('setting-view')
        <li class="{{ request()->route()->getName() == 'admin.settings.index' ? 'mm-active' : '' }}">
            <a href="{{route('admin.settings.index')}}">
                <i class="metismenu-icon"></i>
                General Setting
            </a>
        </li>
        @endcan
        @can('Language-view')
        <li class="{{ Request::is('rt-admin/languages**') ? 'mm-active' : '' }}">
            <a href="{{route('admin.languages.index')}}" class="">
                <i class="metismenu-icon pe-7s-comment"></i>
                Languages
            </a>
        </li>
        @endcan
        {{-- Backup --}}
        @can('backup')
        <li class="{{ request()->route()->getName() == 'admin.backups.index' ? 'mm-active' : '' }}">
            <a href="{{route('admin.backups.index')}}">
                <i class="metismenu-icon"></i>
                Backup
            </a>
        </li>
        @endcan

        @can('role-view')
        <li class="{{ Request::is('rt-admin/roles**') ? 'mm-active' : '' }}">
            <a href="{{route('admin.roles.index')}}" class="">
                <i class="metismenu-icon pe-7s-user"></i>
                Roles
            </a>
        </li>
        @endcan
        @can('admin-view')
        <li class="{{ Request::is('rt-admin/admins**') ? 'mm-active' : '' }}">
            <a href="{{route('admin.admins.index')}}" class="">
                <i class="metismenu-icon pe-7s-add-user"></i>
                System Administrator
            </a>
        </li>
        @endcan
        @can('maintenance-mode')

        <li class="{{ request()->route()->getName() == 'admin.maintenanceMode' ? 'mm-active' : '' }}">
            <a href="{{route('admin.maintenanceMode')}}" class="">
                <i class="metismenu-icon pe-7s-hammer"></i>
                Maintenance Mode
            </a>
        </li>
        @endcan
    </ul>
</li>



@can('log-activity-view')
    <li>
    <a href="#">
        <i class="metismenu-icon pe-7s-diamond"></i>
        Activity Log
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        <li class="{{ request()->route()->getName() == 'admin.userLoginActivity' ? 'mm-active' : '' }}">
            <a href="{{route('admin.userLoginActivity')}}">
                <i class="metismenu-icon"></i>
                User Login Activity
            </a>
        </li>
        <li class="{{ request()->route()->getName() == 'admin.adminLoginActivity' ? 'mm-active' : '' }}">
            <a href="{{route('admin.adminLoginActivity')}}">
                <i class="metismenu-icon">
                </i>Admin Login Activity
            </a>
        </li>
        <li class="{{ request()->route()->getName() == 'admin.systemActivityLog' ? 'mm-active' : '' }}">
            <a href="{{route('admin.systemActivityLog')}}">
                <i class="metismenu-icon">
                </i>System Activity Log
            </a>
        </li>
    </ul>
</li>
@endcan
@if(auth()->user()->can('Visitor-info') || auth()->user()->can('Visitor-block-list'))
    <li>
    <a href="#">
        <i class="metismenu-icon pe-7s-id"></i>
        Visitors
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        @can('Visitor-info')

        <li class="{{ request()->route()->getName() == 'admin.visitorInfo' ? 'mm-active' : '' }}">
            <a href="{{route('admin.visitorInfo')}}">
                <i class="metismenu-icon"></i>
                Visitor Info
            </a>
        </li>
        @endcan
        @can('Visitor-block-list')
        <li class="{{ request()->route()->getName() == 'admin.visitorBlockList' ? 'mm-active' : '' }}">
            <a href="{{route('admin.visitorBlockList')}}">
                <i class="metismenu-icon"></i>
                Visitor Block List
            </a>
        </li>
        @endcan
    </ul>
</li>
@endif
{{-- @endcan --}}
@if(auth()->user()->can('Page-view') || auth()->user()->can('Content-view'))
<li>
    <a href="#">
        <i class="metismenu-icon pe-7s-album"></i>
        Frontend CMS
        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
    </a>
    <ul>
        @can('Page-view')

        <li class="{{ request()->route()->getName() == 'admin.frontendCMS.page' ? 'mm-active' : '' }}">
            <a href="{{route('admin.frontendCMS.page')}}">
                <i class="metismenu-icon"></i>
                Pages
            </a>
        </li>
        @endcan
        @can('Content-view')
        <li class="{{ request()->route()->getName() == 'admin.frontendCMS.content' ? 'mm-active' : '' }}">
            <a href="{{route('admin.frontendCMS.content')}}">
                <i class="metismenu-icon"></i>
                Content
            </a>
        </li>
        @endcan
    </ul>
</li>
@endIf






