<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/assets/styles/stylei.css">
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
       <!--<link rel="stylesheet" href="/assets/styles/style.css" type="text/css" /> -->
	<title><?=$title?></title>

</head>
<body>
<?php if ($this->session->userdata('login')==TRUE): ?>
	

<section>
<div id="cabeza">
<h1>Editar/Elimnar entradas</h1>
</div>
<div id="contenido">
	
	<?php echo validation_errors(); ?>
<?php echo form_open_multipart('entries/update');?>


<p>Title:<input type="text" name="title"  value="<?php echo $title; ?>"></p>

<p>Texto:<textarea name="body" rows="10"  value="" ><?php  echo $body; ?></textarea></p>
<input type="hidden" name="id" value="<?=$id?>">
<p>Selecciona una imagen:<input type="file" name="userfile" size="20"></p>

<p> <input type="submit" name="actualizar" value="Actualizar"> </p>

</form>
    <h2><?php echo $this->session->flashdata('entupd'); ?></h2> 
    <h2><?php echo $this->session->flashdata('eupdfo'); ?></h2> 

<?php else: ?>
	<<?php echo "Acceso denegado" ?>
<?php endif ?>

</body>
</html>