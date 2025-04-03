<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand"> <a href="#" class="brand-link">  <!--<img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">--> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light">20/20 PH</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                       <i class="nav-icon bi bi-house-door"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('data_view') }}" class="nav-link {{ request()->routeIs('data_view') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-grip-horizontal"></i>
                        <p>Data View</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('search')}}" class="nav-link {{ request()->routeIs('search') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-star-half"></i>
                        <p>Search</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('sfh_eng') }}" class="nav-link {{ request()->routeIs('sfh_eng') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-star-half"></i>
                        <p>SFH ENG</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('com_eng') }}" class="nav-link {{ request()->routeIs('com_eng') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-star-half"></i>
                        <p>COM ENG</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('sfh_eng_search') }}" class="nav-link  {{ request()->routeIs('sfh_eng_search') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-star-half"></i>
                        <p>SFH ENG Search</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('bulk_edit') }}" class="nav-link {{ request()->routeIs('bulk_edit') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-star-half"></i>
                        <p>Bulk Edit & Insert Line</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('search_editBy_dateField') }}" class="nav-link {{ request()->routeIs('search_editBy_dateField') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-star-half"></i>
                        <p>Search Edit By Date</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('sf_sort_filter') }}" class="nav-link {{ request()->routeIs('sf_sort_filter') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-star-half"></i>
                        <p>SF Sort Filter</p>
                    </a>
                </li>

                @if(Auth::check() && Auth::user()->designation === 'Admin')
                    <li class="nav-item">
                        <a href="{{ route('user.list') }}" class="nav-link {{ request()->routeIs('user.list') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin_logout') }}" class="nav-link">
                        <i class="nav-icon bi bi-star-half"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
