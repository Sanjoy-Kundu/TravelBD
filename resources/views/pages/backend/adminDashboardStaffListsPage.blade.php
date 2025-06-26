{{-- adminDashboardStaffLists.blade.php --}}
@extends('dashboard.layouts.admin.app')
@section('content')
    @include('dashboard.components.admin.navComponent')
    @include('dashboard.components.admin.sidebarComponent')
    @include('dashboard.components.admin.staffListsComponent')
    @include('dashboard.components.admin.footerComponent')
    {{-- modal --}}
    {{-- @include('dashboard.components.admin.modal.viewComponent') --}}
@endsection