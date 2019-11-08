@extends('layouts.theme-header-footer')

@section('title')
    <h1 class="m-0 text-dark">Billing</h1>
@endsection

@section('path')
    <li class="breadcrumb-item"><a href="#">Settings</a></li>
    <li class="breadcrumb-item active">Billing</li>
@endsection

@section('body')
    <div id="app">
        <billing-signatories></billing-signatories>
    </div>
@endsection
