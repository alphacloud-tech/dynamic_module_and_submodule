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
                    <h4 class="mb-sm-0"> Role Privileges</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Role Privileges</a></li>
                            <li class="breadcrumb-item active">Role Privileges</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('backend.layouts.nofication')

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ url('/module/add') }}" method="post">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Select user role</label>
                                        <select class="select2 form-control" name="role" id="role"
                                            onchange="Reload();">
                                            <option value="">--Select--</option>
                                            @foreach ($roles as $list)
                                                <option value="{{ $list->id }}"
                                                    {{ old('role') == $list->id || $role == $list->id ? 'selected' : '' }}>
                                                    {{ $list->rolename }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary mt-4"><i class="ri-file-add-line"></i>
                                            Submit</button>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-6">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary"><i class="ri-file-add-line"></i>Add
                                            Module</button>
                                    </div>
                                </div> --}}
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>

                </div>
            </div>
            <!-- end card -->
        </div>

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Role Privileges</h4>
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
                                        <th>Module</th>
                                        <th>Submodule</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $key = 1; @endphp
                                    @foreach ($submodules as $item)
                                        <tr>
                                            <td class="fw-medium">{{ $key++ }}</td>
                                            <td>{{ strtoupper($item->module) }}</td>
                                            <td>{{ $item->submodule }}</td>
                                            {{-- <td>
                                                <div class="status-toggle">
                                                    <input type="checkbox" id="status_{{ $item->modID }}"
                                                        name="arraysubModule_{{ $item->modID }}" class="check"
                                                        {{ $item->active ? 'checked' : '' }}>
                                                    <label for="status_{{ $item->modID }}" class="checktoggle"></label>
                                                </div>

                                                <div class="form-check form-switch form-switch-lg" dir="ltr">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="customSwitchsizelg{{ $item->modID }}"
                                                        name="arraysubModule_{{ $item->modID }}"
                                                        {{ $item->active ? 'checked' : '' }}>

                                                    <label class="form-check-label"
                                                        for="customSwitchsizelg{{ $item->modID }}"></label>
                                                </div>
                                            </td> --}}

                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" checked id="toggle"
                                                        data-active-id="{{ $item->id }}" name="active"
                                                        data-active="{{ $item->active ? '1' : '0' }}">
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
@endsection


@section('scripts')
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}

    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: red;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #55CE63;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #55CE63;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection

@section('styles')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            const toggleElements = document.querySelectorAll('input[name="active"]');
            toggleElements.forEach(function(toggle) {
                const isActive = toggle.getAttribute('data-active');
                toggle.checked = isActive === '1';
                // Add an event listener to handle changes and make AJAX requests
                toggle.addEventListener('change', function() {
                    const activeId = toggle.getAttribute('data-active-id');
                    const isChecked = toggle.checked;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                    });

                    // Send an AJAX request to update the "active" status
                    $.ajax({
                        type: 'POST',
                        url: `/blog-activate/${activeId}`,
                        data: {
                            active: isChecked ? '1' : '0'
                        },
                        success: function(data) {
                            if (data.success) {
                                if (isChecked) {
                                    Swal.fire('Success',
                                        'Blog activated successfully.',
                                        'success');
                                } else {
                                    Swal.fire('Success',
                                        'Blog deactivated successfully.',
                                        'success');
                                }
                            } else {
                                Swal.fire('Error', 'Error updating blog status.',
                                    'error');
                            }
                        },
                        error: function() {
                            alert('An error occurred.');
                        },
                    });
                });
            });
        });
    </script>
@endsection
<!-- /Page Wrapper -->
