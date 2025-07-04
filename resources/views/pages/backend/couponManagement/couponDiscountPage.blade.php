@extends('dashboard.layouts.admin.app')
@section('content')
    @include('dashboard.components.admin.navComponent')
    @include('dashboard.components.admin.sidebarComponent')
    {{-- @include('dashboard.components.couponManagement.couponListsComponent') --}}
    @include('dashboard.components.admin.footerComponent')
    {{-- @include('dashboard.components.packageManagement.modal.packageCreateModalComponent')
    @include('dashboard.components.packageManagement.modal.packageViewComponent')
    @include('dashboard.components.packageManagement.modal.packageUpdateComponent')
    @include('dashboard.components.packageManagement.modal.packageCouponDiscountComponent') --}}
@endsection