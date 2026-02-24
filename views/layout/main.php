<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $this->e($appName) ?></title>
  <style>
    body { font-family: Arial, sans-serif; margin: 0; background: #f6f7fb; color: #222; }
    .container { max-width: 420px; margin: 40px auto; background: #fff; padding: 24px; border-radius: 10px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
    h1 { margin-top: 0; font-size: 1.6rem; }
    form { display: grid; gap: 12px; }
    label { font-weight: bold; font-size: 0.9rem; }
    input { padding: 10px; border: 1px solid #ccc; border-radius: 8px; }
    button { padding: 10px 12px; border: none; border-radius: 8px; cursor: pointer; background: #315efb; color: #fff; font-weight: bold; }
    .alert { border-radius: 8px; padding: 10px; margin-bottom: 12px; font-size: 0.9rem; }
    .alert-error { background: #ffe5e5; color: #9b1d1d; }
    .alert-success { background: #e7f8eb; color: #1f7a32; }
    .link-row { margin-top: 12px; font-size: 0.9rem; }
    .link-row a { color: #315efb; text-decoration: none; }
    .dashboard { max-width: 640px; }
  </style>
</head>
<body>
  <div class="container <?= isset($dashboard) && $dashboard ? 'dashboard' : '' ?>">
    <?= $this->section('content') ?>
  </div>
</body>
</html>
