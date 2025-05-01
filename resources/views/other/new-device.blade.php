@extends('template')

@section('title', 'New | Admin')

@section('menu')
    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
                <span class="badge rounded-pill bg-danger ms-auto"></span>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
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
                <li class="menu-item active">
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
                        <h5 class="mb-0">Add New Device</h5>
                        <small class="text-body-secondary float-end">Smart Device</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">UUID Device</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="icon-base bx bx-buildings"></i>
                                        </span>
                                        <input type="text" name="device_uid"
                                            class="form-control @error('device_uid') is-invalid @enderror"
                                            id="basic-icon-default-fullname" placeholder="SMRT-89527"
                                            value="{{ old('device_uid') }}" />
                                    </div>
                                    @error('device_uid')
                                        <div class="invalid-feedback d-block mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-tipe-device">Tipe
                                    Device</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="icon-base bx bx-category"></i>
                                        </span>
                                        <select name="tipe_device" id="basic-icon-default-tipe-device"
                                            class="form-control @error('tipe_device') is-invalid @enderror">
                                            <option value="" disabled {{ old('tipe_device') ? '' : 'selected' }}>Pilih tipe
                                                device</option>
                                            <option value="Smart Home" {{ old('tipe_device') == 'Smart Home' ? 'selected' : '' }}>Smart Home</option>
                                            <option value="Smart Agriculture" {{ old('tipe_device') == 'Smart Agriculture' ? 'selected' : '' }}>Smart Agriculture</option>
                                            <option value="Smart Energy" {{ old('tipe_device') == 'Smart Energy' ? 'selected' : '' }}>Smart Energy</option>
                                        </select>
                                    </div>
                                    @error('tipe_device')
                                        <div class="invalid-feedback d-block mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <div class="form-text">Pilih salah satu tipe device yang sesuai</div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection