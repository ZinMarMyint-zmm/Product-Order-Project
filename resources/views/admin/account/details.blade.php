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
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2 mt-5">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('images/male_default.png') }}" class="img-thumbnail">
                                        @else
                                            <img src="{{ asset('images/female_default.jpg') }}" class="img-thumbnail">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" />
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class="my-4"> <i class="fa-solid fa-user-pen mr-2"></i>{{ Auth::user()->name }}
                                    </h4>
                                    <h4 class="my-4"> <i class="fa-solid fa-envelope mr-2"></i>{{ Auth::user()->email }}
                                    </h4>
                                    <h4 class="my-4"> <i class="fa-solid fa-phone mr-2"></i>{{ Auth::user()->phone }}</h4>
                                    <h4 class="my-4"> <i
                                            class="fa-solid fa-address-card mr-2"></i>{{ Auth::user()->address }}
                                    </h4>
                                    <h4 class="my-4"><i
                                            class="fa-solid fa-mars-and-venus mr-2"></i>{{ Auth::user()->gender }}
                                    </h4>
                                    <h4 class="my-4"> <i
                                            class="fa-solid fa-user-clock mr-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                    </h4>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-4 offset-2">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn bg-dark text-white">
                                            <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Profile
                                        </button>
                                    </a>
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
