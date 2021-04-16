<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }} " href="{{url('/admin/dashboard')}}">Dashboard</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('admin/teams')) ? 'active' : '' }} " href="{{url('/admin/teams')}}">Team</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="{{ (request()->is('admin/categories')) || (request()->is('admin/posts'))  ? false : true }}" data-target="#submenu-1" aria-controls="submenu-1"><i class="fab fa-blogger"></i>Blog <span class="badge badge-success">6</span></a>
                        <div id="submenu-1" class="collapse submenu {{ (request()->is('admin/categories')) || (request()->is('admin/posts')) ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('admin/categories')) ? 'active' : '' }}" href="{{url('admin/categories')}}">Category</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (request()->is('admin/posts')) ? 'active' : '' }}" href="{{url('admin/posts')}}">Posts</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
