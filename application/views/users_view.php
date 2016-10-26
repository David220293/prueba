<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet" href="/assets/styles/stylei.css" type="text/css" />

	<title></title>
</head>
<body>
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
</body>
</html>