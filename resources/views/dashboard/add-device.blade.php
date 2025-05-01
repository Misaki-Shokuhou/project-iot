@extends('template')

@section('title', 'Add Device | Smart')

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
                <li class="menu-item">
                    <a href="/" class="menu-link">
                        <div class="text-truncate" data-i18n="Analytics">Home</div>
                    </a>
                </li>
                <li class="menu-item active">
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
                        <h5 class="mb-0">Add Your Device</h5>
                        <small class="text-body-secondary float-end">Smart Device</small>
                    </div>
                    <div class="card-body">
                        <!-- Form for adding device -->
                        <form action="{{ url('/add-device') }}" method="POST">
                            @csrf <!-- Token CSRF untuk keamanan -->
                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Device Name</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="icon-base bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="basic-icon-default-fullname"
                                            name="nama_device" placeholder="Kamar Tidur" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="device_uid_number">UUID Device</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="icon-base bx bx-buildings"></i></span>
                                        <span class="input-group-text">SMRT -</span>
                                        <input type="text" id="device_uid_number" class="form-control"
                                            name="device_uid_number" placeholder="89527" required />
                                    </div>
                                </div>
                            </div>


                            <div class="row mb-6">
                                <label class="col-sm-2 col-form-label" for="basic-icon-default-tipe-device">Tipe
                                    Device</label>
                                <div class="col-sm-10">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="icon-base bx bx-category"></i></span>
                                        <select id="basic-icon-default-tipe-device" class="form-control" name="tipe_device"
                                            required>
                                            <option value="" selected disabled>Pilih tipe device
                                            </option>
                                            <option value="Smart Home">Smart Home</option>
                                            <option value="Smart Agriculture">Smart Agriculture</option>
                                            <option value="Smart Energy">Smart Energy</option>
                                        </select>
                                    </div>
                                    <div class="form-text">Pilih salah satu tipe device yang sesuai
                                    </div>
                                </div>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

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
    <!-- / Content -->
    </div>
    <!-- / Content wrapper -->


    <!-- Footer -->
    <footer class="content-footer footer bg-footer-theme">
    </footer>
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->

    <script src="assets/vendor/libs/jquery/jquery.js"></script>

    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>

    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->

    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>

    </html>
@endsection