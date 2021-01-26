<div class="logo">

    <img src="{{ asset('assets/img/logo.png')}}" alt="logo" title="logo" height="80">

</div>

<nav style="background-color: #475d2c" class="navbar navbar-expand-lg navbar-light " >
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav text-center" >
        <li class="nav-item">
        <a class="nav-link" style="color: white" href="{{ route('beranda.index')}}" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'"> <b>BERANDA</b> </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" style="color: white" href="{{ route('produk-kami.index')}}" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'"> <b>PRODUK</b></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" style="color: white" href="{{ route('layanan.index')}}" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'"> <b>LAYANAN</b> </a>
        </li>
    </ul>

        <div class="float-right">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown" >
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                                style="color: white; padding-right:50px; padding-top:1px;" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->isAdmin())
                                        <a class="dropdown-item" href="{{route('history.index')}}"  onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" >  <i class="fas fa-history"></i> Histori </a>
                                        <a class="dropdown-item" href="{{ url('check-out')}}"  onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" >  <i class="fa fa-shopping-cart"></i> Keranjang</a>
                                        <a class="dropdown-item" href="{{route('admin.index')}}"  onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" > <i class="fa fa-user"></i> Admin</a>
                                    @endif

                                    @if(Auth::user()->admin == 0)
                                        <a class="dropdown-item" href="{{route('history.index')}}" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" >  <i class="fas fa-history"></i> Histori </a>
                                        <a class="dropdown-item" href="{{ url('check-out')}}"  onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'"  >  <i class="fa fa-shopping-cart"></i> Keranjang </a>
                                        <a class="dropdown-item" href="{{route('setting-user.setting')}}"  onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" ><i class="fas fa-cog"></i> Setting Profile</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"  onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" 
                                    onclick="event.preventDefault(); 
                                                    document.getElementById('logout-form').submit();">
                                      <i class="fas fa-sign-out-alt"></i>  {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            {{-- <a href="{{ url('/home') }}" style="color: white" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'">
                                <i class="fas fa-home"></i> Home
                            </a> --}}
                        </ul>
                    </div>
                    @else
                        <a href="{{ route('login') }}" style="padding-right: 5px; color: white" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'" >
                            <i class="fas fa-sign-in-alt "></i> Login
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" style="color: white" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'"> 
                                <i class="fas fa-user"></i> Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
</nav>