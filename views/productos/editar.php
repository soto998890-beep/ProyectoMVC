<h1>Editar producto</h1>
<form method="post" action="index.php">
  <input type="hidden" name="accion" value="editar">
  <input type="hidden" name="id" value="<?= $producto['id']; ?>">
  <p><label>Nombre: <input type="text" name="nombre" maxlength="100" value="<?= htmlspecialchars($producto['nombre']); ?>" required></label></p>
  <p><label>Descripción:<br><textarea name="descripcion" rows="3" cols="40"><?= htmlspecialchars($producto['descripcion']); ?></textarea></label></p>
  <p><label>Precio: <input type="number" name="precio" step="0.01" min="0" value="<?= $producto['precio']; ?>" required></label></p>
  <p><label>Stock: <input type="number" name="stock" min="0" value="<?= $producto['stock']; ?>" required></label></p>
  <button type="submit">Actualizar</button>
  <a href="index.php">Cancelar</a>
</form>