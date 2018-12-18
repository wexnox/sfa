<nav class="navbar navbar-expand-md navbar-expand-lg navbar-light bg-light">

    <div class="container">

        <div class="col-sm-6">
            <a class="navbar-brand" href="{{ url('/') }}" tabindex="20" title="Tilbake.">
                <img class="logo img-responsiv" src="{{ asset('images/CompanyName.png') }}" alt="Tilbake.">
            </a>
        </div>

        <form action="{{ route('search') }}" method="POST" role="search" class="form-inline">
            {{ csrf_field() }}
            <input type="search" class="form-control mr-sm-1" name="q" placeholder="Produkt søk ... " aria-label="Produkt søk ...">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-outline-success my-2 my-sm-0"><i class="icon icon-search4"></i></button>
            </span>
        </form>

    </div>

</nav>

<nav class="navbar navbar-expand-md navbar-expand-lg navbar-light bg-light tekst">

    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mobile">
            <ul class="navbar-nav mr-auto">
 
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Forside</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-list"></i> Alle produkter</a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($categoryList as $list)
                            <a class="dropdown-item text-uppercase" href="{{ url('category', $list->id) }}">{{ $list->name }}</a>
                        @endforeach
                    </div>

                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Våre beste kupp!</a>
                </li>

            </ul>
        </div>

        <div class="pull-right">
            <div class="collapse navbar-collapse" id="mobile">

                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shopping-cart') }}"><i
                                class="icon icon-cart mr-2"></i> Handlekurv <span
                                class="badge"> {{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        @guest
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon icon-user mr-1"></i> Brukerkonto
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('login') }}">
                                    <i class="icon icon-key mr-2"></i> {{ __('Logg inn') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('register') }}">
                                    <i class="icon icon-user mr-2"></i> {{ __('Register') }}
                                </a>

                            </div>
                        @endguest
                    </li>

                    <li class="nav-item dropdown">

                        @auth
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('profile', Auth()->user()->id) }}">
                                    <i class="fas fa-user-circle"></i> Bruker konto
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @endauth
                    </li>

                </ul>
            </div>
        </div>

    </div>

</nav>
