<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admindashboard')}}" class="brand-link">
        <img src="{{ asset('dashboard/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dashboard/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admindashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Ensure only Superadmin and Admin see these sections -->
                @if (auth()->user()->role->name == 'superadmin' || auth()->user()->role->name == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('adminmajors.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>Majors</p>
                        </a>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link" id="doctors-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>
                                Doctors
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" id="doctors-list" style="display: none;">
                            @foreach ($majors_nav as $major)
                                <li class="nav-item">
                                    <a href="{{ route('admindoctors.index', ['major_id' => $major->id]) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $major->title }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>


                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link" id="appointments-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Appointments
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" id="majors-list" style="display: none;">
                            @foreach ($majors_nav as $major)
                                <li class="nav-item">
                                    <a href="{{ route('adminappointments.index', ['major_id' => $major->id]) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $major->title }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link" id="books-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Books
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" id="books-list" style="display: none;">
                            @foreach ($majors_nav as $major)
                                <li class="nav-item">
                                    <a href="{{ route('adminbooks.index', ['major_id' => $major->id]) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $major->title }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link" id="roles-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" id="roles-list" style="display: none;">
                            @foreach ($roles_nav as $role)
                                <li class="nav-item">
                                    <a href="{{ route('adminusers.index', ['role_id' => $role->id]) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $role->name }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('admincontact.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>Contact</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('adminsliders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>Sliders</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admininfo.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>Info</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('adminabout.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>About</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admindownload.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-download"></i>
                            <p>Download</p>
                        </a>
                    </li>
                    @endif

                    @if (Auth::check() && Auth::user()->role->name === 'doctor')
                    @php
                        $doctor = \App\Models\Doctor::where('user_id', Auth::user()->id)->first();
                    @endphp
                    @if ($doctor)
                        <li class="nav-item">
                            <a href="{{ route('admindoctor-profile.show', ['user' => Auth::user()->id]) }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admindoctor-information.show', ['doctor' => $doctor->id]) }}" class="nav-link">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>Doctor Information</p>
                            </a>
                        </li>

                        <!-- Doctor Books Section -->
                        <li class="nav-item">
                            <a href="{{ route('admindoctor-books.index', ['user_id' => $doctor->id]) }}" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Doctor Books</p>
                            </a>
                        </li>

                        <!-- Doctor Appointments Section -->
                        <li class="nav-item">
                            <a href="{{ route('admindoctor-appointment.index', ['doctor_id' => $doctor->id]) }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>Doctor Appointments</p>
                            </a>
                        </li>
                    @endif
                @endif


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
