@extends('template')

@section('title', 'Home | Smart')

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
            </ul>
        </li>

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
            <div class="col-xl-8">
                <livewire:smart-energy-live />
            </div>
            <div class="col-xl-4">
                <livewire:smart-agriculture-live />
                <livewire:smart-home-live />
            </div>
        </div>
    </div>

    <!-- Animations -->
    <style>
        @keyframes drop {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(5px);
            }
        }

        @keyframes swing {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(5deg);
            }

            50% {
                transform: rotate(-5deg);
            }

            75% {
                transform: rotate(3deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-drop {
            animation: drop 2s infinite ease-in-out;
        }

        .animate-swing {
            animation: swing 2s infinite ease-in-out;
        }

        .animate-pulse {
            animation: pulse 1.5s infinite;
        }

        /* Status bulat */
        .status-dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: currentColor;
        }

        /* Efek pulse untuk status aktif */
        .pulse-success {
            background-color: #ffffff;
            box-shadow: 0 0 0 rgba(40, 167, 69, 0.4);
            animation: pulse-success 2s infinite;
        }

        @keyframes pulse-success {
            0% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
            }
        }

        /* Gaya badge status */
        .badge {
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
        }

        .badge.bg-success {
            background-color: #28a745 !important;
        }

        .badge.bg-secondary {
            background-color: #6c757d !important;
        }

        .device-status {
            transition: transform 0.2s ease;
        }

        .device-status:hover {
            transform: scale(1.05);
        }

        /* Additional styles for empty state - Add this to your existing styles */

        .empty-state-animation {
            transition: transform 0.3s ease;
        }

        .empty-state-animation:hover {
            transform: scale(1.05);
        }

        /* Enhanced animations for empty state */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card.border-0.shadow-sm {
            animation: fadeInUp 0.6s ease-out;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border: 1px solid rgba(0, 0, 0, 0.05) !important;
        }

        /* Button hover effects */
        .btn-outline-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        }

        .btn-outline-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(13, 110, 253, 0.3);
        }

        .btn-outline-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3);
        }

        /* Subtle gradient for empty state cards */
        .empty-state-animation img {
            filter: grayscale(30%);
            transition: filter 0.3s ease;
        }

        .empty-state-animation:hover img {
            filter: grayscale(0%);
        }

        /* Simple Clean Grid Layout */
        .simple-energy-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .simple-energy-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Simple Metric Cards */
        .simple-metric-card {
            background: #ffffff;
            padding: 24px 20px;
            text-align: center;
            transition: all 0.2s ease;
            position: relative;
        }

        .simple-metric-card:hover {
            background: #f8fafc;
        }

        .simple-metric-card:first-child {
            border-radius: 12px 0 0 12px;
        }

        .simple-metric-card:last-child {
            border-radius: 0 12px 12px 0;
        }

        @media (max-width: 768px) {
            .simple-metric-card:first-child {
                border-radius: 12px 12px 0 0;
            }

            .simple-metric-card:last-child {
                border-radius: 0 0 12px 12px;
            }

            .simple-metric-card:only-child {
                border-radius: 12px;
            }
        }

        /* Labels */
        .metric-label-simple {
            font-size: 14px;
            font-weight: 500;
            color: #6b7280;
            margin-bottom: 8px;
            letter-spacing: 0.025em;
        }

        /* Values */
        .metric-value-simple {
            font-size: 32px;
            font-weight: 600;
            line-height: 1;
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 2px;
        }

        .voltage-value {
            color: #3b82f6;
        }

        .current-value {
            color: #10b981;
        }

        .power-value {
            color: #8b5cf6;
        }

        /* Units */
        .unit-simple {
            font-size: 18px;
            font-weight: 500;
            color: #9ca3af;
            margin-left: 2px;
        }

        /* Subtle hover animations */
        .simple-metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: transparent;
            transition: all 0.3s ease;
        }

        .simple-metric-card:hover::before {
            background: currentColor;
        }

        .simple-metric-card:nth-child(1):hover::before {
            background: #3b82f6;
        }

        .simple-metric-card:nth-child(2):hover::before {
            background: #10b981;
        }

        .simple-metric-card:nth-child(3):hover::before {
            background: #8b5cf6;
        }

        /* Fade in animation */
        .simple-metric-card {
            animation: fadeIn 0.5s ease-out;
        }

        .simple-metric-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .simple-metric-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .simple-metric-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Value counter animation */
        .metric-value-simple {
            animation: countUp 0.8s ease-out;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
@endsection