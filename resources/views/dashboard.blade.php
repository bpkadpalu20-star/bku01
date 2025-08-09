@extends('layouts.master')

@section('content')
<!-- Page Header -->
                <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                    <div>
                        <h4 class="mb-0">Hi, welcome back!</h4>
                        <p class="mb-0 text-muted">Sales monitoring dashboard template.</p>
                    </div>
                    <div class="main-dashboard-header-right">
						<div>

						</div>
						<div>
							{{-- <label class="fs-13 text-muted">Online Sales</label>
							<h5 class="mb-0 fw-semibold">563,275</h5> --}}
						</div>
						<div>
							{{-- <label class="fs-13 text-muted">Offline Sales</label>
							<h5 class="mb-0 fw-semibold">783,675</h5> --}}
						</div>
					</div>
                </div>
                <!-- End Page Header -->

                <!-- row -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-primary-gradient">
                            <div class="px-3 pt-3  pb-2 pt-0">
                                <div >
                                    <h6 class="mb-3 fs-12 text-fixed-white">TODAY ORDERS</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div >
                                            <h4 class="fs-20 fw-bold mb-1 text-fixed-white">$5,74.12</h4>
                                            <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last week</p>
                                        </div>
                                        <span class="float-end my-auto ms-auto">
                                            <i class="fas fa-arrow-circle-up text-fixed-white"></i>
                                            <span class="text-fixed-white op-7"> +427</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="compositeline"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-danger-gradient">
                            <div class="px-3 pt-3  pb-2 pt-0">
                                <div >
                                    <h6 class="mb-3 fs-12 text-fixed-white">TODAY EARNINGS</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div >
                                            <h4 class="fs-20 fw-bold mb-1 text-fixed-white">$1,230.17</h4>
                                            <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last week</p>
                                        </div>
                                        <span class="float-end my-auto ms-auto">
                                            <i class="fas fa-arrow-circle-down text-fixed-white"></i>
                                            <span class="text-fixed-white op-7"> -23.09%</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="compositeline2"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-success-gradient">
                            <div class="px-3 pt-3  pb-2 pt-0">
                                <div >
                                    <h6 class="mb-3 fs-12 text-fixed-white">TOTAL EARNINGS</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div >
                                            <h4 class="fs-20 fw-bold mb-1 text-fixed-white">$7,125.70</h4>
                                            <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last week</p>
                                        </div>
                                        <span class="float-end my-auto ms-auto">
                                            <i class="fas fa-arrow-circle-up text-fixed-white"></i>
                                            <span class="text-fixed-white op-7"> 52.09%</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="compositeline3"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                        <div class="card overflow-hidden sales-card bg-warning-gradient">
                            <div class="px-3 pt-3  pb-2 pt-0">
                                <div >
                                    <h6 class="mb-3 fs-12 text-fixed-white">PRODUCT SOLD</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <div >
                                            <h4 class="fs-20 fw-bold mb-1 text-fixed-white">$4,820.50</h4>
                                            <p class="mb-0 fs-12 text-fixed-white op-7">Compared to last week</p>
                                        </div>
                                        <span class="float-end my-auto ms-auto">
                                            <i class="fas fa-arrow-circle-down text-fixed-white"></i>
                                            <span class="text-fixed-white op-7"> -152.3</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="compositeline4"></div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->


@endsection
