<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Roles</title>
</head>

<body>

ABM de ROLES<br />
<table width="788" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Nombre Rol</td>
    <td>Descripcion</td>
    <td>Acciones</td>
  </tr>
  <tr>
    <td>.... red nombreRol</td>
    <td>... read descripcionRol</td>
    <td nowrap="nowrap">...ver... ...edit... ...delete....</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<br />
<br />
Ver Rol<br />
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108">Nombre</td>
      <td width="649"><input name="agregarRol2" type="text" id="agregarRol2" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>Descripcion</td>
      <td><input name="agregarDescripcionRol2" type="text" id="agregarDescripcionRol2" size="100" maxlength="255" /></td>
    </tr>
  </table>
  <p><br />
    <br />
  </p>
Editar  Rol<br />
<form id="form3" name="form1" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108">Nombre</td>
      <td width="649">...read nombreRol....</td>
    </tr>
    <tr>
      <td>Descripcion</td>
      <td>...read descripcionRol.... </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p> <br />
        <input type="submit" name="botonmodificarRol" id="botonmodificarRol" value="Update  Rol" />
      </p></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p></p>
<br />
Borrar  Rol<br />
<form id="form4" name="form1" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108">Nombre</td>
      <td width="649">....read nombreRol... </td>
    </tr>
    <tr>
      <td>Descripcion</td>
      <td>....read descripcionRol.... </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p> <br />
        <input type="submit" name="botoneliminarRol" id="botoneliminarRol" value="Eliminar Rol" />
      </p></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p></p>
<br />
<br />
Agregar Rol<br />

<form id="form1" name="form1" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td width="108">Nombre</td>
    <td width="649"><input name="agregarRol" type="text" id="agregarRol" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td>Descripcion</td>
    <td><input name="agregarDescripcionRol" type="text" id="agregarDescripcionRol" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>
      <br />
      <input type="submit" name="botonagregarRol" id="botonagregarRol" value="Agregar Rol" />
      </p></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>

<p><img src="images/addroles.png" width="954" height="300" /></p>
</body>
</html>