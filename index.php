<?php include 'includes/header.php'; ?>

<section class='hero full'>
  <div class='hero-inner'>
    <div>
      <span class='badge'>&#127891; Student Clearance Portal</span>
      <h1>Clear from campus <span>faster</span>, without the queues.</h1>
      <p class='lead'>Submit your clearance request online, let each department review it, and track every decision in real time.</p>
      <p>
        <?php if (isset($_SESSION['user_id'])): ?>
          <a class='btn gold' href='<?= BASE . '/' . $_SESSION['role'] ?>/dashboard.php'>Go to my dashboard</a>
        <?php else: ?>
          <a class='btn gold' href='login.php'>Login</a>
          <a class='btn ghost' href='register.php'>Create account</a>
        <?php endif; ?>
      </p>
    </div>
    <?php if (!file_exists(__DIR__ . '/assets/images/hero.jpg')): ?>
    <div>
      <!-- Campus illustration (shown on top of your photo; replace by adding assets/images/campus1.jpg) -->
      <svg viewBox='0 0 480 340' xmlns='http://www.w3.org/2000/svg' role='img' aria-label='Campus building'>
        <defs>
          <linearGradient id='sky' x1='0' y1='0' x2='0' y2='1'><stop offset='0' stop-color='#9fd3f5'/><stop offset='1' stop-color='#fdf1cf'/></linearGradient>
          <linearGradient id='wall' x1='0' y1='0' x2='0' y2='1'><stop offset='0' stop-color='#fff8e6'/><stop offset='1' stop-color='#e9d9ac'/></linearGradient>
          <linearGradient id='roof' x1='0' y1='0' x2='1' y2='1'><stop offset='0' stop-color='#2e86c1'/><stop offset='1' stop-color='#12365a'/></linearGradient>
        </defs>
        <rect width='480' height='340' rx='18' fill='url(#sky)'/>
        <circle cx='410' cy='62' r='26' fill='#f7d56a' opacity='.9'/>
        <ellipse cx='90' cy='60' rx='42' ry='13' fill='#fff' opacity='.85'/><ellipse cx='125' cy='52' rx='30' ry='11' fill='#fff' opacity='.85'/>
        <rect x='0' y='286' width='480' height='54' fill='#5fae6b'/>
        <rect x='0' y='300' width='480' height='40' fill='#4a9a58'/>
        <path d='M200 340 L222 292 H258 L280 340 Z' fill='#e4cf94'/>
        <!-- tower -->
        <rect x='212' y='60' width='56' height='120' fill='url(#wall)' stroke='#cdb978'/>
        <polygon points='204,64 240,20 276,64' fill='url(#roof)'/>
        <circle cx='240' cy='96' r='15' fill='#fff' stroke='#12365a' stroke-width='3'/>
        <path d='M240 96 V86 M240 96 L247 100' stroke='#12365a' stroke-width='2.5' stroke-linecap='round'/>
        <!-- main block -->
        <rect x='80' y='170' width='320' height='118' fill='url(#wall)' stroke='#cdb978'/>
        <polygon points='70,172 240,140 410,172' fill='url(#roof)'/>
        <g fill='#2e86c1' stroke='#12365a' stroke-width='1.5'>
          <rect x='100' y='192' width='28' height='38' rx='14'/><rect x='146' y='192' width='28' height='38' rx='14'/>
          <rect x='306' y='192' width='28' height='38' rx='14'/><rect x='352' y='192' width='28' height='38' rx='14'/>
        </g>
        <!-- columns + door -->
        <g fill='#fff' stroke='#cdb978'><rect x='196' y='196' width='10' height='92'/><rect x='216' y='196' width='10' height='92'/><rect x='254' y='196' width='10' height='92'/><rect x='274' y='196' width='10' height='92'/></g>
        <rect x='228' y='224' width='24' height='64' rx='12' fill='#12365a'/>
        <rect x='190' y='186' width='100' height='10' fill='#d4a62a'/>
        <!-- trees -->
        <g><rect x='38' y='248' width='8' height='40' fill='#7a5230'/><circle cx='42' cy='238' r='26' fill='#2f8f4e'/><circle cx='30' cy='250' r='16' fill='#3aa75f'/></g>
        <g><rect x='436' y='248' width='8' height='40' fill='#7a5230'/><circle cx='440' cy='238' r='26' fill='#2f8f4e'/><circle cx='452' cy='250' r='16' fill='#3aa75f'/></g>
        <!-- flag -->
        <line x1='240' y1='20' x2='240' y2='4' stroke='#12365a' stroke-width='2'/><polygon points='240,4 258,9 240,14' fill='#d4a62a'/>
      </svg>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class='section'>
  <h2>How it works</h2>
  <p class='sub'>Four simple steps from request to cleared.</p>
  <div class='steps'>
    <div class='card'><div class='num'>1</div><h3>Register</h3><p>Create your student account with your registration number.</p></div>
    <div class='card'><div class='num'>2</div><h3>Submit</h3><p>Send one request to every department with a single click.</p></div>
    <div class='card'><div class='num'>3</div><h3>Get reviewed</h3><p>Each department officer approves or rejects with a comment.</p></div>
    <div class='card'><div class='num'>4</div><h3>Get cleared</h3><p>When all departments approve, your status becomes Cleared.</p></div>
  </div>
</section>

<section class='band full'>
  <div class='section'>
    <h2>Departments that clear you</h2>
    <p class='sub'>Each department confirms you have no outstanding obligations.</p>
    <div class='depts'>
      <?php
      $icons = ['Library' => '&#128218;', 'Finance' => '&#128176;', 'Hostel' => '&#127968;', 'Academics' => '&#127891;', 'Sports' => '&#9917;'];
      $res = $conn->query('SELECT department_name, description FROM departments ORDER BY department_id');
      while ($d = $res->fetch_assoc()): ?>
        <div class='dept'>
          <div class='ico'><?= $icons[$d['department_name']] ?? '&#127979;' ?></div>
          <b><?= e($d['department_name']) ?></b>
          <small><?= e($d['description']) ?></small>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<section class='section'>
  <h2>Life on campus</h2>
  <p class='sub'>Add your own photos in <code>assets/images/</code> to replace these colour panels.</p>
  <div class='gallery'>
    <div class='shot s1'><span>Administration Block</span></div>
    <div class='shot s2'><span>Library</span></div>
    <div class='shot s3'><span>Students</span></div>
    <div class='shot s4'><span>Our Campus</span></div>
  </div>
</section>

<?php if (!isset($_SESSION['user_id'])): ?>
<section class='cta full'>
  <h2>Ready to start your clearance?</h2>
  <p>Create an account and submit your request in minutes.</p>
  <a class='btn gold' href='register.php'>Get started</a>
</section>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
