@extends('dashboard.layouts.admin.app')
@section('content')
    @include('dashboard.components.agent.navComponent')
    @include('dashboard.components.agent.sidebarComponent')
    @include('dashboard.components.agent.customer.customerLists')
    @include('dashboard.components.agent.footerComponent')
        {{-- modal --}}
    @include('dashboard.components.agent.customer.viewCustomerComponent')
@endsection