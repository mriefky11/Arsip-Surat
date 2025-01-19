<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <img src="/img/logo.png" alt="" width="50" height="50">
        </div>
        <div class="sidebar-brand-text mt-3 mx-3"><sup>INFOLAHTA KODAM III/SLW</sup></div>
    </a>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Akun
    </div>
    @if (Auth::user()->role === 'admin')
        <!-- kelola akun -->
        <li class="nav-item {{ Request::is('dashboard/kelola_akun*') ? 'active' : '' }}">
            <a class="nav-link " href="/dashboard/kelola_akun">
                <i class="fas fa-user fa-table"></i>
                <span>Kelola Akun</span></a>
        </li>
    @endif
    @if (Auth::user()->role === 'user')
    <!-- kelola akun -->
    <li class="nav-item {{ Request::is('dashboard/daftar_pengguna*') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/daftar_pengguna">
            <i class="fas fa-users fa-table"></i>
            <span>Daftar Pengguna</span></a>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Surat
    </div>

    <!-- buat surat -->
    {{-- <li class="nav-item">
        <a class="nav-link " href="kirim_surat">
            <i class="fas fa-paper-plane"></i>
            <span>Kirim Surat</span></a>
    </li> --}}

    {{-- surat keluar --}}
    <li class="nav-item {{ Request::is('dashboard/surat_keluar*') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/surat_keluar">
            {{-- <i class="fas fa-envelope"></i> --}}
            <i class="fas fa-paper-plane"></i>
            <span>Surat Keluar</span></a>

    <li class="nav-item {{ Request::is('dashboard/surat_masuk*') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/surat_masuk">
            <i class="fas fa-envelope"></i>
            <span>Surat Masuk</span></a>
    </li>
    <li class="nav-item {{ Request::is('dashboard/disposisi*') ? 'active' : '' }}">
        <a class="nav-link " href="/dashboard/disposisi">
            <i class="fas fa-reply"></i>
            <span>Disposisi Surat</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
