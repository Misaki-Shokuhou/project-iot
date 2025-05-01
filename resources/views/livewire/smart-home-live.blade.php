<div wire:poll.1s="loadData">
    @if(count($homeData) > 0)
        @foreach ($homeData as $home)
            <div class="mb-3">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/1670/1670080.png" alt="Home Icon" class="me-2"
                                style="width: 24px;">
                            <h5 class="mb-0">Smart Home - {{ $home['model']->device->nama_device ?? 'No Name' }}</h5>
                        </div>
                        <div class="device-status">
                            <span
                                class="badge rounded-pill {{ $home['is_active'] ? 'bg-success' : 'bg-secondary' }} d-flex align-items-center px-3 py-2">
                                <span class="status-dot {{ $home['is_active'] ? 'pulse-success' : '' }} me-2"></span>
                                {{ $home['is_active'] ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/img/icons/unicons/gas.png') }}" alt="Tabung Gas"
                            class="img-fluid animate-swing" style="width: 45px;" />
                        <p class="text-muted fw-medium mt-2">{{ $home['model']->device->nama_device ?? 'No Name' }}</p>
                        <h5 class="text-warning">{{ $home['model']->data1 ?? '-' }}%</h5>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <!-- No Home Device State -->
        <div class="mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="empty-state-animation mb-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/1670/1670080.png" alt="Home Icon"
                            class="img-fluid opacity-25 animate-swing" style="width: 80px;">
                    </div>
                    <h5 class="text-muted mb-3">No Smart Home Devices</h5>
                    <p class="text-muted mb-4">Your smart home setup is waiting for devices to be connected.</p>
                    <div class="d-flex justify-content-center">
                        <a href="/add-device" class="btn btn-outline-primary btn-sm">
                            <i class="bx bx-home me-1"></i>
                            Add Device
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>