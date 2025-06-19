<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">AdminKu</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">ADM</a>
        </div>
        <ul class="sidebar-menu">

            <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="fas fa-users"></i> <span>Users</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('companies.*') ? 'active' : '' }}">
                <a href="{{ route('companies.show', 1) }}" class="nav-link">
                    <i class="fas fa-building"></i> <span>Company</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                <a href="{{ route('attendances.index') }}" class="nav-link">
                    <i class="fas fa-calendar-check"></i> <span>Attendances</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                <a href="{{ route('permissions.index') }}" class="nav-link">
                    <i class="fas fa-key"></i> <span>Permission</span>
                </a>
            </li>

            {{-- <li class="nav-item {{ request()->routeIs('qr_absens.*') ? 'active' : '' }}">
                <a href="{{ route('qr_absens.index') }}" class="nav-link">
                    <i class="fas fa-qrcode"></i> <span>QR Absen</span>
                </a>
            </li> --}}

            <li class="nav-item {{ request()->routeIs('location-histories.index') ? 'active' : '' }}">
                <a href="{{ route('location-histories.index') }}" class="nav-link">
                    <i class="fas fa-map-marker-alt"></i> <span>Location Histories</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('location-histories.out-of-range') ? 'active' : '' }}">
                <a href="{{ route('location-histories.out-of-range') }}" class="nav-link">
                    <i class="fas fa-exclamation-triangle"></i> <span>Laporan Keluar Jangkauan</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
