<?php /* login_yachay.php (con PNG) */ 
  // Ajusta la ruta del logo si tu APP_URL existe:
  $LOGO = '/Material/logo_yachay.png';
  // Si usas APP_URL en tu config:
  // $LOGO = APP_URL . '/img/logo_yachay.png';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Iniciar Sesión - Yachay Perú</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg-top:#1b6d8f; --bg-bot:#cfe2ec;
      --text:#143a56; --btn:#f4b740; --btn-hover:#e9aa2f;
      --card-bg:#ffffff; --shadow:0 10px 30px rgba(0,0,0,.12);
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:"Nunito",system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
      background: linear-gradient(180deg, var(--bg-top) 0%, #2c7fa2 40%, var(--bg-bot) 100%);
      display:flex; align-items:center; justify-content:center; color:var(--text);
    }
    .wrap{width:100%; max-width:420px; padding:24px; text-align:center; position:relative;}
    .sun-corner{position:absolute; top:14px; right:14px; width:28px; height:28px; opacity:.9;}
    .logo{width:220px; height:auto; margin:0 auto 10px; display:block; filter:drop-shadow(0 6px 12px rgba(0,0,0,.12));}
    h1{margin:6px 0 2px; font-weight:800; letter-spacing:.2px; color:#194a69; font-size:2rem;}
    .subtitle{margin:0 0 26px; color:#de6b3a; font-weight:700; font-size:.95rem;}
    .btn{
      appearance:none; border:0; cursor:pointer; background:var(--btn); color:#3a2a05; font-weight:800;
      font-size:1.05rem; padding:12px 16px; border-radius:12px; width:240px; box-shadow:var(--shadow);
      transition:transform .05s ease, background .2s ease;
    }
    .btn:active{transform:translateY(1px)} .btn:hover{background:var(--btn-hover)}
    .links{margin-top:14px; color:#274b66; font-weight:600; font-size:.95rem; display:flex; gap:14px; justify-content:center;}
    .links a{color:#274b66; text-decoration:none;} .links a:hover{text-decoration:underline;}
    .card{margin:18px auto 0; background:var(--card-bg); border-radius:14px; padding:18px 16px;
      max-width:360px; text-align:left; box-shadow:var(--shadow); display:none;}
    .field{margin:10px 0;} .label{font-weight:700; font-size:.9rem; color:#355a74;}
    .input{width:100%; padding:11px 12px; border-radius:10px; border:1px solid #c7d3dc; font-size:1rem; outline:none;
      transition: box-shadow .2s, border-color .2s;}
    .input:focus{border-color:#7fb3ce; box-shadow:0 0 0 3px rgba(127,179,206,.25);}
    .submit{margin-top:10px; width:100%; background:#1f6aa3; color:#fff; font-weight:800; border:0; padding:11px 12px; border-radius:10px; cursor:pointer;}
    .submit:hover{filter:brightness(.96)}
    @media (max-width:420px){ .logo{width:200px} .btn{width:220px} }
  </style>
</head>
<body>
  <main class="wrap">
    <!-- Sol de esquina -->
    <svg class="sun-corner" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <circle cx="32" cy="32" r="11" fill="#f8c23b"/>
      <?php for ($i=0;$i<12;$i++): $a=$i*30; ?>
        <rect x="31" y="6" width="2" height="10" fill="#f8c23b" transform="rotate(<?= $a ?> 32 32)" />
      <?php endfor; ?>
      <circle cx="32" cy="32" r="6" fill="#ffcc4d"/>
      <circle cx="30" cy="30" r="1.5" fill="#dd6b20"/>
      <circle cx="34" cy="30" r="1.5" fill="#dd6b20"/>
      <path d="M28 34c2.2 2.6 5.8 2.6 8 0" stroke="#dd6b20" stroke-width="2" fill="none" stroke-linecap="round"/>
    </svg>

    <!-- LOGO PNG -->
    <img class="logo" src="<?= htmlspecialchars($LOGO) ?>?v=1" alt="Logo Yachay Perú">

    <h1>Yachay Perú</h1>
    <p class="subtitle">Cuida tu mente, protege tu mundo</p>

    <!-- Botón principal (muestra el formulario) -->
    <button class="btn" id="btnIngresar" type="button">Ingresar</button>

    <!-- Enlaces -->
    <div class="links" aria-label="Acciones secundarias">
      <a href="#">Olvidé mi contraseña</a>
      <span>·</span>
      <a href="#">Soy institución</a>
    </div>

    <!-- Formulario (se muestra al pulsar "Ingresar") -->
    <form class="card" id="formLogin" action="/login" method="POST" novalidate<?= !empty($error) ? ' style="display:block"' : '' ?>>
      <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf ?? '') ?>">
      <?php if (!empty($error)): ?><p style="color:#c0392b;font-weight:700;margin:0 0 6px"><?= htmlspecialchars($error) ?></p><?php endif; ?>
      <div class="field">
        <label class="label" for="email">Correo electrónico</label>
        <input class="input" type="email" id="email" name="email" placeholder="Ingresa tu correo por aquí" required>
      </div>
      <div class="field">
        <label class="label" for="password">Contraseña</label>
        <input class="input" type="password" id="password" name="password" placeholder="••••••••" minlength="4" required>
      </div>
      <button class="submit" type="submit">Entrar</button>
    </form>
  </main>

  <script>
    // Mostrar/ocultar formulario
    const btn = document.getElementById('btnIngresar');
    const form = document.getElementById('formLogin');
    btn.addEventListener('click', () => {
      form.style.display = (form.style.display !== 'block') ? 'block' : 'none';
      if (form.style.display === 'block') form.scrollIntoView({behavior:'smooth', block:'nearest'});
    });
  </script>
</body>
</html>
