<x-app title="Inicio">

    <section class="my-3 d-flex justify-content-center">
        {{-- <h1>Listado de productos</h1> --}}
    </section>

    @foreach ($categories as $category)
        @if ($category->products->count() >= 2)
            <section class="my-3">
                <h2 class="my-3 mx-5">
                    {{ $category->name }}
                    <a href="{{ route('products.category', ['category' => $category->id]) }}" class="btn btn-link btn-sm">Ver todos</a>
                </h2>
                <div class="d-flex flex-wrap justify-content-center">
                    @php
                        $productCount = 0; // Contador de productos
                    @endphp
                    @foreach ($category->products as $product)
                        @if ($productCount < 5 && $product->stock > 0) <!-- Limitar a 5 productos por categoría y verificar stock -->
                            <div class="card mx-2 my-3 card_size">
                                <a href="{{ route('products.show', ['product' => $product->id]) }}">
                                    <img src="{{ $product->file->route }}" class="card-img-top" alt="Portada Producto">
                                </a>
                                <div class="card-body">
                                    <strong class="card-title">{{ $product->name }}</strong>
                                    <h5 class="card-title">$ {{ $product->price }}</h5>
                                    <p class="card-text"> Disponible: {{ $product->stock }}</p>
                                    <p class="card-text">{{ $product->format_description }}</p>
                                </div>
                            </div>
                            @php
                                $productCount++; // Incrementar el contador de productos
                            @endphp
                        @endif
                    @endforeach
                </div>
            </section>
        @endif
    @endforeach
</x-app>
