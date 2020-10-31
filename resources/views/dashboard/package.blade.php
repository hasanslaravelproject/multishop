
@extends('mastering')
@section('maincontent')

    <div class="page-body">

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Package
                                <small>Multikart Admin panel</small>
                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="index.html">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-home">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                    </svg>
                                </a></li>
                            <li class="breadcrumb-item">Physical</li>
                            <li class="breadcrumb-item active">Package</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Packages Package</h5>
                        </div>
                        <div class="card-body">
                            <div class="btn-popup pull-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-original-title="test"
                                        data-target="#exampleModal">Add Package
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Physical
                                                    Package</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="form4submit" enctype="multipart/form-data">
                                                    <div class="form">
                                                        <input id="id4update" type="text" name="id4update" value="" hidden>
                                                        <div class="form-group">
                                                            <label for="pack_name" class="mb-1">Package Name :</label>
                                                            <input class="form-control" id="pack_name" name="pack_name" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pack_price" class="mb-1">Package Price :</label>
                                                            <input class="form-control" id="pack_price" name="pack_price" type="text">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pack_validity" class="mb-1">Package Validity :</label>
                                                            <input class="form-control" id="pack_validity" name="pack_validity" type="text">
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="submit" id="state" value="save">Save</button>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-responsive-sm " id="example" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Package Name</th>
                                    <th>Package Price</th>
                                    <th>Package Validity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($s=1)
                                @foreach($pack as $c)
                                    <tr>
                                        <td>{{$s++}}</td>
                                        <td>
                                            {{$c->pack_name}}
                                        </td>

                                        <td>
                                            {{$c->pack_price}}
                                        </td>
                                        <td>
                                            {{$c->pack_validity}}
                                        </td>
                                        <td>
                                            @if($c->pack_status == 1)
                                                <button class="btn btn-sm btn-success">Enabled</button>
                                            @else
                                                <button class="btn btn-sm btn-danger">Disabled</button>
                                            @endif
                                        </td>
                                        <td style="width: 325px;">
                                            <button class="btn btn-sm btn-primary st_change" value="{{$c->id}}">Status</button>
                                            <button class="btn btn-sm btn-warning edit" value="{{$c->id}}">Edit</button>
                                            <button class="btn btn-sm btn-danger delete" value="{{$c->id}}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>





                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

    </div>
@endsection
