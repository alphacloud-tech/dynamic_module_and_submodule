<!-- Page Wrapper -->
@extends('backend.layouts.layout')
@section('pageTitle')
    {{ env('Page_Title') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">

                    <button type="button" class="btn btn-primary btn-label waves-effect waves-light float-end fs-11"
                        data-bs-toggle="modal" data-bs-target="#addData">
                        <i class="bx bx-add-to-queue label-icon align-middle fs-16 me-2"></i>
                        Add Sub Module
                    </button>
                    <h6 class="card-title mb-0">Sub - MODULES</h6>
                </div>

                @include('backend.layouts.nofication')

                <div class="card-body">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Module</th>
                                <th>Submodule</th>
                                <th>Link</th>
                                <th>Rank Order</th>
                                <th>Assigned To</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $key = 1; @endphp

                            @foreach ($submodules as $item)
                                <tr>
                                    <td>{{ $key++ }}</td>
                                    <td>
                                        {{ strtoupper($item->module->module) }}
                                    </td>
                                    <td>
                                        {{ strtoupper($item->submodule) }}
                                    </td>
                                    <td>{{ strtoupper($item->links) }}</td>
                                    <td>{{ $item->rank }}</td>

                                    <td>
                                        <div class="avatar-group">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-img="avatar-3.jpg"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                                title="Username">
                                                <img src="{{ asset('backend/assets/images/users/avatar-3.jpg') }} "
                                                    alt="" class="rounded-circle avatar-xxs" />
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-3 fs-15">
                                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#editData{{ $item->id }}">
                                                <i class="ri-edit-2-fill"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#deleteData{{ $item->id }}">
                                                <i class="ri-delete-bin-5-line"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                                <!-- edit flip -->
                                <div id="editData{{ $item->id }}" class="modal fade flip" tabindex="-1"
                                    aria-labelledby="editflipModalLabel{{ $item->id }}" aria-hidden="true"
                                    style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editflipModalLabel{{ $item->id }}">
                                                    Edit
                                                    Sub Module </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="fs-16">
                                                    {{-- Overflowing text to show scroll behavior --}}
                                                </h5>
                                                <p class="text-muted">

                                                <form method="post" action="{{ url('/sub-module/update') }}"
                                                    class="form-horizontal">
                                                    @csrf
                                                    <input type="hidden" class="form-control" id="submoduleID"
                                                        name="submoduleID" value="{{ $item->id }}" />

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="module" class="form-label">Select
                                                                    Module</label>
                                                                <select class="form-select form-select-lg"
                                                                    aria-label=".form-select-lg example" name="module"
                                                                    id="module">
                                                                    <option selected>Select Module </option>
                                                                    @foreach ($modules as $module)
                                                                        <option value="{{ $module->id }}"
                                                                            {{ $item->moduleid == $module->id ? 'selected' : '' }}>
                                                                            {{ $module->module }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="subModule" class="form-label">Sub Module
                                                                    Name </label>
                                                                <input type="text" class="form-control" id="subModule"
                                                                    name="subModule" value="{{ $item->submodule }}" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="route" class="form-label">Route</label>
                                                                <input type="text" class="form-control" id="route"
                                                                    name="route" value="{{ $item->links }}" />
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="rank" class="form-label">Rank</label>
                                                                <input type="text" class="form-control" id="rank"
                                                                    name="rank" value="{{ $item->rank }}" />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--end row-->

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update
                                                        </button>
                                                    </div>
                                                </form>
                                                </p>

                                            </div>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>

                                <!-- Delete flip -->
                                <div id="deleteData{{ $item->id }}" class="modal fade flip" tabindex="-1"
                                    aria-labelledby="deleteflipModalLabel{{ $item->id }}" aria-hidden="true"
                                    style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteflipModalLabel{{ $item->id }}">
                                                    Delete
                                                    SubModule </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="fs-16">
                                                    Are you sure you want to delete?
                                                </h5>
                                                <p class="text-muted">
                                                <form action="{{ url('/sub-module/delete') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" class="form-control" id="submoduleID"
                                                        name="submoduleID" value="{{ $item->id }}" />


                                                    <span style="color: red"> {{ $item->submodule }}</span>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Delete
                                                        </button>
                                                    </div>
                                                </form>
                                                </p>

                                            </div>

                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div id="addData" class="modal fade flip" tabindex="-1" aria-labelledby="editflipModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editflipModalLabel">
                        Add
                        Sub Module </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fs-16">
                        {{-- Overflowing text to show scroll behavior --}}
                    </h5>
                    <p class="text-muted">

                    <form method="post" action="{{ url('/sub-module/add') }}" class="form-horizontal">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="module" class="form-label">Select Module</label>
                                    <select class="form-select form-select-lg" aria-label=".form-select-lg example"
                                        name="module" id="module">
                                        <option selected>Select Module</option>
                                        @foreach ($modules as $item)
                                            <option value="{{ $item->id }}">- {{ $item->module }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="subModule" class="form-label">Sub Module Name</label>
                                    <input type="text" class="form-control" placeholder="" id="subModule"
                                        name="subModule" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="route" class="form-label">Route</label>
                                    <input type="text" class="form-control" placeholder="" id="route"
                                        name="route" />
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="rank" class="form-label">Rank</label>
                                    <input type="text" class="form-control" placeholder="" id="rank"
                                        name="rank" />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary"><i class="ri-file-add-line"></i>Add
                                        sub
                                        Module</button>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                    </p>

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection


@section('scripts')
@endsection

@section('styles')
@endsection
<!-- /Page Wrapper -->
