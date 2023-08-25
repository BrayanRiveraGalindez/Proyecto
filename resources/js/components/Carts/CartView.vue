<template>
	<div class="cart">
	  <div class="d-flex justify-content-between mb-3">
		<button class="btn btn-outline-warning" @click="confirmarVaciarCarrito">Vaciar Carrito</button>
	  </div>
	  <table class="table">
		<thead>
		  <tr>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Acciones</th>
		  </tr>
		</thead>
		<tbody>
		  <tr v-for="(product, index) in cartProducts" :key="index">
			<td>{{ product.nombre }}</td>
			<td>${{ product.precio }}</td>
			<td>
				<input type="number" v-model.number="product.cantidad" min="1" @change="actualizarCantidad(index, product.cantidad)" />
			</td>
			<td>
			  <button class="btn btn-outline-danger" @click="confirmarEliminar(index)">Eliminar</button>
			</td>
		  </tr>
		</tbody>
	  </table>
	  <div class="card" style="width: 15rem;">
		<div class="card-body">
		  <h5 class="card-title">Total Compra</h5>
		  <p class="card-text">$ {{ calcularTotal }}</p>
		</div>
	  </div>
	</div>
  </template>

  <script>
export default {
	computed: {
		cartProducts() {
			return JSON.parse(localStorage.getItem('carrito')) || []
		},

		calcularTotal() {
			return this.cartProducts.reduce(
				(total, product) => total + product.precio * product.cantidad,
				0
			)
		}
	},

	methods: {
		confirmarVaciarCarrito() {
			const confirmacion = window.confirm('¿Estás seguro de que deseas vaciar el carrito?')

			if (confirmacion) {
				this.vaciarCarrito()
			}
		},
		confirmarEliminar(index) {
			const confirmacion = window.confirm(
				'¿Estás seguro de que deseas eliminar este producto del carrito?'
			)

			if (confirmacion) {
				this.eliminarDelCarrito(index)
			}
		},
		eliminarDelCarrito(index) {
			const carrito = JSON.parse(localStorage.getItem('carrito')) || []
			carrito.splice(index, 1)
			localStorage.setItem('carrito', JSON.stringify(carrito))
			window.location.reload()
		},

		actualizarCantidad(index, nuevaCantidad) {
			const carrito = JSON.parse(localStorage.getItem('carrito')) || []
			carrito[index].cantidad = nuevaCantidad
			localStorage.setItem('carrito', JSON.stringify(carrito))
			window.location.reload()
		},

		vaciarCarrito() {
			localStorage.removeItem('carrito')
			window.location.reload()
		}
	}
}
</script>
