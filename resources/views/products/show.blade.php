<x-app title="Productos">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Detalle del Producto</h1>
        </div>
         <product-detail :product="{{ $product }}" />
    </section>
</x-app>
