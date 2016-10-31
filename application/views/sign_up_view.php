<?php if ($click== false): ?>
	
<h1>Registrate</h1>

<?=form_open('user/user_insert');?>

<p>Nombre:<input type="text" name="name" value="<?php echo set_value('name'); ?>" required ></p>
<p>Usuario:<input type="text" name="user" value="<?php echo set_value('user'); ?>" required></p>
<p>Contraseña:<input type="password" name="pass" value="<?php echo set_value('pass'); ?>" required></p>
<p>Repite contraseña:<input type="password" name="passm" value="<?php echo set_value('passm'); ?>" required></p>

<p>Email:<input type="text" name="email" value="<?php echo set_value('email'); ?>" required></p>
<p>Selecciona un idioma <input type="radio" name="idioma" value="Ingles">Ingles<input type="radio" name="idioma" value="Español">Español</p>

<p><input type="submit" value="Registrarse"></p>
</form>
      <h2><?php echo $this->session->flashdata('refor'); ?></h2> 
      <h2><?php echo $this->session->flashdata('redu'); ?></h2> 
      <h2><?php echo $this->session->flashdata('reca'); ?></h2> 
            <h2><?php echo $this->session->flashdata('reins'); ?></h2> 

<?php else:?>
<?=form_open('user/user_insert');?>

<p>Nombre:<input type="text" name="name" value="<?php echo $nombre;?>" required ></p>
<p>Usuario:<input type="text" name="user" value="<?php echo $user; ?>" required></p>
<p>Contraseña:<input type="password" name="pass" value="<?php echo set_value('pass'); ?>" required></p>
<p>Repite contraseña:<input type="password" name="passm" value="<?php echo set_value('passm');?>" required></p>

<p>Email:<input type="text" name="email" value="<?php echo $mail; ?>" required></p>
<p>Selecciona un idioma <input type="radio" name="idioma" value="Ingles">Ingles<input type="radio" name="idioma" value="Español">Español</p>

<p><input type="submit" value="Registrarse"></p>
</form>

 <h2><?php echo $this->session->flashdata('refor'); ?></h2> 
      <h2><?php echo $this->session->flashdata('redu'); ?></h2> 
      <h2><?php echo $this->session->flashdata('reca'); ?></h2> 
            <h2><?php echo $this->session->flashdata('reins'); ?></h2> 
<?php endif ?>
