@extends('dashboard.layouts.admin.app')
@section('content')
    @include('dashboard.components.admin.navComponent')
    @include('dashboard.components.admin.sidebarComponent')
    @include('dashboard.components.packageManagement.packageCategoryComponent')
    @include('dashboard.components.admin.footerComponent')
@endsection