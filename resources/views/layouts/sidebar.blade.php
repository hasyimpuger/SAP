<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::to('photo/admin/avatar5.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->username }}</p>
                <a href="#">
                <i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            @if(Auth::user()->level == 'admin')
            <li>
                <a href="{{ route('home.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->level == 'admin' || Auth::user()->level == 'gudang')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span>Gudang</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('barang.index') }}">
                            <i class="fa fa-cubes"></i>
                            <span>Stok Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('getStokBarang') }}">
                            <i class="fa fa-cube"></i>
                            <span>Barang yang akan habis</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('getHistory')}}">
                            <i class="fa fa-history"></i>
                            <span>History Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('distributor.index') }}">
                            <i class="fa fa-truck"></i>
                            <span>Distributor</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kategori.index') }}">
                            <i class="fa fa-list"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->level == 'kasir' || Auth::user()->level == 'admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Penjualan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('transaksi.index') }}">
                            <i class="fa fa-handshake-o"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('getKeuangan') }}">
                    <i class="fa fa-money"></i>
                    <span>Keuangan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan') }}">
                    <i class="fa fa-users"></i>
                    <span>Pelanggan</span>
                </a>
            </li>
            @endif
            @if(Auth::user()->level == 'admin')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Setting Admin</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('setting.index') }}">
                            <i class="fa fa-home"></i>
                            <span>Toko</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('akun.index') }}">
                            <i class="fa fa-users"></i>
                            <span>Akun</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('getEcpos') }}">
                            <i class="fa fa-print"></i>
                            <span>Setting Ecpos</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>