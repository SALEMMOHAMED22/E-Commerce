@extends('layouts.dashboard.app')

@section('title')
    Welcome
@endsection
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body text-center p-5">
                        <h1 class="display-5 fw-bold mb-4">Welcome to Your Dashboard 👋</h1>
                        <p class="lead mb-4">
                            Hello <strong>@if(auth()->user()->name) {{ auth()->user()->name }} @endif</strong>, and welcome back to your <strong>eCommerce Control Panel</strong>!
                            <br>
                            From here, you can manage products, view orders, track customers, and more.
                        </p>

                        <div class="d-grid gap-3 d-sm-flex justify-content-center">
                            <a href="/dashboard/products" class="btn btn-primary btn-lg px-4">Manage Products</a>
                            <a href="/dashboard/orders" class="btn btn-outline-secondary btn-lg px-4">View Orders</a>
                        </div>

                        <hr class="my-5">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card border-0 bg-success text-white rounded-3 shadow-sm">
                                    <div class="card-body">
                                        <h5>Total Sales</h5>
                                        <h3>$12,450</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="card border-0 bg-info text-white rounded-3 shadow-sm">
                                    <div class="card-body">
                                        <h5>New Orders</h5>
                                        <h3>38</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3 mt-md-0">
                                <div class="card border-0 bg-warning text-dark rounded-3 shadow-sm">
                                    <div class="card-body">
                                        <h5>Customers</h5>
                                        <h3>1,204</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
