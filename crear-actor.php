<?php

require_once 'autoload.php';

if ($_POST) {
  $actorToSave = new Actor($_POST['name'], $_POST['apellido'], $_POST['pelicula']);

  $saved = DB::saveActor($actorToSave);
}

$pageTitle = 'Crear Actor';
$peliculas = DB::getAllMovies();
require_once 'partials/head.php';
require_once 'partials/navbar.php';
?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-10">
        <h2>Crear película</h2>
        <form method="post">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Nombre:</label>
                <input type="text" class="form-control" placeholder="Ej: Benedict" name="name">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Apellido:</label>
                <input type="text" class="form-control" placeholder="Ej: Cumberbatch " name="Apellido">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>Pelicula:</label>
                <select name="pelicula">
                    <?php foreach($peliculas as $pelicula) : ?>
                        <option value=<?php echo $pelicula->getId() ?>><?php echo $pelicula->getTitle() ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary">GUARDAR</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php if (isset($saved)): ?>
      <div
        class="alert <?php echo $saved ? 'alert-success' : 'alert-danger'?>"
      >
        <?php echo $saved ? '¡Género guardado con éxito!' : '¡No se pudo guardar el actor!' ?>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>





 ?>
