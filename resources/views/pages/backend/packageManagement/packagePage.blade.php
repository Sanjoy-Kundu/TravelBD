@extends('dashboard.layouts.admin.app')
@section('content')
    @include('dashboard.components.admin.navComponent')
    @include('dashboard.components.admin.sidebarComponent')
    @include('dashboard.components.packageManagement.packageListsComponent')
    @include('dashboard.components.admin.footerComponent')
    @include('dashboard.components.packageManagement.modal.packageCreateModalComponent')
    @include('dashboard.components.packageManagement.modal.packageViewComponent')
    @include('dashboard.components.packageManagement.modal.packageUpdateComponent')


    @include('dashboard.components.packageManagement.modal.packageCouponDiscountComponent')
    @include('dashboard.components.packageManagement.modal.couponListsComponent')
    @include('dashboard.components.packageManagement.modal.couponEditComponent')
@endsection