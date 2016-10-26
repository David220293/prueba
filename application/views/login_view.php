<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/assets/styles/stylei.css">

	<title>Inicia sesion</title>
</head>
<body>
<h1>Inicia sesion</h1>
<?php echo validation_errors(); ?>

<?=form_open('login/login_check');?>

<p>Usuario:<input type="text" name="user" value="<?php echo set_value('user'); ?>" ></p>
<p>Contraseña:<input type="password" name="pass" value="<?php echo set_value('pass'); ?>" ></p>
<p><input type="submit" value="Iniciar"></p>
</form>
      <h2><?php echo $this->session->flashdata('usfail'); ?></h2> 
      <h2><?php echo $this->session->flashdata('usfo'); ?></h2> 
      <h2><?php echo $this->session->flashdata('passfail'); ?></h2> 
      <h2><?php echo $this->session->flashdata('err'); ?></h2> 


</body>
</html>