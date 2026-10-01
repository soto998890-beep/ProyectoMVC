<h1>Gestión de Productos</h1>
<?php if (!empty($mensaje)): ?>
<p><strong><?= htmlspecialchars($mensaje); ?></strong></p>
<?php endif; ?>
<p>
  <a href="index.php?vista=crear">Nuevo producto</a> |
  <a href="../reportes/excel.php">Exportar Excel</a> |
  <a href="../reportes/pdf.php">Exportar PDF</a>
</p>
<table border="1">
<tr>
  <th>ID</th>
  <th>Nombre</th>
  <th>Precio</th>
  <th>Stock</th>
  <th>Acciones</th>
</tr>
<?php while($row = $productos->fetch(PDO::FETCH_ASSOC)): ?>
<tr>
  <td><?= $row['id']; ?></td>
  <td><?= htmlspecialchars($row['nombre']); ?></td>
  <td><?= $row['precio']; ?></td>
  <td><?= $row['stock']; ?></td>
  <td>
    <a href="index.php?vista=editar&id=<?= $row['id']; ?>">Editar</a>
    <form method="post" action="index.php" style="display:inline" onsubmit="return confirm('¿Eliminar este producto?');">
      <input type="hidden" name="accion" value="eliminar">
      <input type="hidden" name="id" value="<?= $row['id']; ?>">
      <button type="submit">Eliminar</button>
    </form>
  </td>
</tr>
<?php endwhile; ?>
</table>