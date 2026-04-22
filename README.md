
<body>

<h1>Laravel Admin Dashboard Boilerplate</h1>

<p>Boilerplate ini dirancang untuk <strong>freelance project atau internal project</strong>, production-ready, dengan setup <strong>super-admin, app name, dan logo</strong> di terminal.</p>

<h2>Prasyarat</h2>
<ul>
    <li>PHP &gt;= 8.1</li>
    <li>Composer</li>
    <li>MySQL / MariaDB</li>
    <li>Node.js &amp; npm/yarn (jika menggunakan frontend build)</li>
    <li>Laravel 12+</li>
</ul>

<h2>Instalasi</h2>

<h3>1. Clone repository</h3>
<pre><code>git clone https://github.com/username/laravel-admin-boilerplate.git
cd laravel-admin-boilerplate
</code></pre>

<h3>2. Install dependencies</h3>
<pre><code>composer install
npm install
npm run dev
</code></pre>

<h3>3. Buat file <code>.env</code></h3>
<pre><code>cp .env.example .env
</code></pre>

<h3>4. Generate APP_KEY</h3>
<pre><code>php artisan key:generate
</code></pre>

<h3>5. Setup Database</h3>
<ul>
    <li>Buat database baru di MySQL</li>
    <li>Update <code>.env</code>:</li>
</ul>
<pre><code>DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=
</code></pre>

<h3>6. Jalankan Migrasi & Seeder</h3>
<div class="note">
Seeder tidak membuat user, hanya role, permission, dan settings default.
</div>
<pre><code>php artisan migrate
php artisan db:seed
</code></pre>

<h3>7. Install aplikasi (first-time setup)</h3>
<div class="note">
Ini akan meminta input <strong>admin, password, app name, dan logo</strong>.
</div>
<pre><code>php artisan app:install
</code></pre>
<p>Flow di terminal:</p>
<pre><code>Admin name: juu
Admin email: juu@example.com
Admin password: ********
Confirm password: ********
App name: My Dashboard
Path to logo file: /home/juu/logo.png
</code></pre>
<ul>
    <li>Super-admin dibuat</li>
    <li>Role &amp; permission otomatis assign</li>
    <li>App name &amp; logo tersimpan di table <code>settings</code></li>
</ul>

<h2>Jalankan Aplikasi</h2>
<pre><code>php artisan serve
</code></pre>
<p>Buka browser: <code>http://localhost:8000</code></p>

<h2>Struktur Folder</h2>
<pre><code>laravel-admin-boilerplate/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
├── config/
│   └── admin_menu.php
├── database/
│   └── seeders/
├── resources/
│   └── views/
├── public/
├── routes/
├── storage/
├── tests/
├── vendor/
├── .env.example
├── artisan
├── composer.json
├── package.json
├── README.md
</code></pre>

<h2>Role &amp; Permission</h2>
<ul>
    <li>Role: super-admin, owner, admin</li>
    <li>Permission: assign via seeder, configurable via UI</li>
    <li>Sidebar &amp; route: permission-based</li>
</ul>

<h2>Menu &amp; Settings</h2>
<ul>
    <li>Logo disimpan di <code>storage/app/public/logo</code></li>
    <li>Pastikan membuat symlink storage: <code>php artisan storage:link</code></li>
    <li>Activity log: tampil di menu khusus admin (read-only)</li>
    <li>Settings page: app name, logo, email/phone, maintenance toggle, cache setting</li>
</ul>

<h2>Catatan Developer</h2>
<ul>
    <li>Untuk menambahkan menu baru → edit <code>config/admin_menu.php</code> + buat permission + route</li>
    <li>Seeder tidak membuat user → user dibuat hanya via <code>app:install</code></li>
    <li>Hardcoded feature + permission-based access → aman & enterprise-ready</li>
</ul>

</body>
</html>
