<x-app title="Categorias">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Carrito de compras</h1>
        </div>

        <cart-view :products="{{ $products->toJson() }}"/>
    </section>
</x-app>
