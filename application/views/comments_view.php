
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/assets/styles/stylei.css">

	<title></title>
</head>
<body>
<?php if ($filename!=""): ?>
	<img src="/assets/images/uploads/<?=$filename?>">

<?php endif ?>

<h3><?=$title?></h3>

<p><?=$body?></p>
<h4><?=$autor?>  <?=$fech?></h4>

<h1>Comentarios</h1>

<p><?=anchor('comments/regresar','Regresar');?></p>


<?php if ($this->session->userdata('login')): ?>
<?php if ($this->session->userdata('bann')=="no"): ?>
	
	<?php echo validation_errors(); ?>

<?=form_open('comments/comment_insert');?>
<?=form_hidden('entry_id',$this->uri->segment(3));?>


<p><textarea name="body" rows="10" value="<?php echo set_value('body'); ?>" placeholder="Comentario..." required></textarea></p>

<p><input type="submit" value="Enviar comentario"></p>
</form>
    <h2><?php echo $this->session->flashdata('inscom'); ?></h2> 
	<h2><?php echo $this->session->flashdata('comfo'); ?></h2> 
    <h2><?php echo $this->session->flashdata('comban'); ?></h2> 
<?php else: ?>
	<p>Tú cuenta ha sido banneada en unos días se normalizará bajo adevertencia</p> 

<?php endif ?>

<?php else: ?>
<p>Para poder escribir comentarios necesitas <?=anchor('login/login_view','Iniciar sesion');?> ó 
<?=anchor('user/new_user','Registrarte');?></p>
<?php endif ?>
	
	<?php foreach($comment as $row): ?>
		<p><?=$row->body?></p>
		<h4><?=$row->author?> <?=$row->dat?></h4>
		<?php if ($this->session->userdata('bann')=="no"): ?>
			<?=form_open('comments/reportar');?>
		<?=form_hidden('url',$ident);?>
		<?=form_hidden('user',$row->author);?>
		<?=form_hidden('cont',$row->body);?>
		<input type="submit" name="reportar" value="report">
		</form>
		
		<?php endif ?>
		
		<hr>
		<?php endforeach;?>

<?php echo $paginacion ?>


</body>
</html>