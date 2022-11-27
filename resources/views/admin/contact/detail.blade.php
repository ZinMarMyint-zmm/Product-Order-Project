@extends('admin.layouts.master')

@section('title', 'Contact Detail')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    {{-- <div class="col-3 offset-8">
                        <a href="{{ route('category#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div> --}}
                </div>
                <div class="col-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <div>
                                    <a href="{{ route('admin#messageList') }}" class="text-dark">
                                        <i class="fa-solid fa-left-long"></i> Back
                                    </a>
                                </div>
                                <h3 class="text-center title-2">Inbox Message Detail</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#messageDetail', $message->id) }}" method="get"
                                novalidate="novalidate">
                                @csrf
                                <div class="form-group">

                                    <label class="control-label mb-1">Name</label>
                                    <input id="cc-pament" type="text" value="{{ $message->name }}" class="form-control"
                                        aria-required="true" aria-invalid="false" disabled>

                                </div>
                                <div class="form-group">

                                    <label class="control-label mb-1">Email</label>
                                    <input id="cc-pament" type="email" value="{{ $message->email }}" class="form-control"
                                        aria-required="true" aria-invalid="false" disabled>

                                </div>
                                <div class="form-group">

                                    <label class="control-label mb-1">Message</label>
                                    <textarea cols="30" class="form-control" rows="10" disabled>{{ $message->message }}</textarea>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
