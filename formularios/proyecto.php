<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Roles</title>
</head>

<body>

ABM de Proyectos<br />
<table width="788" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Nombre Proyecto</td>
    <td>Lider del Proyecto</td>
    <td>Proyectos Productivo</td>
    <td>Acciones</td>
  </tr>
  <tr>
    <td nowrap="nowrap">.... red nombreProyecto .....</td>
    <td nowrap="nowrap">... read idLider ......</td>
    <td nowrap="nowrap">.... read productivoProyecto ...</td>
    <td nowrap="nowrap">...ver detalles...  ...edit... ...delete....</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br />
Ver Detalles Proyecto<br />
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre del Proyecto</td>
      <td width="649">....read nomProyecto... </td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap">Objetivo</td>
      <td>
      ....read objProyecto... <br />
      <br />
      <br />
      <br /></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Inicio Proyecto</td>
      <td>....read inicioProyecto ....</td>
    </tr>
    <tr>
      <td>Fin Proyecto</td>
      <td>....read finProyecto.....</td>
    </tr>
    <tr>
      <td>Es Productivo ?</td>
      <td>....read productivoProyecto
        <label for="proyectoproductivo2"></label></td>
    </tr>
    <tr>
      <td>Lider del Proyecto</td>
      <td>... read idLider...</td>
    </tr>
  </table>
<p><br />
</p>

 Editar Proyecto<br />
<form id="form3" name="form1" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre del Proyecto</td>
      <td width="649">....read nomProyecto... </td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap">Objetivo</td>
      <td><label for="agregarobjetivoProyecto3"></label>
        ....read objProyecto... <br />
        <br />
        <br />
        <br /></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Inicio Proyecto</td>
      <td>....read inicioProyecto ....</td>
    </tr>
    <tr>
      <td>Fin Proyecto</td>
      <td>....read finProyecto.....</td>
    </tr>
    <tr>
      <td>Es Productivo ?</td>
      <td>....read productivoProyecto
        <label for="proyectoproductivo2"></label></td>
    </tr>
    <tr>
      <td>Lider del Proyecto</td>
      <td>... read idLider...</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><br />
      <input type="submit" name="botonupdateProyecto" id="botonupdateProyecto" value="Update Proyecto" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<br />
Borrar Proyecto<br />
<form id="form2" name="form1" method="post" action="">
  <table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
    <tr>
      <td width="108" nowrap="nowrap">Nombre del Proyecto</td>
      <td width="649">....read nomProyecto... </td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap">Objetivo</td>
      <td><label for="agregarobjetivoProyecto4"></label>
        ....read objProyecto... <br />
        <br />
        <br />
        <br /></td>
    </tr>
    <tr>
      <td nowrap="nowrap">Inicio Proyecto</td>
      <td>....read inicioProyecto ....</td>
    </tr>
    <tr>
      <td>Fin Proyecto</td>
      <td>....read finProyecto.....</td>
    </tr>
    <tr>
      <td>Es Productivo ?</td>
      <td>....read productivoProyecto
        <label for="proyectoproductivo2"></label></td>
    </tr>
    <tr>
      <td>Lider del Proyecto</td>
      <td>... read idLider...</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><br />
        <input type="submit" name="botoneliminarProyecto" id="botoneliminarProyecto" value="Eliminar Proyecto" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<br />
<br />
Agregar Proyecto<br />

<form id="form1" name="form1" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td width="108" nowrap="nowrap">Nombre del Proyecto</td>
    <td width="649"><input name="agregarnombreProyecto" type="text" id="agregarnombreProyecto" size="100" maxlength="255" /></td>
  </tr>
  <tr>
    <td align="right" valign="top" nowrap="nowrap">Objetivo</td>
    <td><label for="agregarobjetivoProyecto"></label>
      <textarea name="agregarobjetivoProyecto" id="agregarobjetivoProyecto" cols="100" rows="5"></textarea></td>
  </tr>
  <tr>
    <td nowrap="nowrap">Inicio Proyecto</td>
    <td><label for="inicioProyecto"></label>
      <input name="inicioProyecto" type="text" id="inicioProyecto" value="calendario" size="15" /></td>
  </tr>
  <tr>
    <td>Fin Proyecto</td>
    <td><input name="finProyecto" type="text" id="finProyecto" value="calendario" size="15" /></td>
  </tr>
  <tr>
    <td>Es Productivo ?</td>
    <td><input type="checkbox" name="proyectoproductivo" id="proyectoproductivo" />
      <label for="proyectoproductivo"></label></td>
  </tr>
  <tr>
    <td>Lider del Proyecto</td>
    <td>... read nombreCompleto ...</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>
      <br />
      <input type="submit" name="botonagregarProyecto" id="botonagregarProyecto" value="Agregar Proyecto " />
      </p></td>
  </tr>
</table>
<p>&nbsp;</p>
</form>

<p>&nbsp;</p>
</body>
</html>