<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('welcome') }}" class="app-brand-link">
            {{-- <div class="d-flex justify-content-center"> --}}
            <img src="{{ asset('logo.png') }}" alt="" class="w-100" />
            {{-- </div> --}}
            {{-- <span class="app-brand-text demo menu-text fw-bold">Vuexy</span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->is('admin/learning') ? 'active' : '' }}">
            <a href="{{ route('adminlearning') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div>Learning</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/sectionmodule') ? 'active' : '' }}">
            <a href="{{ route('sectionmodule') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div>Section Learning</div>
            </a>
        </li>
        @if (auth()->user()->hasAnyRole('super-admin', 'admin-unit'))
            <li class="menu-item {{ request()->is('admin/knowledge') ? 'active' : '' }}">
                <a href="{{ route('knowledge') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div>Knowledge</div>
                </a>
            </li>
        @endif
        @if (Auth::user()->hasRole('super-admin'))
            <li class="menu-item {{ request()->is('admin/approve') ? 'active' : '' }}">
                <a href="{{ route('approve') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-file-diff"></i>
                    <div>Approve Knowledge</div>
                </a>
            </li>
        @endif
        <li class="menu-item {{ request()->is('admin/request') ? 'active' : '' }}">
            <a href="{{ route('request') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-check"></i>
                <div>Approve Request</div>
            </a>
        </li>
        @if (Auth::user()->hasRole('super-admin'))
            <li class="menu-item {{ request()->is('admin/permission') ? 'active' : '' }}">
                <a href="{{ route('permission') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-lock-access"></i>
                    <div>Hak Akses</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/topic') ? 'active' : '' }}">
                <a href="{{ route('topic') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-presentation-analytics"></i>
                    <div>Topic</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/category') ? 'active' : '' }}">
                <a href="{{ route('category') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-category"></i>
                    <div>Category</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/categorylearn') ? 'active' : '' }}">
                <a href="{{ route('categorylearn') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-category"></i>
                    <div>Category Learning</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/ws') ? 'active' : '' }}">
                <a href="{{ route('ws') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-ripple"></i>
                    <div>Wilayah Sungai</div>
                </a>
            </li>
            <li class="menu-item {{ request()->is('admin/divisi') ? 'active' : '' }}">
                <a href="{{ route('divisi') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-section"></i>
                    <div>Divisi</div>
                </a>
            </li>
        @endif
        <li class="menu-item {{ request()->is('admin/profileuser') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->is('admin/profileuser') ? 'active' : '' }}">
                    <a href="{{ route('profileuser') }}" class="menu-link">
                        <div data-i18n="List">Profile</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
