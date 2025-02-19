<nav class="app-header navbar navbar-expand bg-body" style="margin-bottom: 20px;">
    <div class="container-fluid d-flex justify-content-between align-items-center"> 
        <!-- Left Section (Sidebar Toggle + Logo) -->
        <ul class="navbar-nav">
            <li class="nav-item"> 
                <a style="padding-top: 20px;" class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> 
                    <i class="bi bi-list"></i> 
                </a> 
            </li>
            <li class="nav-item"> 
                <img src="{{ asset('dist/assets/img/logo/logo.png') }}" 
                     alt="Logo" 
                     class="img-fluid d-block d-md-inline" 
                     style="max-width: 120px; height: auto;"> 
            </li>
        </ul>

        <!-- Centered Text Section (will center on desktop) -->
        <ul class="navbar-nav mx-auto text-center w-100 d-none d-md-flex justify-content-center">
            <li class="nav-item fw-bold fs-5">20/20 Plumbing Router</li>
        </ul>

        <!-- Right Section (Fullscreen + User Menu) -->
        <ul class="navbar-nav ms-auto"> 
            <li class="nav-item"> 
                <a class="nav-link" href="#" data-lte-toggle="fullscreen"> 
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> 
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> 
                </a> 
            </li>
            <li class="nav-item dropdown user-menu"> 
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> 
                    <img src="{{asset('dist/assets/img/User.png')}}" class="user-image rounded-circle shadow" alt="User Image"> 
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> 
                </a>
                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-end"> 
                    <li class="user-header text-bg-success"> 
                        <img src="{{asset('dist/assets/img/User.png')}}" class="rounded-circle shadow" alt="User Image">
                        <p>{{ Auth::user()->name }}</p>
                    </li> 
                    <li class="user-footer"> 
                        <a href="{{ route('profile.edit')}}" style="width: 100%;" class="btn btn-default btn-flat">Profile</a> <br> 
                        <a href="{{ route('admin_logout') }}"  style="width: 100%;" class="btn btn-default btn-flat">Logout</a> 
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
