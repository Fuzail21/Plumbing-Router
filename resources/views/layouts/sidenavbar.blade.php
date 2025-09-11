<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="#" class="brand-link">
            <span class="brand-text fw-light">20/20 PH</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                @auth
                    {{-- Authenticated sidebar (full dashboard) --}}
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
                            <i class="nav-icon bi bi-search"></i>
                            <p>Search</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('sfh_eng') }}" class="nav-link {{ request()->routeIs('sfh_eng') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-diagram-3"></i>
                            <p>SFH ENG</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('com_eng') }}" class="nav-link {{ request()->routeIs('com_eng') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-diagram-3"></i>
                            <p>COM ENG</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('sfh_eng_search') }}" class="nav-link {{ request()->routeIs('sfh_eng_search') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-search"></i>
                            <p>SFH ENG Search</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('bulk_edit') }}" class="nav-link {{ request()->routeIs('bulk_edit') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-pencil-square"></i>
                            <p>Bulk Edit & Insert Line</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('search_editBy_dateField') }}" class="nav-link {{ request()->routeIs('search_editBy_dateField') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-calendar"></i>
                            <p>Search Edit By Date</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('sf_sort_filter') }}" class="nav-link {{ request()->routeIs('sf_sort_filter') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-funnel"></i>
                            <p>SF Sort Filter</p>
                        </a>
                    </li>

                    @if(Auth::user()->designation === 'Admin')
                        <li class="nav-item">
                            <a href="{{ route('user.list') }}" class="nav-link {{ request()->routeIs('user.list') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-people"></i>
                                <p>Users</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('supervisors.add') }}" class="nav-link {{ request()->routeIs('supervisors.add') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-plus"></i>
                                <p>Add Supervisors</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('deleted.records') }}" class="nav-link {{ request()->routeIs('deleted.records') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-trash"></i>
                                <p>Deleted Records</p>
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('admin_logout') }}" class="nav-link">
                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                @else
                    {{-- Public portal sidebar (7 pages only) --}}
                    <li class="nav-item">
                        <a href="{{ route('portal.home') }}" class="nav-link {{ request()->routeIs('portal.home') ? 'active' : '' }}">
                           <i class="nav-icon bi bi-house-door"></i>
                           <p>Home</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('portal.data_view') }}" class="nav-link {{ request()->routeIs('portal.data_view') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-grip-horizontal"></i>
                            <p>Data View</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('portal.search') }}" class="nav-link {{ request()->routeIs('portal.search') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-search"></i>
                            <p>Search</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('portal.sfh_eng') }}" class="nav-link {{ request()->routeIs('portal.sfh_eng') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-diagram-3"></i>
                            <p>SFH ENG</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('portal.com_eng') }}" class="nav-link {{ request()->routeIs('portal.com_eng') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-diagram-3"></i>
                            <p>COM ENG</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('portal.sfh_eng_search') }}" class="nav-link {{ request()->routeIs('portal.sfh_eng_search') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-search"></i>
                            <p>SFH ENG Search</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('portal.sf_sort_filter') }}" class="nav-link {{ request()->routeIs('portal.sf_sort_filter') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-funnel"></i>
                            <p>SF Sort Filter</p>
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</aside>
