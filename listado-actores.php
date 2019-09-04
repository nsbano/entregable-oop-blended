<?php

<?php
	require_once 'autoload.php';

	$movies = DB::getAllActors();

	$pageTitle = 'Listado de Actores';
	require_once 'partials/head.php';
	require_once 'partials/navbar.php';
?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<table class="table table-striped">
						<thead class="thead-dark">
			    			<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Apellido</th>
								<th scope="col">Pelicula</th>
							
			    			</tr>
			  			</thead>
			  			<tbody>
							<?php foreach ($actors as $actor): ?>
								<tr>
									<th scope="row"><?php echo $actor->getName(); ?></th>
									<td><?php echo $actor->getApellido(); ?></td>
									<td><?php echo $actor->getPelicula(); ?></td>

								</tr>
							<?php endforeach; ?>
			  			</tbody>
					</table>
				</div>
			</div>
		</div>

	</body>
</html>


 ?>
