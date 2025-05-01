@extends('template')

@section('title', 'Edit Device | Smart')

@section('menu')
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
                <span class="badge rounded-pill bg-danger ms-auto"></span>
            </a>
            <ul class="menu-sub">
                <li class="menu-item active">
                    <a href="/" class="menu-link">
                        <div class="text-truncate" data-i18n="Analytics">Home</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/device" class="menu-link">
                        <div class="text-truncate" data-i18n="CRM">Device</div>
                        <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto"></div>
                    </a>
                </li>
                <!-- <li class="menu-item">
                <a
                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/vertical-menu-template/app-ecommerce-dashboard.html"
                target="_blank"
                class="menu-link">
                <div class="text-truncate" data-i18n="eCommerce">Add Device</div>
                <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">Pro</div>
                </a>
                </li> -->
            </ul>
        </li>

        <!-- Tables -->
        <!-- <li class="menu-item">
                <a href="tables-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div class="text-truncate" data-i18n="Tables">Logout</div>
                </a>
              </li> -->

        <!-- Misc -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Other</span>
        </li>
        @auth
            @if (auth()->user()->role == 'admin')
                <li class="menu-item">
                    <a href="/dashboard-admin" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-layout"></i>
                        <div class="text-truncate" data-i18n="Support">Manage</div>
                    </a>
                </li>
            @endif
        @endauth
        <li class="menu-item">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="menu-link">
                <i class="icon-base bx bx-power-off icon-md me-3"></i>
                <div class="text-truncate" data-i18n="Documentation">Log Out</div>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
@endsection

<!-- Content -->
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Basic with Icons -->
            <div class="col-xxl">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Device</h5>
                        <small class="text-body-secondary float-end">Smart Device</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/update-device/' . $device->id_device) }}" method="POST">
                            @csrf
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="nama_device">Device
                                    Name</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="icon-base bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="nama_device" name="nama_device"
                                            value="{{ $device->nama_device }}" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6 mt-3">
                                <label class="col-sm-2 col-form-label" for="device_uid">UUID
                                    Device</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="icon-base bx bx-buildings"></i></span>
                                        <input type="text" id="device_uid" class="form-control"
                                            value="{{ $device->device_uid }}" readonly />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6 mt-3">
                                <label class="col-sm-2 col-form-label" for="tipe_device">Tipe
                                    Device</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="icon-base bx bx-category"></i></span>
                                        <input type="text" id="tipe_device" class="form-control"
                                            value="{{ $device->tipe_device }}" readonly />
                                    </div>
                                </div>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger mt-3">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="row justify-content-end mt-4">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update Device</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection