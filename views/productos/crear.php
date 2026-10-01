<h1>Nuevo producto</h1>
<form method="post" action="index.php">
  <input type="hidden" name="accion" value="crear">
  <p><label>Nombre: <input type="text" name="nombre" maxlength="100" required></label></p>
  <p><label>Descripción:<br><textarea name="descripcion" rows="3" cols="40"></textarea></label></p>
  <p><label>Precio: <input type="number" name="precio" step="0.01" min="0" required></label></p>
  <p><label>Stock: <input type="number" name="stock" min="0" required></label></p>
  <button type="submit">Guardar</button>
  <a href="index.php">Cancelar</a>
</form>