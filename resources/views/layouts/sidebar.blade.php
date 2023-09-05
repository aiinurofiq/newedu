<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Vemto Logo" class="brand-image bg-white">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">

                @auth
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon icon ion-md-pulse"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-apps"></i>
                        <p>
                            Apps
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            @can('view-any', App\Models\User::class)
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Marital::class)
                            <li class="nav-item">
                                <a href="{{ route('maritals.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Maritals</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\City::class)
                            <li class="nav-item">
                                <a href="{{ route('cities.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Cities</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Gender::class)
                            <li class="nav-item">
                                <a href="{{ route('genders.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Genders</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Religion::class)
                            <li class="nav-item">
                                <a href="{{ route('religions.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Religions</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Bloodtype::class)
                            <li class="nav-item">
                                <a href="{{ route('bloodtypes.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Bloodtypes</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Tribe::class)
                            <li class="nav-item">
                                <a href="{{ route('tribes.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Tribes</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Fieldofposition::class)
                            <li class="nav-item">
                                <a href="{{ route('fieldofpositions.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Fieldofpositions</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\University::class)
                            <li class="nav-item">
                                <a href="{{ route('universities.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Universities</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Valvision::class)
                            <li class="nav-item">
                                <a href="{{ route('valvisions.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Valvisions</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Bumnclass::class)
                            <li class="nav-item">
                                <a href="{{ route('bumnclasses.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Bumnclasses</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Bumnsector::class)
                            <li class="nav-item">
                                <a href="{{ route('bumnsectors.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Bumnsectors</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Knowledge::class)
                            <li class="nav-item">
                                <a href="{{ route('knowledges.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Knowledges</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Category::class)
                            <li class="nav-item">
                                <a href="{{ route('categories.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Categories</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Topic::class)
                            <li class="nav-item">
                                <a href="{{ route('topics.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Topics</p>
                                </a>
                            </li>
                            @endcan
                            @can('view-any', App\Models\Division::class)
                            <li class="nav-item">
                                <a href="{{ route('divisions.index') }}" class="nav-link">
                                    <i class="nav-icon icon ion-md-radio-button-off"></i>
                                    <p>Divisions</p>
                                </a>
                            </li>
                            @endcan
                    </ul>
                </li>

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || 
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon icon ion-md-key"></i>
                        <p>
                            Access Management
                            <i class="nav-icon right icon ion-md-arrow-round-back"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('view-any', Spatie\Permission\Models\Role::class)
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link">
                                <i class="nav-icon icon ion-md-radio-button-off"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endif
                @endauth

                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.1//index.html" target="_blank" class="nav-link">
                        <i class="nav-icon icon ion-md-help-circle-outline"></i>
                        <p>Docs</p>
                    </a>
                </li>

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon icon ion-md-exit"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>