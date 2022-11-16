@php
    $categories = App\Models\Category::where('parent_id', 0)->orWhere('parent_id', NULL)->get(['name', 'slug', 'image']);
@endphp

<header class="bg-dark text-white py-2">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6">
                <ul class="list-inline mb-0">
                    
                </ul>
            </div>
        </div>
    </div>
</header>

<nav class="pt-4 pb-4">
    <div class="container navbar-desktop">
        <div class="row justify-content-between align-items-center">
            <div class="col-5">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item btn btn-link"><a href="{{ route('index') }}">Inicio</a></li>

                    <div class="dropdown list-inline-item">
                      <button class="btn btn-link dropdown-toggle" type="button" id="dropdownCatalog" data-bs-toggle="dropdown" aria-expanded="false">Catálogo</button>

                        <ul class="dropdown-menu justify-content-between list-group-flush" aria-labelledby="dropdownCatalog">
                            <li class="list-group-item"><a href="{{ route('catalog.all') }}">Ver todos</a></li>
                            @foreach($categories as $category)
                                <li class="list-group-item"><a href="{{ route('catalog', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>

                        <li class="list-inline-item btn btn-link"><a href="{{ route('catalog.promo') }}">Promociones</a></li>
                    </div>
                </ul>
            </div>

            <div class="col-2">
                <a href="{{ route('index') }}">
                    @if(!empty($store_config))
                        @if($store_config->store_logo == NULL)
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" width="200">
                        @else
                        <img src="{{ asset('assets/img/' . $store_config->store_logo) }}" alt="Logo" class="img-fluid" width="200">
                        @endif
                    @else
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" width="200">
                    @endif
                </a>    
            </div>

            <div class="col-5 text-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <form role="search" action="{{ route('search.query') }}" class="catalog-search ">
                            <div class="input-group input-group-search d-flex align-items-center">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn" type="button" id="button-search">
                                        <ion-icon name="search-outline"></ion-icon>
                                    </button>
                                </div>
                                <input type="search" class="form-control" name="query" placeholder="Encuentra tu favorito"
                                    aria-describedby="button-search" style="width: 190px">
                            </div>
                        </form>
                    </li>

                    @guest
                    <li class="list-inline-item"><a href="{{ route('login') }}" class="btn btn-link px-1"><ion-icon name="person"></ion-icon></a></li>
                    <li class="list-inline-item">
                        <a href="{{ route('login') }}" class="btn btn-link px-1">
                            <ion-icon name="heart"></ion-icon>
                            <span class="badge bg-info">0</span>
                        </a>
                    </li>
                    @else
                    <li class="list-inline-item"><a href="{{ route('profile') }}" class="btn btn-link px-1"><ion-icon name="person"></ion-icon></a></li>
                    <li class="list-inline-item">
                        <a href="{{ route('wishlist') }}" class="btn btn-link px-1">
                            <ion-icon name="heart"></ion-icon>
                            <span class="badge bg-info">{{ Auth::user()->wishlists->count() ?? '0'}}</span>
                        </a>
                    </li>
                    @endguest

                    @if(request()->is('checkout'))

                    @else
                    <div class="dropdown" style="display: inline-flex;">
                        <a class="btn btn-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <ion-icon name="bag"></ion-icon>
                            <span class="badge bg-danger">{{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }}</span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width: 20rem; padding: 10px;">
                            @if(Session::has('cart'))
                                @include('front.layouts.utilities._cart_item')
                            @else
                                <p class="mb-0 d-flex align-items-center">
                                    No hay productos en tu carrito.
                                </p>
                            @endif
                        </ul>
                    </div>
                    @endif
                </ul>       
            </div>
        </div>
    </div>

    <div class="container navbar-responsive">
        <div class="d-flex justify-content-between align-items-center">
           <button class="btn btn-secondary" class="nav-mobile-icon" onclick="toggleMenu()">
                <ion-icon name="menu-outline"></ion-icon>
            </button>

            <a class="logo" href="{{ route('index') }}">
                @if(!empty($store_config))
                    @if($store_config->store_logo == NULL)
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" width="200">
                    @else
                    <img src="{{ asset('assets/img/' . $store_config->store_logo) }}" alt="Logo" class="img-fluid" width="200">
                    @endif
                @else
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" width="200">
                @endif
            </a>   

            <div class="text-end">
                <ul class="list-inline mb-0">
                    @if(request()->is('checkout'))

                    @else
                    <div class="dropdown" style="display: inline-flex;">
                      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        <ion-icon name="bag"></ion-icon>
                        <span>{{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }}</span>
                      </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="min-width: 20rem; padding: 10px;">
                            @if(Session::has('cart'))
                                @include('front.utilities._cart_item')
                            @endif
                        </ul>
                    </div>

                    @endif
                </ul>       
            </div>
        </div>
    </div>
<!-- Sidebar Responsive -->
<div class="sidebar-overlay"></div>
<div id="sidebar-wrapper">
    <!-- store -->
    <div class="sidebar-menu">
        <ul>
            <li class="title closed-menu">
                <a>
                    <span>Cerrar</span>
                    <ion-icon name="close-outline"></ion-icon>
                </a>
            </li>
            @php
                $categories = App\Models\Category::where('parent_id', 0)->orWhere('parent_id', NULL)->get();
            @endphp
            @foreach($categories as $category)
                @if($category->children->count() == 0)
                    <li>
                        <a href="{{ route('catalog', $category->slug) }}">{{ $category->name }}</a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('catalog', $category->slug) }}" data-toggle="collapse" data-target="#{{ $category->id }}" aria-expanded="false" aria-controls="{{ $category->id }}">
                            {{ $category->name }} 
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </a>
                    </li>
                    <div class="collapse collapse-item" id="{{ $category->id }}" data-parent="#accordion">
                        <!-- items -->
                        <div class="sidebar-content">
                            <!-- title -->
                            <li class="title">
                                <a data-toggle="collapse" data-target="#{{ $category->id }}" aria-expanded="false" aria-controls="{{ $category->id }}">
                                    <ion-icon name="chevron-back-outline"></ion-icon>
                                    {{ $category->name }} 
                                </a>
                            </li>
                            @foreach($category->children as $sub)
                                <li>
                                    <a href="{{ route('catalog', $sub->slug) }}">{{ $sub->name }}</a>
                                </li>
                            @endforeach  
                            <li>
                                <a href="{{ route('catalog', $category->slug) }}">Ver todo</a>
                            </li>
                        </div>

                        <!-- image -->
                        <div class="sidebar-image">
                            @if($category->image == NULL)
                                <img src="{{ asset('themes/arenas/img/front/categories/no-category.jpg') }}" alt="{{ $category->name }}" style="width: 100%; height:100%; object-fit:cover">
                            @else
                                <img src="{{ asset('img/categories/' . $category->image) }}" alt="" style="width: 100%; height:100%; object-fit:cover">
                            @endif
                        </div>
                    </div> 
                @endif
            @endforeach
            <hr>
        </ul>
    </div>
    
    <!-- user -->
    <div class="sidebar-user">
        @guest
            <a href="{{ route('login') }}" class="item closed-menu" data-toggle="modal" data-target="#modal-access"><ion-icon name="person-outline"></ion-icon>Login</a>
            <a href="{{ route('catalog.all') }}" class="item"><ion-icon name="storefront-outline"></ion-icon> Catálogo</a>
        @else
            <a href="{{ route('profile') }}" class="item"><ion-icon name="person-outline"></ion-icon> Mi Cuenta</a>
            <a href="{{ route('wishlist') }}" class="item"><ion-icon name="heart-outline"></ion-icon> Wishlist</a>
            <a href="" class="item">
                <ion-icon name="log-out-outline" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></ion-icon> Salir
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </a>
        @endguest
    </div>
</div>

</nav>

@push('scripts')
<script type="text/javascript">
    $("#menu-mobile").on("click", function () {
      toggleMenu();
    });

    $(".sidebar-overlay").on("click", function () {
      $("body").removeClass("toggled");
      $(".clonado").remove();
    });

    $(".closed-menu").on("click", function () {
      $("body").removeClass("toggled");
      $(".clonado").remove();
    });

    $(".close-btn").on("click", function () {
      $("body").removeClass("toggled");
      $(".clonado").remove();
    });

    $(".close-sidebar").on("click", function () {
      $("body").removeClass("toggled");
      $(".clonado").remove();
    });
    
    function toggleMenu() {
      $("body").addClass("toggled");
    }
</script>
<script>
$(function () {
    $('.openSearch').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });
    
    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });

    $(window).ready(function() {
      $("#search > form").on("keypress", function (event) {
          var keyPressed = event.keyCode || event.which;

          if (keyPressed === 13) {
              return false;
          }
      });
    });
});
</script>
@endpush