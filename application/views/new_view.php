<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/assets/styles/stylei.css">
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
	<title><?=$title?></title>
</head>
<body>
<?php if ($this->session->userdata('login')==TRUE): ?>
	

<h1><?=$heading?></h1>
<?php echo validation_errors(); ?>
<?php echo form_open_multipart('entries/entries_insert');?>
<p>Titulo:<input type="text" name="title"  value="<?php echo set_value('title'); ?>" placeholder="Titlo de la entrada" required></p>

<p>Texto:<textarea name="body" rows="10"  value="<?php echo set_value('body'); ?>" ><?php echo set_value('body'); ?></textarea></p>
<p>Selecciona una imagen:<input type="file" name="userfile" size="20"></p>


<p><input type="submit" value="Subir Entrada"></p>

</form>
      <h2><?php echo $this->session->flashdata('ins'); ?></h2> 
      <h2><?php echo $this->session->flashdata('val'); ?></h2> 
       <h2><?php echo $this->session->flashdata('erren'); ?></h2> 
    


<?php else: ?>
	<?php echo "Acceso denegado" ?>
<?php endif ?>
</body>
</html>