@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->


                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif


                    <div class="row mb-4">
                        <div class="col-3">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }}</span>
                            </h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#list') }}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search....."
                                        value="{{ request('key') }}">
                                    <button class="btn btn-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-1 offset-10 btn bg-white shadow-sm">
                            <h3><i class="fa-solid fa-database mr-2"></i>{{ $admins->total() }}</h3>
                        </div>
                    </div>


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr class="tr-shadow">
                                        <td class="col-1">
                                            @if ($admin->image == null)
                                                @if ($admin->gender == 'male')
                                                    <img src="{{ asset('images/male_default.png') }}"
                                                        class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{ asset('images/female_default.jpg') }}"
                                                        class="img-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $admin->image) }}"
                                                    class="img-thumbnail shadow-sm">
                                            @endif
                                        </td>
                                        <input type="hidden" id="adminId" value="{{ $admin->id }}">
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->gender }}</td>
                                        <td>{{ $admin->phone }}</td>
                                        <td>{{ $admin->address }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                @if (Auth::user()->id == $admin->id)
                                                @else
                                                    <select class="form-control statusChange mr-3">
                                                        <option value="user"
                                                            @if ($admin->role == 'user') selected @endif>
                                                            User</option>
                                                        <option value="admin"
                                                            @if ($admin->role == 'admin') selected @endif>
                                                            Admin</option>
                                                    </select>

                                                    <a href="{{ route('admin#delete', $admin->id) }}">
                                                        <button class="item mr-1" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $admins->links() }}

                        </div>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
    <script>
        $(document).ready(function() {

            //change status
            $('.statusChange').change(function() {

                $currentStatus = $(this).val();

                $parentNode = $(this).parents("tr");
                $adminId = $parentNode.find('#adminId').val();

                $data = {
                    'adminId': $adminId,
                    'role': $currentStatus
                };

                console.log($data)

                $.ajax({
                    type: 'get',
                    url: '/admin/change/role',
                    data: $data,
                    dataType: 'json',

                })
                location.reload();
            })
        })
    </script>
@endsection
