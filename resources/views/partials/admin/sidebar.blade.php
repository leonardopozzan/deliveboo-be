<div id="sidebar" class="side-bar">
    <i id="close" class="fa-solid fa-xmark"></i>
    <ul>
        <li class="title"><a href="{{ url('admin') }}"><img src="/dish-drp-bw-01.png" alt="logo dishdrop"></a></li>
        @if (Auth::user()->restaurant)
            <li><a href="{{ route('admin.dishes.index') }}"><i class="fa-solid fa-atom"></i>
                    <div>Tutti i Piatti</div>
                </a></li>
            <li><a href="{{ route('admin.orders.index') }}"><i class="fa-solid fa-diagram-project"></i>
                    <div>Tutti gli Ordini</div>
                </a></li>
        @endif
        {{-- <li><a href="{{route('admin.types.index')}}"><i class="fa-solid fa-store"></i><div>Tutti i Tipi</div></a></li> --}}
        {{-- <li><a href="{{route('admin.categories.index')}}"><i class="fa-solid fa-diagram-project"></i><div>Tutte le Categorie</div></a></li> --}}
        {{-- <li><a href="{{route('admin.tags.index')}}"><i class="fa-solid fa-tag"></i><div>Tutti i Tags</div></a></li> --}}
        {{-- <li><a href="{{route('admin.additions.index')}}"><i class="fa-brands fa-shopify"></i><div>Tutte le aggiunte</div></a></li> --}}
    </ul>
</div>
