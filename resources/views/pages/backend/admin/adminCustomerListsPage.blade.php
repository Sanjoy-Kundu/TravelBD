@extends('dashboard.layouts.admin.app')
@section('content')
    @include('dashboard.components.admin.navComponent')
    @include('dashboard.components.admin.sidebarComponent')
    @include('dashboard.components.admin.customer.adminCustomerListsComponent')
    @include('dashboard.components.admin.footerComponent')
    @include('dashboard.components.admin.customer.customerViewModalComponent')
@endsection