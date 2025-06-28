@extends('dashboard.layouts.staff.app')
@section('content')
    @include('dashboard.components.staff.navComponent')
    @include('dashboard.components.staff.sidebarComponent')
    @include('dashboard.components.staff.profileViewComponent')
    @include('dashboard.components.staff.footerComponent')
    @include('dashboard.components.staff.modal.passwordResetComponent')
@endsection