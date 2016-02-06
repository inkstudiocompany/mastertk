<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Roles</title>
</head>

<body>

ABM de ROLES<br />
<form id="abm_rol" name="abm_rol" method="post" action="">
<table width="788" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Nombre Rol</td>
    <td>Descripcion</td>
    <td>Acciones</td>
  </tr>
  <tr>
    <td><?php $nombreRol; ?></td>
    <td><?php $descripcionRol; ?></td>
    <td nowrap="nowrap">...ver... ...edit... ...delete....</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<br />
<br />
Ver Rol<br />
<form id="ver_rol" name="ver_rol" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108">Nombre</td>
      <td width="649"><?php $nombreRol; ?></td>
    </tr>
    <tr>
      <td>Descripcion</td>
      <td><?php $descripcionRol; ?></td>
    </tr>
  </table>
</form>
 <br />
  <br />
Editar  Rol<br />
<form id="editar_rol" name="editar_rol" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108">Nombre</td>
      <td width="649"><input name="rol_nombreRol" type="text" id="rol_nombreRol" size="100" maxlength="255" value="<?php $nombreRol; ?>"/></td>
    </tr>
    <tr>
      <td>Descripcion</td>
      <td><input name="rol_descripcionRol" type="text" id="rol_descripcionRol" size="100" maxlength="255" value="<?php $descripcionRol; ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p> <br />
        <input type="submit" name="botonupdateRol" id="botonupdateRol" value="Update  Rol" />
      </p></td>
    </tr>
  </table>
</form>
<br />
<br />
Agregar Rol<br />
<form id="agregar_rol" name="agregar_rol" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td width="108">Nombre</td>
    <td width="649"><input name="agregar_nombreRol" type="text" id="agregar_nombreRol" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td>Descripcion</td>
    <td><input name="agregar_descripcionRol" type="text" id="agregar_descripcionRol" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>
      <br />
      <input type="submit" name="botonagregarRol" id="botonagregarRol" value="Agregar Rol" />
      </p></td>
  </tr>
</table>
</form>
<br />
<br />
Borrar  Rol<br />
<form id="borrar_rol" name="borrar_rol" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108">Nombre</td>
      <td width="649"><select name="nombreRol">
        <option value="0">Ninguno</option>
      </select>...  read nombreRol ....</td>
    </tr>
    <tr>
      <td>Descripcion</td>
      <td><?php $descripcionRol; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p> <br />
        <input type="submit" name="botoneliminarRol" id="botoneliminarRol" value="Eliminar Rol" />
      </p></td>
    </tr>
  </table>
</form>
</body>
</html>