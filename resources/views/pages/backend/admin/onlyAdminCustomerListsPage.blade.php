@extends('dashboard.layouts.admin.app')
@section('content')
    @include('dashboard.components.admin.navComponent')
    @include('dashboard.components.admin.sidebarComponent')
    @include('dashboard.components.admin.customer.onlyAdminCustomerListsComponent')
    @include('dashboard.components.admin.footerComponent')
    {{-- modal --}}
    @include('dashboard.components.admin.modal.viewComponent')
@endsection