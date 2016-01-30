<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Roles</title>
</head>

<body>

ABM de Usuarios<br />
<table width="788" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Nombre Usuario</td>
    <td>Roles Asignados</td>
    <td>Proyectos Asignados</td>
    <td>Acciones</td>
  </tr>
  <tr>
    <td nowrap="nowrap">.... red nombreCompleto .....</td>
    <td nowrap="nowrap">... read nombreRol ......</td>
    <td nowrap="nowrap">.... read nomProyecto ...</td>
    <td nowrap="nowrap">...ver perfil ...  ...edit... ...delete....</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
<br />
Perfil de Usuario<br />
<form id="form2" name="form1" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre y Apellido</td>
      <td width="649">... read nombreCompleto....</td>
    </tr>
    <tr>
      <td nowrap="nowrap">Tipo de Documento</td>
      <td>... read TipoDocumento....</td>
    </tr>
    <tr>
      <td nowrap="nowrap">Nro. de Documento</td>
      <td>... read numDocumento....</td>
    </tr>
    <tr>
      <td>email</td>
      <td>... read email....</td>
    </tr>
    <tr>
      <td>Usuario</td>
      <td>... read usuario....</td>
    </tr>
    <tr>
      <td>Password</td>
      <td>... read password....</td>
    </tr>
    <tr>
      <td>Rol Asignado</td>
      <td>... read idRolPrincipal ...</td>
    </tr>
    <tr>
      <td nowrap="nowrap">Proyectos Asignados</td>
      <td>... read idUsuarioRolEquipo.... ....nomProyecto.... </td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<p></p>
Editar Usuario<br />
<form id="form3" name="form1" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre y Apellido</td>
      <td width="649"><input name="nombreCompleto2" type="text" id="nombreCompleto2" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Tipo de Documento</td>
      <td><input name="nombreDocumento" type="text" id="nombreDocumento" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Nro. de Documento</td>
      <td><input name="numDocumento" type="text" id="numDocumento" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>email</td>
      <td><input name="email" type="text" id="email" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>Usuario</td>
      <td><input name="usuario" type="text" id="usuario" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input name="password" type="text" id="password" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>Rol Asignado</td>
      <td><input name="idRolPrincipal" type="text" id="idRolPrincipal" size="100" maxlength="255" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><p> <br />
        <input type="submit" name="botonupdateUsuario" id="botonupdateUsuario" value="Update Usuario" />
      </p></td>
    </tr>
  </table>
  <p></p>
</form>
<br />
<br />
<br />
Borrar Usuario<br />
<form id="form4" name="form1" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre y Apellido</td>
      <td width="649">... read nombreCompleto....</td>
    </tr>
    <tr>
      <td nowrap="nowrap">Tipo de Documento</td>
      <td>... read TipoDocumento....</td>
    </tr>
    <tr>
      <td nowrap="nowrap">Nro. de Documento</td>
      <td>... read numDocumento....</td>
    </tr>
    <tr>
      <td>email</td>
      <td>... read email....</td>
    </tr>
    <tr>
      <td>Usuario</td>
      <td>... read usuario....</td>
    </tr>
    <tr>
      <td>Password</td>
      <td>... read password....</td>
    </tr>
    <tr>
      <td>Rol Asignado</td>
      <td>... read idRolPrincipal ...</td>
    </tr>
    <tr>
      <td nowrap="nowrap">Proyectos Asignados</td>
      <td>... read idUsuarioRolEquipo.... ....nomProyecto.... </td>
    </tr>
    <tr>
      <td nowrap="nowrap">&nbsp;</td>
      <td><br />
      <input type="submit" name="botoneliminarUsuario" id="botoneliminarUsuario" value="Eliminar Usuario" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<br />
<br />
Agregar Usuario<br />

<form id="form1" name="form1" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td width="108" nowrap="nowrap">Nombre y Apellido</td>
    <td width="649"><input name="agregarnombreCompleto" type="text" id="agregarnombreCompleto" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Tipo de Documento</td>
    <td>... read TipoDocumento....</td>
  </tr>
  <tr>
    <td nowrap="nowrap">Nro. de Documento</td>
    <td><input name="agregarnumDocumento" type="text" id="agregarnumDocumento" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td>email</td>
    <td><input name="agregaremail" type="text" id="agregaremail" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td>Usuario</td>
    <td><input name="agregarusuario" type="text" id="agregarusuario" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input name="agregarpassword" type="text" id="agregarpassword" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td>Rol Asignado</td>
    <td>... read nombreRol ...</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>
      <br />
      <input type="submit" name="botonagregarUsuario" id="botonagregarUsuario" value="Agregar Usuario" />
      </p></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>

<p>&nbsp;</p>
</body>
</html>