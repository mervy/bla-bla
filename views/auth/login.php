<?php $this->layout('layout/main'); ?>

<h1>Entrar</h1>

<?php if (!empty($error)): ?>
  <div class="alert alert-error"><?= $this->e($error) ?></div>
<?php endif; ?>

<?php if (!empty($success)): ?>
  <div class="alert alert-success"><?= $this->e($success) ?></div>
<?php endif; ?>

<form method="post" action="/login">
  <div>
    <label for="email">E-mail</label>
    <input id="email" name="email" type="email" required>
  </div>

  <div>
    <label for="password">Senha</label>
    <input id="password" name="password" type="password" required>
  </div>

  <button type="submit">Entrar</button>
</form>

<p class="link-row">Não tem conta? <a href="/register">Cadastre-se</a></p>
