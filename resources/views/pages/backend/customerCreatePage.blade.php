@extends('dashboard.layouts.admin.app')
@section('content')
    @include('dashboard.components.admin.navComponent')
    @include('dashboard.components.admin.sidebarComponent')
    @include('dashboard.components.admin.customer.customerCreateComponent')
    @include('dashboard.components.admin.footerComponent')
@endsection