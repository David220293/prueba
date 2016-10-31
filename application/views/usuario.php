
<?php if ($this->session->userdata('login')==TRUE): ?>

<table>
<?php foreach($users as $row): ?>

	<tr>
		<td><?=$row->name?></td>
		<td><?=$row->user?></td>
		<td><?=$row->email?></td>
		<td>
			<?=form_open('user/admin_up');?>
			<?=form_hidden('user',$row->user);?>
			<p><input type="submit" name="admin" value="Admin"></p>
			</form>



		</td>

	</tr>

<?php endforeach?>

</table>
        <h2><?php echo $this->session->flashdata('admup'); ?></h2> 

<?php else: ?>
	<?php echo "Acceso denegado" ?>
<?php endif ?>
