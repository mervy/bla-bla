<?php $this->layout('layout/main', ['dashboard' => true]); ?>

<h1>Dashboard</h1>
<p>Bem-vindo, <strong><?= $this->e($user->name) ?></strong>!</p>
<p>Seu e-mail cadastrado é <?= $this->e($user->email) ?>.</p>

<form method="post" action="/logout">
  <button type="submit">Sair</button>
</form>
