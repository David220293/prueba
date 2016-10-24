<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="/assets/styles/stylei.css" type="text/css" />
	<title></title>

</head>
<body>

<h1>Bienvenido a mi blog</h1>

<section>
<div id="cabeza">
<h1></h1>
</div>
<div id="contenido">
<h2><?php echo $this->session->flashdata('entupd'); ?></h2> 
    <h2><?php echo $this->session->flashdata('eupdfo'); ?></h2> 
       <h2><?php echo $this->session->flashdata('delpo'); ?></h2> 



<?php foreach($entries as $row): ?>
<h3><?=$row->title;?></h3>
<p><?=substr($row->body,0,500);?></p>
<h4><?=$row->autor;?>    <?=$row->dat;?></h4>
<p><?=anchor('comments/comments/'.$row->id,'Leer.');?></p>
	<?php if ($this->session->userdata('type_user')=="admin"): ?>
		<?=form_open('entries/del');?>

		<p><input type="hidden" name="titles" value="<?=$row->title;?>"></p>
		<p><input type="hidden" name="date" value="<?=$row->dat;?>"></p>
		<p><input type="submit" name="delete" value="Eliminar"><input type="submit" name="upd" value="Actualizar"></p>
		</form>

	<?php endif ?>

<hr>

<?php endforeach;?>
    <?php echo $paginacion; ?>
</div>

</section>
</body>
</html>