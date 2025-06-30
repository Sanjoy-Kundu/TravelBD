@extends('dashboard.layouts.agent.app')
@section('content')
    @include('dashboard.components.agent.navComponent')
    @include('dashboard.components.agent.sidebarComponent')
    @include('dashboard.components.agent.profileViewComponent')
    @include('dashboard.components.agent.footerComponent')
    @include('dashboard.components.agent.modal.passwordResetComponent')
@endsection