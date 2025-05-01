<div wire:poll.1s="loadData">
    @if(count($agriData) > 0)
        <div>
            @foreach ($agriData as $agri)
                <div class="mb-4">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/img/icons/unicons/agriculture.png') }}" alt="Agriculture Icon"
                                    class="me-2" style="width: 24px;">
                                <h5 class="mb-0">Smart Agriculture - {{ $agri['model']->device->nama_device ?? 'No Name' }}</h5>
                            </div>
                            <div class="device-status">
                                <span
                                    class="badge rounded-pill {{ $agri['is_active'] ? 'bg-success' : 'bg-secondary' }} d-flex align-items-center px-3 py-2">
                                    <span class="status-dot {{ $agri['is_active'] ? 'pulse-success' : '' }} me-2"></span>
                                    {{ $agri['is_active'] ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Data Level Air -->
                                <div class="col-6">
                                    <div class="card shadow-sm rounded-3 text-center">
                                        <div class="card-body">
                                            <div wire:ignore>
                                                <img src="{{ asset('assets/img/icons/unicons/water-drop.png') }}"
                                                    alt="Tetes Air" class="img-fluid animate-drop" style="width: 45px;" />
                                                <p class="text-muted fw-medium mt-2">Level Air</p>
                                            </div>
                                            <h5 class="text-info">
                                                @if($agri['model']->data1 !== null && $agri['model']->data1 !== '')
                                                    {{ $agri['model']->data1 }}%
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- Data Suhu -->
                                <div class="col-6">
                                    <div class="card shadow-sm rounded-3 text-center">
                                        <div class="card-body">
                                            <img src="https://cdn-icons-png.flaticon.com/512/869/869869.png" alt="Termometer"
                                                class="img-fluid animate-pulse" style="width: 45px;" />
                                            <p class="text-muted fw-medium mt-2">Suhu</p>
                                            <h5 class="text-danger">
                                                @if($agri['model']->data2 !== null && $agri['model']->data2 !== '')
                                                    {{ $agri['model']->data2 }}°C
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($agri['model']->data1 === null && $agri['model']->data2 === null)
                                <!-- Device Setup Notice -->
                                <div class="alert alert-info mt-3 mb-0" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-info-circle me-2"></i>
                                        <small class="mb-0">Device registered but not sending data yet. Please configure your
                                            ESP/IoT device.</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- No Agriculture Device State -->
        <div class="mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="empty-state-animation mb-4">
                        <img src="{{ asset('assets/img/icons/unicons/agriculture.png') }}" alt="Agriculture Icon"
                            class="img-fluid opacity-25 animate-pulse" style="width: 80px;">
                    </div>
                    <h5 class="text-muted mb-3">No Agriculture Devices</h5>
                    <p class="text-muted mb-4">You don't have any agriculture monitoring devices connected yet.</p>
                    <div class="d-flex justify-content-center">
                        <a href="/add-device" class="btn btn-outline-success btn-sm">
                            <i class="bx bx-plus me-1"></i>
                            Add Device
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>