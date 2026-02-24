<?php $this->layout('layout/main'); ?>

<h1>Criar conta</h1>

<?php if (!empty($error)): ?>
  <div class="alert alert-error"><?= $this->e($error) ?></div>
<?php endif; ?>

<form method="post" action="/register">
  <div>
    <label for="name">Nome</label>
    <input id="name" name="name" type="text" required>
  </div>

  <div>
    <label for="username">Username</label>
    <input id="username" name="username" type="text" minlength="3" maxlength="30" required>
  </div>

  <div>
    <label for="email">E-mail</label>
    <input id="email" name="email" type="email" required>
  </div>

  <div>
    <label for="password">Senha</label>
    <input id="password" name="password" type="password" minlength="6" required>
  </div>

  <button type="submit">Cadastrar</button>
</form>

<p class="link-row">Já tem conta? <a href="/login">Entrar</a></p>
