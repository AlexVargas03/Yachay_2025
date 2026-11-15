<?php
/* Views/CursosDisponibles.php
   Talleres disponibles (virtuales y presenciales) con inscripción externa.
*/
session_start();

$nombre = $_SESSION['user']['name'] ?? 'Usuario';
$LOGO   = '/mvc_yachay/public/img/logo_yachay.png'; // o '/Material/logo_yachay.png'

/* Talleres curados desde portales oficiales (MINCUL/MUNI/BNP).
   - Cada ítem: titulo, entidad, modalidad, fecha, horario, lugar, url
   - Botón "Inscribirme" abre la URL oficial en otra pestaña.
*/
$talleres = [
  [
    'titulo'   => 'Taller de dibujo y pintura de personajes de anime/manga',
    'entidad'  => 'Municipalidad de Miraflores – Palacio de las Artes (PLAM) & Shonen Academy',
    'modalidad'=> 'Presencial',
    'fecha'    => 'Domingo (próxima edición)',
    'horario'  => 'Desde las 4:00 p. m.',
    'lugar'    => 'Palacio de las Artes, Miraflores',
    'url'      => 'https://www.miraflores.gob.pe/miraflores-celebra-la-diversidad-cultural-de-japon-con-actividades-sobre-anime-manga-jpop-y-mas/'
  ],
  [
    'titulo'   => 'Biólogos por un día (taller vivencial de educación ambiental)',
    'entidad'  => 'Municipalidad de Miraflores',
    'modalidad'=> 'Presencial',
    'fecha'    => 'Fechas programadas (ver nota)',
    'horario'  => 'Horario según convocatoria',
    'lugar'    => 'Miraflores (espacios municipales)',
    'url'      => 'https://www.miraflores.gob.pe/explora-juega-y-aprende-miraflores-presenta-el-taller-vivencial-biologos-por-un-dia/'
  ],
  [
    'titulo'   => 'Supérate Lima – Yo Bilingüe (talleres gratuitos de idiomas)',
    'entidad'  => 'Municipalidad de Lima – Programa Supérate Lima',
    'modalidad'=> 'Virtual',
    'fecha'    => 'Ciclos vigentes (ver plataforma)',
    'horario'  => 'Según idioma y grupo',
    'lugar'    => 'En línea',
    'url'      => 'https://superatelima.munlima.gob.pe/noticia/51'
  ],
  [
    'titulo'   => 'Panadería y Pastelería (formación con beca)',
    'entidad'  => 'Municipalidad de Lima – Supérate Lima (aliado: CETPRO IDATEC)',
    'modalidad'=> 'Presencial',
    'fecha'    => '03/11/2025 – 30/05/2026',
    'horario'  => 'Martes y jueves · 6:00 p. m. – 8:00 p. m.',
    'lugar'    => 'Sedes del aliado según cohorte',
    'url'      => 'https://superatelima.munlima.gob.pe/beca/panadera-y-pastelera/601'
  ],
  [
    'titulo'   => 'Agenda Cultural MINCUL (talleres y actividades de la semana)',
    'entidad'  => 'Ministerio de Cultura',
    'modalidad'=> 'Mixto',
    'fecha'    => 'Semana vigente',
    'horario'  => 'Según actividad',
    'lugar'    => 'Sedes MINCUL / En línea',
    'url'      => 'https://www.cultura.gob.pe/'
  ],
  [
    'titulo'   => 'Escuela Deportiva MML – Talleres (ej. Futsal Niños)',
    'entidad'  => 'Municipalidad de Lima',
    'modalidad'=> 'Presencial',
    'fecha'    => '03/11/2025 – 27/11/2025 (ejemplo de cohorte)',
    'horario'  => 'Lunes y jueves · 3:00 p. m. – 4:30 p. m.',
    'lugar'    => 'Sedes deportivas MML',
    'url'      => 'https://extranet.munlima.gob.pe/escuelaDeportiva/'
  ],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Yachay Perú · Talleres disponibles</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root{
      --bg-top:#1b6d8f; --bg-mid:#2c7fa2; --bg-bot:#cfe2ec;
      --text:#143a56; --brand:#194a69; --muted:#5b6b78;
      --card:#ffffff; --border:#d7e1e9; --shadow:0 10px 30px rgba(0,0,0,.12);
      --accent:#f4b740; --accent-hover:#e9aa2f; --radius:16px;
      --badge:#eef2ff; --badge-txt:#3730a3;
    }
    *{box-sizing:border-box}
    body{
      margin:0; font-family:"Nunito",system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
      background: linear-gradient(180deg, var(--bg-top) 0%, var(--bg-mid) 40%, var(--bg-bot) 100%);
      color:var(--text);
    }
    .appbar{position:sticky; top:0; background:rgba(255,255,255,.85); backdrop-filter:blur(6px);
      border-bottom:1px solid var(--border);}
    .appbar-inner{max-width:1100px; margin:0 auto; padding:10px 16px; display:flex; align-items:center; gap:12px;}
    .logo{height:38px} .title{font-weight:800; color:var(--brand)}
    .container{max-width:1100px; margin:0 auto; padding:22px 16px 40px;}

    /* Nav (4 opciones) */
    .navlist{display:flex; gap:10px; flex-wrap:wrap; list-style:none; padding:0; margin:0 0 18px;}
    .navlist a{
      display:flex; align-items:center; gap:8px;
      padding:10px 14px; border-radius:12px; background:#eff6fb; border:1px solid #dfeaf2;
      color:#123a52; text-decoration:none; font-weight:700; transition:.2s;
    }
    .navlist a:hover{transform:translateY(-1px); box-shadow:0 10px 20px rgba(0,0,0,.1);}
    .active{background:#fff7e0!important; border-color:#f7d27a!important;}

    h2{color:var(--brand); margin:0 0 8px;}
    .desc{color:#21516f; font-weight:600; margin:0 0 18px;}

    /* Cards de talleres */
    .grid{display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:16px;}
    .card{
      background:var(--card); border:1px solid var(--border); border-radius:var(--radius);
      box-shadow:var(--shadow); padding:16px; display:flex; flex-direction:column; gap:8px;
      transition:.2s;
    }
    .card:hover{transform:translateY(-2px); box-shadow:0 16px 36px rgba(0,0,0,.12);}
    .card h3{margin:0; font-size:1.05rem; color:var(--brand)}
    .info{margin:0; font-size:.95rem; color:var(--muted)}
    .row{display:flex; align-items:center; gap:8px; font-size:.95rem; color:#26455b}
    .badge{display:inline-block; padding:4px 10px; border-radius:999px; background:var(--badge); color:var(--badge-txt); font-weight:800; font-size:.8rem}
    .btn-insc{
      margin-top:6px; display:inline-flex; align-items:center; gap:8px;
      background:var(--accent); color:#3a2a05; padding:10px 14px; border-radius:12px; text-decoration:none; font-weight:800;
      box-shadow:var(--shadow);
    }
    .btn-insc:hover{background:var(--accent-hover)}
    .nota{margin-top:4px; font-size:.85rem; color:#6b7280}
  </style>
</head>
<body>

  <header class="appbar">
    <div class="appbar-inner">
      <img src="<?= htmlspecialchars($LOGO) ?>" alt="Logo Yachay" class="logo">
      <div class="title">Yachay Perú</div>
    </div>
  </header>

  <main class="container">
    <!-- Barra de navegación -->
    <ul class="navlist">
      <li><a href="/mvc_yachay/public/index.php?controller=usuario&action=index"><i class="bi bi-person-fill"></i> Usuario</a></li>
      <li><a href="/mvc_yachay/public/index.php?controller=cursos&action=registrados"><i class="bi bi-journal-check"></i> Cursos registrados</a></li>
      <li><a class="active" href="#"><i class="bi bi-journal-plus"></i> Talleres disponibles</a></li>
      <li><a href="/mvc_yachay/public/index.php?controller=agenda&action=calendario"><i class="bi bi-calendar-week"></i> Calendario y asistencia</a></li>
    </ul>

    <h2>Hola, <?= htmlspecialchars($nombre) ?> 👋</h2>
    <p class="desc">Elige un taller presencial o virtual. Al inscribirte, te llevamos a la página oficial del organizador.</p>

    <section class="grid">
      <?php foreach($talleres as $t): ?>
        <article class="card">
          <div class="row">
            <span class="badge"><?= htmlspecialchars($t['modalidad']) ?></span>
          </div>
          <h3><i class="bi bi-easel"></i> <?= htmlspecialchars($t['titulo']) ?></h3>
          <p class="info">🏛️ <strong>Entidad:</strong> <?= htmlspecialchars($t['entidad']) ?></p>
          <p class="row"><i class="bi bi-calendar-event"></i> <strong>Fecha:</strong>&nbsp;<?= htmlspecialchars($t['fecha']) ?></p>
          <p class="row"><i class="bi bi-clock"></i> <strong>Horario:</strong>&nbsp;<?= htmlspecialchars($t['horario']) ?></p>
          <p class="row"><i class="bi bi-geo-alt"></i> <strong>Lugar:</strong>&nbsp;<?= htmlspecialchars($t['lugar']) ?></p>
          <a class="btn-insc" href="<?= htmlspecialchars($t['url']) ?>" target="_blank" rel="noopener">
            <i class="bi bi-box-arrow-up-right"></i> Inscribirme
          </a>
          <?php if (strpos($t['entidad'], 'Palacio de las Artes') !== false): ?>
            <div class="nota">* Inscripciones por redes de <strong>@PLAMoficial</strong> (ver nota oficial).</div>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </section>
  </main>

</body>
</html>
