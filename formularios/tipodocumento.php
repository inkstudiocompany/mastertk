<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Roles</title>
</head>

<body>

ABM de Tipo de Documento<br /><br />
<form id="abm_tipodocumento" name="abm_documento" method="post" action="">
<table width="788" height="75" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Tipo de Documento</td>
    <td>Acciones</td>
  </tr>
  <tr>
    <td><?php $nombreDocumento; ?></td>
    <td nowrap="nowrap"> ...ver... ...edit... ...delete....</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
 <br />
  <br />
Ver Tipos de Documento<br />
<form id="ver_tipodocumento" name="ver_documento" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td width="108" nowrap="nowrap">Tipo de Documento</td>
    <td width="649"><?php $nombreDocumento; ?></td>
  </tr>
  </table>
</form>

<br />
<br />
Agregar Tipo de Documento<br />
<form id="agregar_tipodocumento" name="agregar_tipodocumento" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td width="108" nowrap="nowrap">Tipo de Documento</td>
    <td width="649"><input name="agregar_nombreDocumento" type="text" id="agregar_nombreDocumento" size="70" maxlength="255" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>
      <br />
      <input type="submit" name="botonagregarTipoDocumento" id="botonagregarTipoDocumento" value="Agregar Tipo de Documento" />
      </p></td>
  </tr>
</table>
</form>

 <br />
  <br />
Borrar Tipo de Documento<br />

<form id="borrar_tipodocumento" name="borrar_documento" method="post" action="">
<table width="765" height="48" border="2" cellpadding="0" cellspacing="0">
  <tr>
    <td width="108" nowrap="nowrap">Tipo de Documento</td>
    <td width="649"><select name="nombreDocumento">
        <option value="0">Ninguno</option>
      </select></td>
  </tr>
    <tr>
      <td nowrap="nowrap">&nbsp;</td>
      <td><br />
      <input type="submit" name="botoneliminartipodocumento" id="botoneliminartipodocumento" value="Borrar Tipo de Documento" /></td>
    </tr>
  </table>
</form>

</body>
</html>