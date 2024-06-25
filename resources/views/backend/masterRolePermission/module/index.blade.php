<!-- Page Wrapper -->
@extends('backend.layouts.layout')
@section('pageTitle')
    {{ env('Page_Title') }}
@endsection

@section('content')
    <div class="row">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"> MODULES</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">MODULES</a></li>
                            <li class="breadcrumb-item active">MODULES</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('backend.layouts.nofication')

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">ALL MODULES</h4>
                </div>
                <!-- end card header -->

                <div class="card-body">
                    {{-- <p class="text-muted">Use <code>table-borderless</code> to set a table without borders.</p> --}}
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table table-border align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Module Name</th>
                                        <th scope="col">Rank</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $key = 1; @endphp
                                    @foreach ($modules as $item)
                                        <tr>
                                            <td class="fw-medium">{{ $key++ }}</td>
                                            <td>{{ strtoupper($item->module) }}</td>
                                            <td>{{ $item->module_rank }}</td>
                                            <td>
                                                <div class="hstack gap-3 fs-15">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editData{{ $item->id }}">
                                                        <i class="ri-edit-2-fill"></i>
                                                    </button>

                                                    <button type="button"
                                                        class="btn btn-danger btn-icon waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteData{{ $item->id }}">
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
                                                            Module </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="fs-16">
                                                            {{-- Overflowing text to show scroll behavior --}}
                                                        </h5>
                                                        <p class="text-muted">
                                                        <form action="{{ url('/module/update') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" class="form-control"
                                                                placeholder="Enter your module name" id="moduleID"
                                                                name="moduleID" value="{{ $item->id }}" />

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label for="module" class="form-label">Module
                                                                            Name</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter your module name"
                                                                            id="moduleName" name="moduleName"
                                                                            value="{{ $item->module }}" />
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label for="rank"
                                                                            class="form-label">Rank</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="" id="rank" name="rank"
                                                                            value="{{ $item->module_rank }}" />
                                                                    </div>
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <br>
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
                                                        <h5 class="modal-title"
                                                            id="deleteflipModalLabel{{ $item->id }}">Delete
                                                            Module </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5 class="fs-16">
                                                            Are you sure you want to delete?
                                                        </h5>
                                                        <p class="text-muted">
                                                        <form action="{{ url('/module/delete') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" class="form-control"
                                                                placeholder="Enter your module name" id="moduleID"
                                                                name="moduleID" value="{{ $item->id }}" />


                                                            <span style="color: red"> {{ $item->module }}</span>

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
            <!-- end card -->
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Module Registration</h4>
                    {{-- <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="tables-without-border-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox"
                                id="tables-without-border-showcode" />
                        </div>
                    </div> --}}
                </div>
                <!-- end card header -->

                <div class="card-body">
                    {{-- <p class="text-muted">Use <code>table-borderless</code> to set a table without borders.</p> --}}
                    <div class="live-preview">
                        <form action="{{ url('/module/add') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="module" class="form-label">Module Name</label>
                                        <input type="text" class="form-control" placeholder="Enter your module name"
                                            id="moduleName" name="moduleName" />
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
                                        <button type="submit" class="btn btn-primary"><i
                                                class="ri-file-add-line"></i>Add
                                            Module</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>

                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
@endsection


@section('scripts')
@endsection

@section('styles')
@endsection
<!-- /Page Wrapper -->
