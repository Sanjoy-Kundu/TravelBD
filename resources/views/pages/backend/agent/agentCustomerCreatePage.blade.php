@extends('dashboard.layouts.admin.app')
@section('content')
    @include('dashboard.components.agent.navComponent')
    @include('dashboard.components.agent.sidebarComponent')
    @include('dashboard.components.agent.customer.customerCreateComponent')
    @include('dashboard.components.agent.footerComponent')
@endsection