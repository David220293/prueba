<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php if ($this->session->userdata('login')==TRUE): ?>
	

<section>
<div id="cabeza">
<h1>Datos del usuario</h1>
</div>
<div id="contenido">
	
	<?php echo validation_errors(); ?>

<?=form_open('usuario/update');?>

<p>Title:<input type="text" name="title"  value="<?php echo $title; ?>"></p>

<p>Texto:<textarea name="body" rows="10"  value="" ><?php  echo $body; ?></textarea></p>
<input type="hidden" name="id" value="<?=$id?>">

<p> <input type="submit" name="actualizar" value="Actualizar"> </p>

</form>
   <!-- <h2><?php echo $this->session->flashdata('entupd'); ?></h2> 
    <h2><?php echo $this->session->flashdata('eupdfo'); ?></h2> -->

<?php else: ?>
	<<?php echo "Acceso denegado" ?>
<?php endif ?>

</body>
</html>