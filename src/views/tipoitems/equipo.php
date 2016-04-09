<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Roles</title>
</head>

<body>

ABM de Equipos<br />
<form id="abm_equipo" name="abm_equipo" method="post" action="">
<table width="788" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Nombre Equipo</td>
    <td>Usuarios Asignados</td>
    <td>Proyecto Asignado</td>
    <td>Acciones</td>
  </tr>
  <tr>
    <td nowrap="nowrap"><?php $nombreEquipo; ?></td>
    <td nowrap="nowrap"><?php $idUsuario; ?></td>
    <td nowrap="nowrap"><?php $idProyecto; ?></td>
    <td nowrap="nowrap">...ver perfil ...  ...edit... ...delete....</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<br />
<br />
Detalle  del Equipo<br />
<form id="ver_equipo" name="ver_equipo" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre de Equipo</td>
      <td width="649"><?php $nombreEquipo; ?></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Proyecto Asignado</td>
      <td><?php $idProyecto; ?></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Usuarios Asignados</td>
      <td><?php $idUsuario; ?></td>
    </tr>
  </table>
</form>
 <br />
  <br />
Editar Equipo<br />
<form id="editar_equipo" name="editar_equipo" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre del Equipo</td>
      <td width="649"><input name="nombreEquipo" type="text" id="nombreEquipo" size="100" maxlength="255" value="<?php $nombreEquipo; ?>"/></td>
      <td width="649">&nbsp;</td>
    </tr>
    <tr>
      <td nowrap="nowrap">Proyecto Asignado</td>
      <td><input name="idProyecto" type="text" id="idProyecto" size="100" maxlength="255" value="<?php $idProyecto; ?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td nowrap="nowrap">Usuarios Asignados</td>
      <td><input name="idUsuario" type="text" id="idUsuario" size="100" maxlength="255" value="<?php $idUsuario; ?>"/></td>
      <td><input type="submit" name="botonadeleteUsuario" id="botondeleteUsuario" value="Eliminar Usuario" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p> 
        <input type="submit" name="botonaddUsuario" id="botonaddUsuario" value="Agregar Usuario" />
      </p>
        <p>          <br />
          <input type="submit" name="botonupdateEquipo" id="botonupdateEquipo" value="Update Equipo" />
      </p></td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>

  <br />
  <br />
  Borrar Equipo
  <form id="borrar_equipo" name="borrar_equipo" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre del Equipo</td>
      <td width="649"><select name="nombreEquipo">
        <option value="0">Ninguno</option>
      </select></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Proyecto Asignado</td>
      <td><input name="idProyecto" type="text" id="idProyecto" size="100" maxlength="255" value="<?php $idProyecto; ?>"/></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Usuarios Asignados</td>
      <td><input name="idUsuario" type="text" id="idUsuario" size="100" maxlength="255" value="<?php $idUsuario; ?>"/></td>
    </tr>
    <tr>
      <td nowrap="nowrap">&nbsp;</td>
      <td><br />
      <input type="submit" name="botoneliminarEquipo" id="botoneliminarEquipo" value="Eliminar Equipo" /></td>
    </tr>
  </table>
</form>
</body>
</html>