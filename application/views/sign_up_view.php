<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/assets/styles/stylei.css">

	<title><?=$title?></title>
</head>
<body>

<h1>Registrate</h1>

<?php echo validation_errors(); ?>
<?=form_open('user/user_insert');?>

<p>Nombre:<input type="text" name="name" value="<?php echo set_value('name'); ?>" ></p>
<p>Usuario:<input type="text" name="user" value="<?php echo set_value('user'); ?>" ></p>
<p>Contraseña:<input type="password" name="pass" value="<?php echo set_value('pass'); ?>" ></p>
<p>Repite contraseña:<input type="password" name="passm" value="<?php echo set_value('passm'); ?>" ></p>

<p>Email:<input type="text" name="email" value="<?php echo set_value('email'); ?>" ></p>

<p><input type="submit" value="Registrarse"></p>
</form>
      <h2><?php echo $this->session->flashdata('refor'); ?></h2> 
      <h2><?php echo $this->session->flashdata('redu'); ?></h2> 
      <h2><?php echo $this->session->flashdata('reca'); ?></h2> 



</body>
</html>