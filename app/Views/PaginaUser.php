<?php
/* Views/Usuario.php
   Perfil de usuario con barra de navegación y estilo Yachay.
*/
session_start();

/* Datos simulados del usuario (reemplaza por lo que guardes en tu sesión / DB) */
$usuario = [
  'nombre'   => $_SESSION['user']['name']    ?? 'Alex',
  'apellido' => $_SESSION['user']['lastname']?? 'Vargas',
  'colegio'  => $_SESSION['user']['school']  ?? 'IE N.° 0000',
  'nivel'    => $_SESSION['user']['nivel']   ?? 'Secundaria', // Inicial | Primaria | Secundaria
  'grado'    => $_SESSION['user']['grado']   ?? '3°',
  'correo'   => $_SESSION['user']['email']   ?? 'alex@colegio.edu.pe',
  'numero'   => $_SESSION['user']['phone']   ?? '999 999 999',
];

$nombreMostrar = htmlspecialchars($usuario['nombre']);
$LOGO = 'app/Material/logo_yachay.png'; // o '/Material/logo_yachay.png'
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Yachay Perú · Usuario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root{
      --bg-top:#1b6d8f; --bg-mid:#2c7fa2; --bg-bot:#cfe2ec;
      --text:#143a56; --muted:#5b6b78; --brand:#194a69;
      --border:#d7e1e9; --card:#fff; --shadow:0 10px 30px rgba(0,0,0,.12);
      --accent:#f4b740; --accent-hover:#e9aa2f; --radius:16px;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0; font-family:"Nunito",system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
      background: linear-gradient(180deg, var(--bg-top) 0%, var(--bg-mid) 40%, var(--bg-bot) 100%);
      color:var(--text);
    }
    .appbar{position:sticky; top:0; z-index:10; background:rgba(255,255,255,.85); backdrop-filter:blur(6px); border-bottom:1px solid var(--border)}
    .appbar-inner{max-width:1100px; margin:0 auto; padding:10px 16px; display:flex; align-items:center; gap:12px}
    .appbar img.logo{height:38px} .appbar .title{font-weight:800; color:var(--brand)}
    .sun-corner{position:fixed; top:12px; right:12px; width:28px; height:28px; opacity:.9; pointer-events:none}
    .container{max-width:1100px; margin:0 auto; padding:22px 16px 40px}

    /* Barra de navegación tipo lista (los 4 botones de inicio) */
    .navlist{
      display:flex; gap:10px; flex-wrap:wrap; margin-bottom:16px; padding:0;
      list-style:none;
    }
    .navlist a{
      display:flex; align-items:center; gap:10px;
      padding:10px 14px; border-radius:12px; background:#eff6fb;
      border:1px solid #dfeaf2; color:#123a52; text-decoration:none; font-weight:700;
      transition:transform .06s ease, box-shadow .2s ease, border-color .2s ease;
    }
    .navlist a:hover{ transform:translateY(-1px); box-shadow:0 10px 22px rgba(0,0,0,.12); border-color:#c7d7e2 }
    .active{ background:#fff7e0 !important; border-color:#f7d27a !important }

    /* Card del formulario */
    .card{
      background:var(--card); border:1px solid var(--border); border-radius:var(--radius); box-shadow:var(--shadow);
      padding:18px;
    }
    .card h2{margin:0 0 6px; font-size:1.2rem; color:var(--brand)}
    .desc{margin:0 0 12px; color:#21516f; font-weight:600}
    .grid2{display:grid; grid-template-columns:1fr 1fr; gap:12px}
    @media (max-width:720px){ .grid2{grid-template-columns:1fr} }

    label{font-weight:700; font-size:.9rem; color:#355a74}
    .input, .select{
      width:100%; padding:11px 12px; border-radius:10px; border:1px solid #c7d3dc; font-size:1rem; outline:none;
      transition: box-shadow .2s, border-color .2s;
      background:#fff;
    }
    .input:focus, .select:focus{ border-color:#7fb3ce; box-shadow:0 0 0 3px rgba(127,179,206,.25) }

    .radio-group{display:flex; gap:10px; flex-wrap:wrap}
    .radio-pill{
      display:inline-flex; align-items:center; gap:8px; padding:8px 12px; border-radius:999px;
      border:1px solid #c7d3dc; background:#fff; cursor:pointer; font-weight:700; color:#355a74;
    }
    .radio-pill input{appearance:none; width:14px; height:14px; border-radius:999px; border:2px solid #7fb3ce; display:inline-block; position:relative}
    .radio-pill input:checked{ background:#7fb3ce }

    .actions{display:flex; gap:10px; margin-top:10px}
    .btn{
      appearance:none; border:0; cursor:pointer; border-radius:12px; font-weight:800; padding:10px 14px;
      box-shadow:var(--shadow);
    }
    .btn-primary{ background:var(--accent); color:#3a2a05 } .btn-primary:hover{ background:var(--accent-hover) }
    .btn-outline{ background:#fff; color:#194a69; border:1px solid #c7d7e2 }

    .muted{color:var(--muted); font-size:.9rem}
  </style>
</head>
<body>

  <!-- Sol esquina -->
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

  <!-- Header -->
  <header class="appbar">
    <div class="appbar-inner">
      <img class="logo" src="<?= htmlspecialchars($LOGO) ?>?v=1" alt="Logo Yachay">
      <div class="title">Yachay Perú</div>
    </div>
  </header>

  <main class="container">

    <!-- Barra de navegación (los 4 del inicio) -->
    <ul class="navlist" aria-label="Navegación principal">
      <li><a class="active" href="/mvc_yachay/public/index.php?controller=usuario&action=index"><i class="bi bi-person-fill"></i> Usuario</a></li>
      <li><a href="/mvc_yachay/public/index.php?controller=cursos&action=registrados"><i class="bi bi-journal-check"></i> Cursos registrados</a></li>
      <li><a href="/mvc_yachay/public/index.php?controller=cursos&action=disponibles"><i class="bi bi-journal-plus"></i> Cursos para registrarse</a></li>
      <li><a href="/mvc_yachay/public/index.php?controller=agenda&action=calendario"><i class="bi bi-calendar-week"></i> Calendario y asistencia</a></li>
    </ul>

    <!-- Encabezado de sección -->
    <section class="card" style="margin-bottom:12px">
      <h2>Hola, <?= $nombreMostrar ?> 👋</h2>
      <p class="desc">Edita tu información y mantén tu perfil actualizado.</p>
      <p class="muted">Los campos marcados con * son obligatorios.</p>
    </section>

    <!-- Formulario de perfil -->
    <section class="card">
      <form id="formPerfil" method="POST" action="/mvc_yachay/public/index.php?controller=usuario&action=guardar">
        <div class="grid2">
          <div>
            <label>Nombre *</label>
            <input class="input" name="nombre" required value="<?= htmlspecialchars($usuario['nombre']) ?>">
          </div>
          <div>
            <label>Apellido *</label>
            <input class="input" name="apellido" required value="<?= htmlspecialchars($usuario['apellido']) ?>">
          </div>

          <div>
            <label>Colegio *</label>
            <input class="input" name="colegio" required value="<?= htmlspecialchars($usuario['colegio']) ?>">
          </div>

          <div>
            <label>Nivel *</label>
            <div class="radio-group" id="nivelGroup">
              <?php
                $niveles = ['Inicial','Primaria','Secundaria'];
                foreach($niveles as $n):
                  $checked = ($usuario['nivel']===$n) ? 'checked' : '';
              ?>
                <label class="radio-pill">
                  <input type="radio" name="nivel" value="<?= $n ?>" <?= $checked ?>> <?= $n ?>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <div>
            <label>Grado *</label>
            <select class="select" name="grado" id="gradoSelect" required>
              <!-- Opciones se llenan con JS según nivel -->
            </select>
          </div>

          <div>
            <label>Correo *</label>
            <input class="input" type="email" name="correo" required value="<?= htmlspecialchars($usuario['correo']) ?>">
          </div>

          <div>
            <label>Número de contacto</label>
            <input class="input" type="tel" name="numero" placeholder="999 999 999" value="<?= htmlspecialchars($usuario['numero']) ?>">
          </div>
        </div>

        <div class="actions">
          <button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> Guardar cambios</button>
          <a class="btn btn-outline" href="/mvc_yachay/public/index.php?controller=home&action=index"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
      </form>
    </section>
  </main>

  <script>
    // Poblado dinámico de GRADO según NIVEL
    const gradoSelect = document.getElementById('gradoSelect');
    const nivelGroup = document.getElementById('nivelGroup');

    const grados = {
      'Inicial':   ['3 años','4 años','5 años'],
      'Primaria':  ['1°','2°','3°','4°','5°','6°'],
      'Secundaria':['1°','2°','3°','4°','5°']
    };

    function setGrados(nivel, preselect) {
      const lista = grados[nivel] || [];
      gradoSelect.innerHTML = '';
      lista.forEach(g => {
        const opt = document.createElement('option');
        opt.value = g;
        opt.textContent = g;
        if (preselect && preselect === g) opt.selected = true;
        gradoSelect.appendChild(opt);
      });
      if (!preselect && lista.length) gradoSelect.value = lista[0];
    }

    // Obtener el nivel inicial desde PHP
    const nivelInicial = <?= json_encode($usuario['nivel']) ?>;
    const gradoInicial = <?= json_encode($usuario['grado']) ?>;
    setGrados(nivelInicial, gradoInicial);

    // Cambiar opciones cuando cambia el nivel
    nivelGroup.addEventListener('change', (e) => {
      if (e.target.name === 'nivel') {
        setGrados(e.target.value, null);
      }
    });

    // Validación mínima
    document.getElementById('formPerfil').addEventListener('submit', (e) => {
      if (!gradoSelect.value) {
        e.preventDefault();
        alert('Selecciona un grado válido.');
      }
    });
  </script>
</body>
</html>
