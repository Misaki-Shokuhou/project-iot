<div wire:poll.1s="loadData">
    @if(count($energyData) > 0)
        @foreach ($energyData as $energy)
            @php
                $energyModel = $energy['model'];
                $isActive = $energy['is_active'];
            @endphp
            <div class="mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/img/icons/unicons/energy.png') }}" alt="Energy Icon" class="me-2"
                                style="width: 24px;">
                            <h5 class="mb-0">Smart Energy - {{ $energyModel->device->nama_device ?? 'No Name' }}</h5>
                        </div>
                        <div class="device-status">
                            <span
                                class="badge rounded-pill {{ $isActive ? 'bg-success' : 'bg-secondary' }} d-flex align-items-center px-3 py-2">
                                <span class="status-dot {{ $isActive ? 'pulse-success' : '' }} me-2"></span>
                                {{ $isActive ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Simple Clean Data Display -->
                        <div class="simple-energy-grid mb-4">
                            <!-- Voltage -->
                            <div class="simple-metric-card">
                                <div class="metric-label-simple">Voltage</div>
                                <div class="metric-value-simple voltage-value">
                                    {{ $energyModel->data1 ?? '-' }}<span class="unit-simple">V</span>
                                </div>
                            </div>

                            <!-- Current -->
                            <div class="simple-metric-card">
                                <div class="metric-label-simple">Current</div>
                                <div class="metric-value-simple current-value">
                                    {{ $energyModel->data2 ?? '-' }}<span class="unit-simple">A</span>
                                </div>
                            </div>

                            <!-- Power -->
                            <div class="simple-metric-card">
                                <div class="metric-label-simple">Power</div>
                                <div class="metric-value-simple power-value">
                                    {{ $energyModel->data3 ?? '-' }}<span class="unit-simple">W</span>
                                </div>
                            </div>
                        </div>

                        <div class="chart-container" style="height: 30px;">
                            <canvas id="electrical-chart-{{ $loop->index }}"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <!-- No Energy Device State -->
        <div class="mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-5">
                    <div class="empty-state-animation mb-4">
                        <img src="{{ asset('assets/img/icons/unicons/energy.png') }}" alt="Energy Icon"
                            class="img-fluid opacity-25 animate-drop" style="width: 80px;">
                    </div>
                    <h5 class="text-muted mb-3">No Energy Monitoring Devices</h5>
                    <p class="text-muted mb-4">Start monitoring your energy consumption by adding your first device.</p>
                    <div class="d-flex justify-content-center">
                        <a href="/add-device" class="btn btn-outline-warning btn-sm">
                            <i class="bx bx-plug me-1"></i>
                            Add Device
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>