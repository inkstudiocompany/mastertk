<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Roles</title>
</head>

<body>

ABM de Usuarios<br />
<form id="abm_usuario" name="abm_usuario" method="post" action="">
<table width="788" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Nombre Usuario</td>
    <td>Roles Asignados</td>
    <td>Proyectos Asignados</td>
    <td>Acciones</td>
  </tr>
  <tr>
    <td nowrap="nowrap"><?php $nombreCompleto; ?></td>
    <td nowrap="nowrap"><?php $nombreRol; ?></td>
    <td nowrap="nowrap"><?php $nombreProyecto; ?></td>
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
Perfil de Usuario<br />
<form id="ver_usuario" name="ver_usuario" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre y Apellido</td>
      <td width="649"><?php $nombreCompleto; ?></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Tipo de Documento</td>
      <td><?php $nombreDocumento; ?></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Nro. de Documento</td>
      <td><?php $numDocumento; ?></td>
    </tr>
    <tr>
      <td>email</td>
      <td><?php $email; ?></td>
    </tr>
    <tr>
      <td>Usuario</td>
      <td><?php $usuario; ?></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><?php $password; ?></td>
    </tr>
    <tr>
      <td>Rol Asignado</td>
      <td><?php $nombreRol; ?></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Proyectos Asignados</td>
      <td><?php $nombreProyecto; ?></td>
    </tr>
  </table>
</form>
 <br />
  <br />
Editar Usuario<br />
<form id="editar_usuario" name="editar_usuario" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre y Apellido</td>
      <td width="649"><input name="usuario_nombreCompleto" type="text" id="usuario_nombreCompleto" size="100" maxlength="255" value="<?php $nombreCompleto; ?>"/></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Tipo de Documento</td>
      <td><input name="usuario_nombreDocumento" type="text" id="usuario_nombreDocumento" size="100" maxlength="255" value="<?php $nombreDocumento; ?>"/></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Nro. de Documento</td>
      <td><input name="usuario_numDocumento" type="text" id="usuario_numDocumento" size="100" maxlength="255" value="<?php $numDocumento; ?>"/></td>
    </tr>
    <tr>
      <td>email</td>
      <td><input name="usuario_email" type="text" id="usuario_email" size="100" maxlength="255" value="<?php $email; ?>"/></td>
    </tr>
    <tr>
      <td>Usuario</td>
      <td><input name="usuario_usuario" type="text" id="usuario_usuario" size="100" maxlength="255" value="<?php $usuario; ?>"/></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input name="usuario_password" type="text" id="usuario_password" size="100" maxlength="255" value="<?php $password; ?>"/></td>
    </tr>
    <tr>
      <td>Rol Asignado</td>
      <td><input name="rol_nombreRol" type="text" id="rol_nombreRol" size="100" maxlength="255" value="<?php $rol_nombreRol; ?>"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p> <br />
        <input type="submit" name="botonupdateUsuario" id="botonupdateUsuario" value="Update Usuario" />
      </p></td>
    </tr>
  </table>
</form>

  <br />
  <br />
Agregar Usuario  <br />
<form id="agregar_usuario" name="agregar_usuario" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre y Apellido</td>
      <td width="649"><input name="agregar_nombreCompleto" type="text" id="agregar_nombreCompleto" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Tipo de Documento</td>
      <td><select name="TipoDocumento">
        <option value="0">Ninguno</option>
      </select></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Nro. de Documento</td>
      <td><input name="agregar_numDocumento" type="text" id="agregar_numDocumento" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>email</td>
      <td><input name="agregar_email" type="text" id="agregar_email" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>Usuario</td>
      <td><input name="agregar_usuario" type="text" id="agregar_usuario" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input name="agregar_password" type="text" id="agregar_password" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>Rol Asignado</td>
      <td><select name="nombreRol">
        <option value="0">Ninguno</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p> <br />
        <input type="submit" name="botonagregarUsuario" id="botonagregarUsuario" value="Agregar Usuario" />
      </p></td>
    </tr>
  </table>
</form>
 <br />
  <br />
  Borrar Usuario
<form id="borrar_usuario" name="borrar_usuario" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre y Apellido</td>
      <td width="649"><select name="nombreCompleto">
        <option value="0">Ninguno</option>
      </select></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Tipo de Documento</td>
      <td><?php $nombreDocumento; ?></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Nro. de Documento</td>
      <td><?php $numeroDocumento; ?></td>
    </tr>
    <tr>
      <td>email</td>
      <td><?php $email; ?></td>
    </tr>
    <tr>
      <td>Usuario</td>
      <td><?php $usuario; ?></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><?php $password; ?></td>
    </tr>
    <tr>
      <td>Rol Asignado</td>
      <td><?php $nombreRol; ?></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Proyectos Asignados</td>
      <td><?php $nombreProyecto; ?></td>
    </tr>
    <tr>
      <td nowrap="nowrap">&nbsp;</td>
      <td><br />
      <input type="submit" name="botoneliminarUsuario" id="botoneliminarUsuario" value="Eliminar Usuario" /></td>
    </tr>
  </table>
</form>
</body>
</html>