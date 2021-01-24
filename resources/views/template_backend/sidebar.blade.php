<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">IMEDIANET</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">IM</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a></li>
            </ul>
          </li>
          <li class="menu-header">ADMIN</li>

            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-server"></i><span>Produk</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('produk.index') }}">List Produk</a></li>
                <li><a class="nav-link" href="{{ route('merk.index') }}">List Merk</a></li>
                <li><a class="nav-link" href="{{ route('tipe.index') }}">List Tipe</a></li>
              </ul>
            </li>
            
            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-hdd"></i> <span>Hardware</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('hardware.index') }}">List Kategori </a></li>
                <li><a class="nav-link" href="{{ route('kapasitas.index') }}">List Kapasitas </a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-envelope" aria-hidden="true"></i><span>Pesan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('pesan-masuk.index') }}">List Pesan Masuk</a></li>
                <li><a class="nav-link" href="{{ route('pesan-terjawab.index') }}">List Pesan Terjawab</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Users</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('users.index') }}">List Users</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"> <i class="fa fa-shopping-cart"></i><span>Pesanan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('pesanan-admin.index') }}">List Pesanan</a></li>   
                <li><a class="nav-link" href="{{ route('pesanan-dirakit.index') }}">List Pesanan Dirakit</a></li>  
                <li><a class="nav-link" href="{{ route('pesanan-selesai.index') }}">List Pesanan Selesai</a></li>                        
              </ul>
            </li>

            <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"> <i class="fas fa-history"></i><span>History Pesanan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('history-pesanan.index') }}">List History Pesanan</a></li>   
              </ul>
            </li>
          
        </ul>


    </aside>
  </div>