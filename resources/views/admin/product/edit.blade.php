@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-3 offset-7 mb-2">
                @if (session('updateSuccess'))
                    <div class="">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">

                        <div class="card-body">
                            <div class="ml-3 text-decoration-none">
                                <a href="{{ route('product#list') }}">
                                    <i class="fa-solid fa-arrow-left text-dark"></i>
                                </a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2"></h3>
                            </div>


                            <div class="row">
                                <div class="col-3 offset-2 mt-5">

                                    <img src="{{ asset('storage/' . $pizza->image) }}" class="img-thumbnail shadow-sm" />

                                </div>
                                <div class="col-7 mb-5">
                                    <h3 class="my-3 text-warning w-75 text-center"> {{ $pizza->name }}
                                    </h3>
                                    <div class="">
                                        <span class="my-3 mr-2 btn btn-dark text-white"> <i
                                                class="fa-solid fs-4 fa-money-bill-1-wave mr-2"></i>{{ $pizza->price }}
                                            Kyats
                                        </span>
                                        <span class="my-3 mr-2 btn btn-dark text-white"> <i
                                                class="fa-solid fs-4 fa-clock mr-2"></i>{{ $pizza->waiting_time }}
                                        </span>
                                        <span class="my-3 mr-2 btn btn-dark text-white"> <i
                                                class="fa-solid fs-4 fa-eye mr-2"></i>{{ $pizza->view_count }}
                                        </span>
                                        <span class="my-3 mr-2 btn btn-dark text-white"> <i
                                                class="fa-solid fa-clone mr-2"></i>{{ $pizza->category_name }}
                                        </span>
                                        <span class="my-3 mr-2 btn btn-dark text-white"> <i
                                                class="fa-solid fs-4 fa-user-clock mr-2"></i>{{ $pizza->created_at->format('j-F-Y') }}
                                        </span>
                                    </div>
                                    <div class="my-3 text-dark"><i class="fa-solid fs-4 fa-file-lines mr-2"></i>Details
                                        <div class="text-muted mt-2">{{ $pizza->description }}</div>
                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
