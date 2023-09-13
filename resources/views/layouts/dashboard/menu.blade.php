<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu mt-5">
            <div class="nav">
                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('admin.home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link {{ request()->is('pembelian') || request()->is('pembelian/create') ? 'active' : '' }}"
                    href="{{ route('admin.pembelian') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-sort-numeric-down"></i></div>
                    Pembelian
                </a>
                <a class="nav-link {{ request()->is('menu-category') ? 'active' : '' }}"
                    href="{{ route('admin.menu.category') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                    Menu Category
                </a>
                <a class="nav-link {{ request()->is('menu') || request()->is('menu/new') ? 'active' : '' }}"
                    href="{{ route('admin.menu') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-utensils"></i></div>
                    Menu
                </a>
                <a class="nav-link {{ request()->is('guest') ? 'active' : '' }}" href="{{ route('admin.guest') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Guest List
                </a>
                <a class="nav-link {{ request()->is('order') ? 'active' : '' }}" href="{{ route('admin.order') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Orders
                </a>
                <a class="nav-link collapsed {{ request()->is('transaction') ? 'active' : '' }}" href="#"
                    data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false"
                    aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-right-left"></i></div>
                    Transaksi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.payments') }}">Pembayaran</a>
                        <a class="nav-link" href="{{ route('admin.transactions') }}">Transaksi Keluar</a>
                        <a class="nav-link" href="{{ route('admin.return') }}">Return</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth()->user()->name }}
        </div>
    </nav>
</div>
