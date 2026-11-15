<?php
/* Views/PaginaPrin.php
   Página principal con 4 botones grandes y saludo al usuario.
   Requiere que el login haya guardado el nombre en sesión.
*/
session_start();

/* Ajusta cómo obtienes el nombre del usuario:
   - Si usas Auth::user()['name'], reemplaza la línea de abajo por:
   $nombre = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'Usuario';
*/
$nombre = isset($_SESSION['user']['name'])
  ? $_SESSION['user']['name']
  : (isset($_GET['name']) ? $_GET['name'] : 'Usuario');

/* Ruta del logo PNG (ajústala a tu carpeta) */
$LOGO = '/mvc_yachay/public/img/logo_yachay.png'; // o '/Material/logo_yachay.png'
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Yachay Perú · Principal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
  <!-- (Opcional) Iconos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{
      --bg-top:#1b6d8f; --bg-mid:#2c7fa2; --bg-bot:#cfe2ec;
      --text:#143a56; --muted:#5b6b78;
      --brand:#194a69; --accent:#f4b740; --accent-hover:#e9aa2f;
      --card:#ffffff; --border:#d7e1e9;
      --shadow:0 10px 30px rgba(0,0,0,.12);
      --radius:16px;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:"Nunito",system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
      background: linear-gradient(180deg, var(--bg-top) 0%, var(--bg-mid) 40%, var(--bg-bot) 100%);
      color:var(--text);
    }

    /* Header reutilizable */
    .appbar{
      position:sticky; top:0; z-index:10;
      background: rgba(255,255,255,.85);
      backdrop-filter: blur(6px);
      border-bottom: 1px solid var(--border);
    }
    .appbar-inner{
      max-width:1100px; margin:0 auto; padding:10px 16px;
      display:flex; align-items:center; gap:12px;
    }
    .appbar img.logo{height:38px; width:auto}
    .appbar .title{font-weight:800; color:var(--brand); letter-spacing:.2px}

    /* Sun corner */
    .sun-corner{
      position:fixed; top:12px; right:12px; width:28px; height:28px; opacity:.9;
      pointer-events: none;
    }

    /* Contenedor principal */
    .container{
      max-width:1100px; margin:0 auto; padding:22px 16px 40px;
    }

    /* Saludo */
    .hero{
      background: rgba(255,255,255,.9);
      border:1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding:18px 18px;
      display:flex; align-items:center; gap:14px;
    }
    .hero .hello{
      font-size:1.35rem; font-weight:800; color:var(--brand); margin:0;
    }
    .hero .desc{margin:4px 0 0; color:#21516f; font-weight:600}

    /* Grid de botones */
    .grid{
      margin-top:18px;
      display:grid;
      grid-template-columns: repeat(2, minmax(0,1fr));
      gap:16px;
    }
    @media (max-width:640px){
      .grid{ grid-template-columns: 1fr; }
    }

    .tile{
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding:18px;
      display:flex; align-items:center; gap:14px;
      text-decoration:none; color:inherit;
      transition: transform .06s ease, box-shadow .2s ease, border-color .2s ease;
    }
    .tile:hover{
      transform: translateY(-1px);
      box-shadow: 0 16px 36px rgba(0,0,0,.12);
      border-color:#c7d7e2;
    }
    .tile .icon{
      width:54px; height:54px; border-radius:14px;
      display:grid; place-items:center; font-size:1.6rem; color:#123a52;
      background: #eff6fb; border:1px solid #dfeaf2;
    }
    .tile .text h3{
      margin:0; font-size:1.15rem; font-weight:800; color:#194a69;
    }
    .tile .text p{
      margin:4px 0 0; color:var(--muted); font-size:.95rem;
    }

    /* CTA inferior (opcional) */
    .cta{
      margin-top:18px; text-align:center;
    }
    .btn{
      appearance:none; border:0; cursor:pointer;
      background: var(--accent); color:#3a2a05; font-weight:800;
      font-size:1rem; padding:10px 14px;
      border-radius:12px; box-shadow:var(--shadow);
    }
    .btn:hover{ background: var(--accent-hover); }

    /* util */
    .spacer{height:12px}
  </style>
</head>
<body>

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

  <!-- Header reutilizable -->
  <header class="appbar">
    <div class="appbar-inner">
      <img class="logo" src="<?= htmlspecialchars($LOGO) ?>?v=1" alt="Logo Yachay">
      <div class="title">Yachay Perú</div>
    </div>
  </header>

  <main class="container">
    <!-- Saludo -->
    <section class="hero">
      <div><img src="<?= htmlspecialchars($LOGO) ?>?v=1" alt="" style="height:38px;width:auto;border-radius:8px"></div>
      <div>
        <h2 class="hello">Hola, <?= htmlspecialchars($nombre) ?> 👋</h2>
        <p class="desc">Bienvenido(a) a la plataforma Yachay</p>
      </div>
    </section>

    <!-- Grid de navegación (4 botones grandes) -->
    <section class="grid">
      <a class="tile" href="/mvc_yachay/public/index.php?controller=usuario&action=index">
        <div class="icon"><i class="bi bi-person-fill"></i></div>
        <div class="text">
          <h3>Usuario</h3>
          <p>Tu perfil, datos y preferencias.</p>
        </div>
      </a>

      <a class="tile" href="/mvc_yachay/public/index.php?controller=cursos&action=registrados">
        <div class="icon"><i class="bi bi-journal-check"></i></div>
        <div class="text">
          <h3>Cursos registrados</h3>
          <p>Lista y seguimiento de tus cursos.</p>
        </div>
      </a>

      <a class="tile" href="/mvc_yachay/public/index.php?controller=cursos&action=disponibles">
        <div class="icon"><i class="bi bi-journal-plus"></i></div>
        <div class="text">
          <h3>Cursos para registrarse</h3>
          <p>Explora e inscríbete en nuevos cursos.</p>
        </div>
      </a>

      <a class="tile" href="/mvc_yachay/public/index.php?controller=agenda&action=calendario">
        <div class="icon"><i class="bi bi-calendar-week"></i></div>
        <div class="text">
          <h3>Calendario y asistencia</h3>
          <p>Eventos, horarios y control de asistencia.</p>
        </div>
      </a>
    </section>

    <div class="cta">
      <button class="btn" onclick="alert('Demo: pronto añadimos más módulos ✅')">Acciones rápidas</button>
    </div>
  </main>
</body>
</html>
