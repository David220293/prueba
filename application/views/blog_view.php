<!DOCTYPE html>
<html>
<head>
        <!--<link rel="stylesheet" href="/assets/styles/style.css" type="text/css" /> -->
        <link rel="stylesheet" type="text/css" href="/assets/styles/stylei.css">
	<title>Mi Blog</title>

</head>
<body>

<nav>

<div id="navi">
<ul>
<?php if ($this->session->userdata('login')==TRUE): ?>
		<li><h5><a href="<?=site_url('blog');?>" >Inicio</a></h5></li>

	
	<?php if ($this->session->userdata('type_user')=="admin"): ?>
		<li><h5><a href="<?=site_url('entries/new_entry');?>" target="cont">Nueva entrada</a></h5></li>
		<li><h5><a href="<?=site_url('comments/bann_view');?>" target="cont">Reportados</a></h5></li>
		<li><h5><a href="<?=site_url('user/bann_users');?>" target="cont">Usuarios baneados</a></h5></li>
		<li><h5><a href="<?=site_url('user/admin');?>" target="cont">Hacer admin</a></h5></li>


	<?php endif ?>
		<li><h5><a href="<?=site_url('blog/close');?>">Cerrar sesion</a></h5></li>

<?php elseif($this->session->userdata('login')==FALSE): ?>
		<li><h5><a href="<?=site_url('blog');?>" >Inicio</a></h5></li>
		<li><h5><a href="<?=site_url('user/new_user');?>" target="cont">Crear cuenta</a></h5></li>
		<li><h5><a href="<?=site_url('login/login_view');?>" target="cont">Iniciar sesion</a></h5></li>



<?php endif ?>


</ul>

</div>
<img src="assets/images/madera.jpg">
</nav><br>

<section>
<div id="cabeza">
</div>

<div id="cuerpo">
	<div id="fr">
	   
	<iframe src="<?=site_url('entries/entri');?>" name="cont" ></iframe>

</div>
</div>

</section>
</body>
</html>
