<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Roles</title>
</head>

<body>

ABM de Proyectos<br />
<form id="abm_proyecto" name="abm_proyecto" method="post" action="">
<table width="788" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Nombre Proyecto</td>
    <td>Lider del Proyecto</td>
    <td>Proyectos Productivo</td>
    <td>Acciones</td>
  </tr>
  <tr>
    <td nowrap="nowrap"><?php $nombreProyecto; ?></td>
    <td nowrap="nowrap"><?php $nombreCompleto; ?>... read idLider ......</td>
    <td nowrap="nowrap"><?php $productivoProyecto; ?></td>
    <td nowrap="nowrap">...ver detalles...  ...edit... ...delete....</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<br /><br />
Ver Detalles Proyecto<br />
<form id="ver_proyecto" name="ver_proyecto" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre del Proyecto</td>
      <td width="649"><?php $nombreProyecto; ?></td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap">Objetivo</td>
      <td><?php $objProyecto; ?><br />
      <br />
      <br />
      <br /></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Inicio Proyecto</td>
      <td><?php $inicioProyecto; ?></td>
    </tr>
    <tr>
      <td>Fin Proyecto</td>
      <td><?php $finProyecto; ?></td>
    </tr>
    <tr>
      <td>Es Productivo ?</td>
      <td><?php $productivoProyecto; ?>
      </td>
    </tr>
    <tr>
      <td>Lider del Proyecto</td>
      <td><?php $idLider; ?></td>
    </tr>
  </table>
</form>
<br />
<br />

 Editar Proyecto<br />
<form id="editar_proyecto" name="editar_proyecto" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre del Proyecto</td>
      <td width="649"><input name="proyecto_nombreProyecto" type="text" id="proyecto_nombreProyecto" size="100" maxlength="255" value="<?php $nombreProyecto; ?>"/></td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap">Objetivo</td>
      <td><textarea name="proyecto_objProyecto" cols="80" rows="5"><?php $objProyecto; ?></textarea>
      </td>
    </tr>
    <tr>
      <td nowrap="nowrap">Inicio Proyecto</td>
      <td><input name="proyecto_inicioProyecto" type="text" id="proyecto_inicioProyecto" size="100" maxlength="255" value="<?php $inicioProyecto; ?>"/></td>
    </tr>
    <tr>
      <td>Fin Proyecto</td>
      <td><input name="proyecto_finProyecto" type="text" id="proyecto_finProyecto" size="100" maxlength="255" value="<?php $finProyecto; ?>"/></td>
    </tr>
    <tr>
      <td>Es Productivo ?</td>
      <td><input name="proyecto_productivoProyecto" type="text" id="proyecto_productivoProyecto" size="100" maxlength="255" value="<?php $productivoProyecto; ?>"/></td>
    </tr>
    <tr>
      <td>Lider del Proyecto</td>
      <td><select name="nombreCompleto">
        <option value="0">Marica</option>
      </select>... read idLider...</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><br />
      <input type="submit" name="botonupdateProyecto" id="botonupdateProyecto" value="Update Proyecto" /></td>
    </tr>
  </table>
</form>
<br />
<br />
Agregar Proyecto<br />
<form id="agregar_proyecto" name="agregar_proyecto" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td width="108" nowrap="nowrap">Nombre del Proyecto</td>
    <td width="649"><input name="agregar_nombreProyecto" type="text" id="agregar_nombreProyecto" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td align="right" valign="top" nowrap="nowrap">Objetivo</td>
    <td><textarea name="agregar_objProyecto" id="agregar_objProyecto" cols="100" rows="5"></textarea></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Inicio Proyecto</td>
    <td><input name="agregar_inicioProyecto" type="text" id="agregar_inicioProyecto" value="calendario" size="15" /></td>
  </tr>
  <tr>
    <td>Fin Proyecto</td>
    <td><input name="agregar_finProyecto" type="text" id="agregar_finProyecto" value="calendario" size="15" /></td>
  </tr>
  <tr>
    <td>Es Productivo ?</td>
    <td><input type="checkbox" name="agregar_proyectoproductivo" id="agregar_proyectoproductivo" />
      </td>
  </tr>
  <tr>
    <td>Lider del Proyecto</td>
    <td><select name="nombreCompleto">
        <option value="0">Ninguno</option>
      </select>... read nombreCompleto ...</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>
      <br />
      <input type="submit" name="botonagregarProyecto" id="botonagregarProyecto" value="Agregar Proyecto " />
      </p></td>
  </tr>
</table>
</form>
<br />
<br />
Borrar Proyecto<br />
<form id="borrar_proyecto" name="borrar_proyecto" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre del Proyecto</td>
      <td width="649"><select name="nombreProyecto">
        <option value="0">Ninguno</option>
      </select>....read nomProyecto... </td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap">Objetivo</td>
      <td><?php $objProyecto; ?>
      <br /></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Inicio Proyecto</td>
      <td><?php $inicioProyecto; ?></td>
    </tr>
    <tr>
      <td>Fin Proyecto</td>
      <td><?php $finProyecto; ?></td>
    </tr>
    <tr>
      <td>Es Productivo ?</td>
      <td><?php $productivoProyecto; ?></td>
    </tr>
    <tr>
      <td>Lider del Proyecto</td>
      <td><?php $nombreCompleto; ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><br />
        <input type="submit" name="botoneliminarProyecto" id="botoneliminarProyecto" value="Eliminar Proyecto" /></td>
    </tr>
  </table>
</form>
</body>
</html>