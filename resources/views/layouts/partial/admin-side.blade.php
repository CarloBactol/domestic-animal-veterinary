<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.admin_dashboards.index') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item nav-category">Client Pages</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Client</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin_owners.index') }}">Owners</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.admin_animals.index') }}">Animals</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item nav-category">Staff Pages</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#veterinary" aria-expanded="false"
                aria-controls="veterinary">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Veterinary</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="veterinary">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.admin_veterinaries.index') }}">Records</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Services Pages</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#services" aria-expanded="false"
                aria-controls="services">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Services</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="services">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('admin.admin_services.index') }}">Records</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item nav-category">Branches</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">Location</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.admin_branchs.index') }}">Records
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">Settings</li>
        <li class="nav-item">
            <a class="nav-link" href="http://bootstrapdash.com/demo/star-admin2-free/docs/documentation.html">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>