@extends('admin.layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">
                                Library
                            </li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-border-inside"></i>
                        </h1>
                        <h6 class="text-white">Category({{ $categoryCount }})</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-2 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-arrow-all"></i>
                        </h1>
                        <h6 class="text-white">NFT({{ $nft }})</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
