<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <!-- Style Switcher -->
        <div class="navbar-nav align-items-center">
            <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                <i class='ti ti-sm'></i>
            </a>
        </div>
        <!--/ Style Switcher -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('icon.png') }}" alt class="w-px-40 h-auto rounded-circle">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('icon.png') }}" alt class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">
                                        {{ Auth::user()->name }}
                                    </span>
                                    <small class="text-muted">{{ Auth::user()->getRoleNames()->first() }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        {{-- <button type="submit">Logout</button> --}}
                        <a class="dropdown-item" href="{{ route('profileuser') }}">
                            <i class='ti ti-user me-2'></i>
                            <span class="align-middle">Profile</span>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                            {{-- <button type="submit">Logout</button> --}}
                            <button class="dropdown-item" href="{{ route('logout') }}">
                                <i class='ti ti-login me-2'></i>
                                <span class="align-middle">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

</nav>
