@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->

                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#orderList') }}" class="text-dark"><i
                                class="fa-solid fa-arrow-left mr-2"></i>Back</a>

                        <div class="row">
                            <div class="col-5">
                                <div class="card mt-4">
                                    <div class="card-header">

                                        <h3 class="text-center"><i class="fa-solid fa-clipboard mr-2"></i>Order Info
                                            <small class="text-danger">(has included delivery fee)</small>
                                        </h3>

                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col"><i class="fa-solid fa-user mr-2"></i>Customer Name</div>
                                            <div class="col">{{ strtoupper($orderList[0]->user_name) }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col"><i class="fa-solid fa-barcode mr-2"></i>Order Code</div>
                                            <div class="col">{{ $orderList[0]->order_code }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col"><i class="fa-regular fa-clock mr-2"></i>Order Date</div>
                                            <div class="col">{{ $orderList[0]->created_at->format('F-j-Y') }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col"><i class="fa-solid fa-circle-dollar-to-slot mr-2"></i>Total
                                            </div>
                                            <div class="col">{{ $order->total_price }} Kyats
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>

                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id=dataList>
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow">
                                        <td></td>
                                        <td class="">{{ $o->id }}</td>

                                        <td class="col-2"><img src="{{ asset('storage/' . $o->product_image) }}"
                                                class="img-thumbnail shadow-sm">
                                        </td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- <div class="mt-3">
                            {{ $order->links() }}
                        </div> --}}
                    </div>


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
