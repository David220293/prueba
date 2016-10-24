<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php if ($this->session->userdata('login')): ?>
	
	<?php foreach($comments as $row): ?>
		<p><?=$row->body?></p>
		<h4><?=$row->author?> <?=$row->dat?></h4>
		<?=form_open('comments/bann');?>
		<?=form_hidden('id',$row->id);?>
		<?=form_hidden('user',$row->author);?>
		<p><input type="submit" name="del" value="Eliminar"><input type="submit" name="rest" value="Restaurar"><input type="submit" name="bann" value="Bannear"></p>
		</form>
	
		<hr>
		<?php endforeach;?>
	<?php else: ?>
		<?php echo "acceso denegado" ?>
	<?php endif ?>


</body>
</html>