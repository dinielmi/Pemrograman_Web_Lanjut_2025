<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
        <a href="{{ url('/dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>Dashboard</p>
        </a>
      </li>

      <li class="nav-header">Data Pengguna</li>
      <li class="nav-item">
        <a href="{{ url('/level') }}" class="nav-link {{ Request::is('level*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-users-cog"></i>
          <p>Level User</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/user') }}" class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-user"></i>
          <p>Data User</p>
        </a>
      </li>

      <li class="nav-header">Data Barang</li>
      <li class="nav-item">
        <a href="{{ url('/kategori') }}" class="nav-link {{ Request::is('kategori*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-boxes"></i>
          <p>Kategori Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/supplier') }}" class="nav-link {{ Request::is('supplier*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-truck"></i>
          <p>Data Supplier</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/barang') }}" class="nav-link {{ Request::is('barang*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-box"></i>
          <p>Data Barang</p>
        </a>
      </li>

      <li class="nav-header">Data Transaksi</li>
      <li class="nav-item">
        <a href="{{ url('/stok') }}" class="nav-link {{ Request::is('stok*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-cubes"></i>
          <p>Stok Barang</p>
        </a>
      </li>

      @php
        $isPenjualan = Request::is('penjualan') || Request::is('penjualan_detail');
      @endphp
      <li class="nav-item has-treeview {{ $isPenjualan ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ $isPenjualan ? 'active' : '' }}">
          <i class="nav-icon fas fa-cash-register"></i>
          <p>
            Transaksi Penjualan
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ url('/penjualan') }}" class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Penjualan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/penjualan_detail') }}" class="nav-link {{ Request::is('penjualan_detail') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Penjualan Detail</p>
            </a>
          </li>
        </ul>
      </li>

    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
