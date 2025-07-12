@extends('dashboard.layouts.customer.app')
@section('content')
    @include('dashboard.components.customer.navComponent')
    @include('dashboard.components.customer.sidebarComponent')
    @include('dashboard.components.customer.paymentComponent')
    @include('dashboard.components.customer.footerComponent')
@endsection