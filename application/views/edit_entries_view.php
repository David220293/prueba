
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
       <!--<link rel="stylesheet" href="/assets/styles/style.css" type="text/css" /> -->
	
<?php if ($this->session->userdata('login')==TRUE): ?>
	

<section>
<div id="cabeza">
<h1>Editar entrada</h1>
</div>
<div id="contenido">
	
<?php echo form_open_multipart('entries/update');?>


<p>Title:<input type="text" name="title"  value="<?php echo $title; ?>" required></p>

<p>Texto:<textarea name="body" rows="10"  value="" required><?php  echo $body; ?></textarea></p>
<input type="hidden" name="id" value="<?=$id?>">
<?php if ($img == ""): ?>
	<p>Selecciona una imagen:<input type="file" value="" name="userfile" size="20"></p>
<?php else: ?>
	<p> <input type="submit" name="imagen" value="Act. imagen"> 

<?php endif ?>

<input type="submit" name="actualizar" value="Actualizar"> </p>

</form>
    <h2><?php echo $this->session->flashdata('entupd'); ?></h2> 
    <h2><?php echo $this->session->flashdata('eupdfo'); ?></h2> 
    <h2><?php echo $this->session->flashdata('errupd'); ?></h2> 

<?php else: ?>
	<?php echo "Acceso denegado" ?>
<?php endif ?>

