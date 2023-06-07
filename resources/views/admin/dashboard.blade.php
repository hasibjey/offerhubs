@extends('admin.layouts.muster')
@section('title', 'Dashboard')

@section('content')
    <div class="f-main-container">
        
        <div class="row m-0">
            <div class="col-md-12">
                <div class="row m-0 mb-5 justify-content-end">
                    <div class="col-md-3">
                        <div class="f-card">
                            <div class="f-card-title">
                                <i class="fa-solid fa-percent"></i>
                                Total offer
                            </div>
                            <div class="f-card-content">
                                100
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="f-card">
                            <div class="f-card-title">
                                <i class="fa-solid fa-tags"></i>
                                Total Category
                            </div>
                            <div class="f-card-content">
                                100
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="f-card">
                            <div class="f-card-title">
                                <i class="fa-solid fa-users"></i>
                                Total User
                            </div>
                            <div class="f-card-content">
                                100
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="f-card">
                            <div class="f-card-title">
                                <i class="fa-solid fa-users"></i>
                                Total Seller
                            </div>
                            <div class="f-card-content">
                                100
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="card">
                    <div class="card-header f-card-header">
                        <div class="f-title">today's information</div>
                    </div>
                    <div class="card-body f-card-body">
                        <div class="row m-0">
                            <div class="col-md-3">
                                <div class="f-card">
                                    <div class="f-card-title">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        sales
                                    </div>
                                    <div class="f-card-content">
                                        1,000.00
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="f-card">
                                    <div class="f-card-title">
                                        <i class="fa-solid fa-cart-arrow-down"></i>
                                        purchase
                                    </div>
                                    <div class="f-card-content">
                                        1,000.00
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="f-card">
                                    <div class="f-card-title">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                        due
                                    </div>
                                    <div class="f-card-content">
                                        1,000.00
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="f-card">
                                    <div class="f-card-title">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                        cash
                                    </div>
                                    <div class="f-card-content">
                                        1,000.00
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="f-card">
                                    <div class="f-card-title">
                                        <i class="fa-solid fa-sack-dollar"></i>
                                        bank
                                    </div>
                                    <div class="f-card-content">
                                        1,000.00
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection