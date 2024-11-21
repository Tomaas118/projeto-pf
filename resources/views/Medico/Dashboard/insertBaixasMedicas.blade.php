@extends('layouts.dashboard')

@section('title', 'Dashboard Médico')

@section('sidenav-content')
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
@endsection

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Section 1</h3>
                </div>
                <div class="card-body">
                    <p>Content for section 1.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Section 2</h3>
                </div>
                <div class="card-body">
                    <p>Content for section 2.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>Section 3</h3>
                </div>
                <div class="card-body">
                    <p>Content for section 3.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection