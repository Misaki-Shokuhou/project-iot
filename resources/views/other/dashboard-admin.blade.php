@extends('template')

@section('title', 'Manage | Admin')

@section('add-device')
    <a href="/new-device" class="btn btn-sm btn-outline-primary">New Device</a>
@endsection

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
            <div class="col-xxl-12 mb-6 order-0">
                <div class="card">
                    <h5 class="card-header">Unregistered Device List</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>UUID</th>
                                    <th>Device Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($devices as $device)
                                    <tr>
                                        <td>{{ $device->device_uid }}</td>
                                        <td>{{ $device->tipe_device }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('edit.device', $device->id_unregistered) }}">
                                                        <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                                                    </a>

                                                    <form action="{{ route('delete.device', $device->id_unregistered) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this device?');">
                                                        @csrf
                                                        @method('POST')
                                                        <button class="dropdown-item" type="submit">
                                                            <i class="icon-base bx bx-trash me-1"></i>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No device found. <a href="/new-device">New Device</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection