<x-app title="{{ $category->name }} Products">

    <section class="my-3 d-flex justify-content-center">
        <h1>{{ $category->name }}</h1>
    </section>

    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($products as $product)
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
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $products->links() }} <!-- Agregar la paginación -->
    </div>

</x-app>

