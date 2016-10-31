
<?php if ($this->session->userdata('login')==TRUE): ?>

<table>
<?php foreach($users as $row): ?>

	<tr>
		<td><?=$row->name?></td>
		<td><?=$row->user?></td>
		<td><?=$row->email?></td>
		<td>
			<?=form_open('user/bann_up');?>
			<?=form_hidden('user',$row->user);?>
			<p><input type="submit" name="up" value="Disbann"><input type="submit" name="del" value="Expulsar"></p>
			</form>



		</td>

	</tr>

<?php endforeach?>

</table>
    <h2><?php echo $this->session->flashdata('noresulus'); ?></h2> 
    <h2><?php echo $this->session->flashdata('ban'); ?></h2> 

<?php else: ?>
	<?php echo "Acceso denegado" ?>
<?php endif ?>
