<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header_nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://www.wrsos.org" target="_blank">WRSOS</a>
        </div>

        <div class="collapse navbar-collapse" id="header_nav">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('home') }}"><i class="fa fa-home fa-lg"></i> Home</a></li>
                @guest
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" ><i class="fa fa-address-book fa-lg"></i> Contacts<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('volunteer.index') }}">Volunteers</a></li>
                            <li><a href="{{ route('administrative.index') }}">Administrative</a></li>
                            <li><a href="{{ route('veterinarian.index') }}">Veterinarians</a></li>
                            <li><a href="{{ route('rehabilitator.index') }}">Rehabilitators</a></li>
                            <li><a href="{{ route('other.index') }}">Other</a></li>
							<li><a href="https://drive.google.com/open?id=1RdT44kzEfSxOoe0ujNj3-Z5F6LGsJkSf" target="_blank">Contact Map</a></li>
                        </ul>
                    </li>
                   
                    <li><a href="{{ route('call_log.index') }}"><i class="fas fa-desktop fa-lg"></i> Hotline Dashboard</a></li>

                @endguest
             </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="https://www.facebook.com/groups/1311048162261503/" target="_blank">
                        <i class="fab fa-facebook fa-lg" ></i>
                    </a>
                </li>
                <li>
                    <a href="http://www.pinterest.com/wrsos" target="_blank">
                        <i class="fab fa-pinterest fa-lg" aria-hidden="true" ></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/wrsosaskatchewan/" target="_blank">
                        <i class="fab fa-instagram fa-lg" aria-hidden="true" ></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.msging.sasktel.net" target="_blank">
                        <i class="fas fa-phone fa-lg" ></i> SaskTel
                    </a>
                </li>

                @guest
                    <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->user_name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile.edit', ['user_id' => Auth::user()->id]) }}"><i class="fa fa-paw " ></i> MyWRSOS</a></li>
                            
                            @if (Auth::user()->isMembership)
                                <li><a href="{{ route('membership.index') }}"><i class="fas fa-handshake"></i> Membership Portal</a></li>                          
                            @endif
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
