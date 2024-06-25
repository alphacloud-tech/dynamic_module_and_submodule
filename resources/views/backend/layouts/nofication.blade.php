<div class="row">
    <div class="col-lg-12">
        @if (session('message'))
            <div class="card">

                <div class="card-body">

                    <div class="live-preview">
                        <div class="row">
                            <div class="col-xl-12">

                                @if (session('message'))
                                    <div class="alert bg-success alert-dismissible alert-label-icon rounded-label shadow text-white"
                                        role="alert">
                                        <i
                                            class="ri-notification-off-line label-icon fade show"></i><strong>Successful</strong>
                                        - {{ session('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error_message'))
                                    <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label shadow text-white mb-xl-0"
                                        role="alert">
                                        <i class="ri-error-warning-line label-icon"></i><strong>Error</strong>
                                        - {{ session('error_message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (count($errors) > 0)
                                    <div class="alert alert-danger alert-dismissible alert-label-icon rounded-label shadow text-white mb-xl-0"
                                        role="alert">
                                        <i class="ri-error-warning-line label-icon"></i><strong>Error</strong>
                                        -
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        @endif
        <!-- end card-body -->
    </div>
    <!-- end card -->
</div>
