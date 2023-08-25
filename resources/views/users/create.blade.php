<x-app title="Crear Usuario">
	<section class="container my-5">
	<div class="card">
		<div class="card-header">
			<h2 class="h4">Crear Usuarios</h2>
		</div>
		<div class="card-body">
			<form action="{{route('users.store')}}" method="POST">
				@csrf
				<x-users.form :roles="$roles"/>
			</form>
		</div>
	</div>
</section>
</x-app>
