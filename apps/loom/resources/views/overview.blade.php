<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Loom — Interface Futuriste</title>
  <!-- Tailwind CDN (configurable) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Tailwind config - adapt (v4-style utilities assumed)
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            loom: {
              50: '#f5f7ff',
              100: '#eef2ff',
              300: '#bfc8ff',
              500: '#7878ff',
              700: '#4b49ff'
            }
          },
          keyframes: {
            float: {
              '0%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-8px)' },
              '100%': { transform: 'translateY(0px)' }
            }
          },
          animation: {
            float: 'float 6s ease-in-out infinite'
          },
          backdropBlur: {
            xs: '2px'
          }
        }
      }
    }
  </script>
  <style>
    /* Extra small helper for glass borders */
    .glass-border { border: 1px solid rgba(255,255,255,0.06); }
    /* Neon outline when focused */
    .neon-focus:focus { box-shadow: 0 0 18px rgba(120,120,255,0.14); outline: none; }
    /* Smooth transitions */
    .smooth { transition: all .22s cubic-bezier(.2,.9,.3,1); }
  </style>
</head>
<body class="antialiased bg-gradient-to-b from-neutral-900 via-neutral-900 to-neutral-950 text-slate-200 min-h-screen selection:bg-loom-500/60 selection:text-white">
  <!-- Root container -->
  <div id="app" class="min-h-screen flex">

    <!-- LEFT SIDEBAR -->
    <aside class="w-72 hidden md:flex flex-col gap-4 p-4 glass-border backdrop-blur-xs bg-gradient-to-b from-white/2 to-white/1/2 rounded-r-3xl">
      <div class="flex items-center gap-3 px-2">
        <div class="rounded-2xl flex items-center justify-center text-black font-bold">
            <img src="{{ asset('logo.svg') }}" alt="{{ config('app.name') }} Logo" class="w-8 h-8 inline-block mr-2" />
        </div>
        <div>
          <div class="text-sm font-semibold">Loom</div>
          <div class="text-xs text-slate-400">Plateforme de création</div>
        </div>
      </div>

      <nav class="mt-4 flex-1 px-2 space-y-1">
        <button class="w-full text-left flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white/3 smooth neon-focus"><svg class="w-5 h-5 opacity-80" viewBox="0 0 24 24" fill="none"><path d="M3 7h18M3 12h18M3 17h18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg> Dashboard</button>
        <button class="w-full text-left flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white/3 smooth neon-focus">Projects</button>
        <button class="w-full text-left flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white/3 smooth neon-focus">Templates</button>
        <button class="w-full text-left flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white/3 smooth neon-focus">Marketplace</button>
        <div class="mt-2 border-t border-white/3 pt-3 text-xs text-slate-400 px-3">Spaces</div>
        <button class="w-full text-left flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-white/3 smooth neon-focus">Team</button>
      </nav>

      <div class="px-3 pb-3">
        <div class="bg-gradient-to-br from-white/2 to-transparent p-3 rounded-2xl glass-border">
          <div class="text-xs text-slate-300">Bénéfices</div>
          <div class="text-sm font-semibold">+1.2k UI tokens</div>
        </div>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 lg:p-10">

      <!-- Topbar -->
      <header class="flex items-center justify-between gap-4 mb-6">
        <div class="flex items-center gap-4">
          <button id="menuBtn" class="md:hidden p-2 rounded-lg bg-white/3 neon-focus">☰</button>
          <div class="relative w-full max-w-2xl">
            <input id="globalsearch" class="w-full rounded-xl py-3 pl-4 pr-12 bg-white/4 placeholder:text-slate-400 neon-focus smooth" placeholder="Rechercher un projet, template, commande... (Ctrl+K)" />
            <kbd class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/6 px-2 py-1 rounded text-xs">Ctrl K</kbd>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <button id="themeToggle" class="p-2 rounded-lg bg-white/3 neon-focus smooth" aria-label="Toggle theme">🌗</button>
          <div class="relative">
            <button id="notif" class="p-2 rounded-lg bg-white/3 neon-focus smooth">🔔<span class="absolute -top-1 -right-1 text-xs bg-rose-500 text-white rounded-full w-5 h-5 grid place-items-center">3</span></button>
          </div>
          <div class="flex items-center gap-2 px-3 py-2 rounded-2xl bg-gradient-to-br from-white/3 to-transparent text-sm">
            <img src="https://i.pravatar.cc/40?u=loom" alt="avatar" class="w-8 h-8 rounded-full" />
            <div class="text-left">
              <div class="text-sm font-medium">Emmanuel</div>
              <div class="text-xs text-slate-400">Admin</div>
            </div>
          </div>
        </div>
      </header>

      <!-- Hero + Quick actions -->
      <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2 bg-gradient-to-br from-neutral-800/50 to-neutral-800/40 p-6 rounded-3xl glass-border relative overflow-hidden">
          <!-- Floating orbs -->
          <div class="pointer-events-none absolute -left-16 -top-16 w-72 h-72 rounded-full bg-loom-500/10 blur-3xl animate-float"></div>
          <div class="pointer-events-none absolute -right-24 top-8 w-44 h-44 rounded-full bg-loom-700/8 blur-2xl animate-float" style="animation-delay:1s"></div>

          <h1 class="text-3xl sm:text-4xl font-extrabold mb-2">La plateforme numérique<br class="hidden sm:block"/> de nouvelle génération</h1>
          <p class="text-slate-400 mb-4">Conçois, déploie et itère — tout depuis Loom. Templates, automatisations, et pipelines prêts à l'emploi.</p>

          <div class="flex gap-3 items-center">
            <button class="px-5 py-3 rounded-xl bg-loom-500 text-black font-semibold shadow-2xl hover:scale-105 transform smooth">Créer un projet</button>
            <button class="px-4 py-3 rounded-xl bg-white/6 text-slate-200 hover:bg-white/8 smooth">Parcourir templates</button>
            <button class="px-3 py-2 rounded-lg bg-transparent border border-white/6 text-sm text-slate-300">Importer</button>
          </div>

          <div class="mt-6 grid grid-cols-2 sm:grid-cols-4 gap-3">
            <div class="p-3 rounded-xl bg-white/3 glass-border">
              <div class="text-xs text-slate-300">Projets</div>
              <div class="text-lg font-semibold">24</div>
            </div>
            <div class="p-3 rounded-xl bg-white/3 glass-border">
              <div class="text-xs text-slate-300">Templates</div>
              <div class="text-lg font-semibold">12</div>
            </div>
            <div class="p-3 rounded-xl bg-white/3 glass-border">
              <div class="text-xs text-slate-300">Builds</div>
              <div class="text-lg font-semibold">97</div>
            </div>
            <div class="p-3 rounded-xl bg-white/3 glass-border">
              <div class="text-xs text-slate-300">Errors</div>
              <div class="text-lg font-semibold text-rose-400">1</div>
            </div>
          </div>
        </div>

        <!-- Quick cards -->
        <aside class="space-y-4">
          <div class="p-4 rounded-2xl glass-border bg-gradient-to-b from-white/2 to-transparent">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-xs text-slate-400">Pipeline</div>
                <div class="font-semibold">CI / CD actif</div>
              </div>
              <div class="text-sm text-slate-300">✓</div>
            </div>
            <div class="mt-3 text-xs text-slate-400">Dernier déploiement il y a 12 min</div>
          </div>

          <div class="p-4 rounded-2xl glass-border bg-gradient-to-b from-white/2 to-transparent">
            <div class="flex items-center justify-between">
              <div>
                <div class="text-xs text-slate-400">Notifications</div>
                <div class="font-semibold">3 non-lues</div>
              </div>
              <div class="text-sm text-slate-300">🔔</div>
            </div>
            <div class="mt-3 text-xs text-slate-400">Règles : 2 - Alertes : 1</div>
          </div>
        </aside>
      </section>

      <!-- Project grid -->
      <section>
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold">Projets récents</h2>
          <div class="text-sm text-slate-400">Afficher : <select class="bg-transparent border border-white/6 px-2 py-1 rounded ml-2">
            <option>All</option>
            <option>Actifs</option>
            <option>Templates</option>
          </select></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- project card -->
          <article class="p-5 rounded-2xl bg-gradient-to-br from-neutral-800/40 to-neutral-800/20 glass-border hover:scale-[1.02] transform smooth">
            <div class="flex items-start justify-between">
              <div>
                <div class="text-xs text-slate-400">Acme Corp</div>
                <h3 class="font-semibold">Site marketing</h3>
              </div>
              <div class="text-xs text-slate-300">staging</div>
            </div>
            <p class="mt-3 text-sm text-slate-400">Landing page moderne, animations et A/B tests.</p>
            <div class="mt-4 flex items-center justify-between">
              <div class="text-xs text-slate-400">Dernier build : 2h</div>
              <div class="flex items-center gap-2">
                <button class="px-3 py-1 rounded-lg bg-white/6 text-sm">Ouvrir</button>
                <button class="px-3 py-1 rounded-lg bg-transparent border border-white/6 text-sm">Logs</button>
              </div>
            </div>
          </article>

          <!-- duplicate for demo -->
          <article class="p-5 rounded-2xl bg-gradient-to-br from-neutral-800/40 to-neutral-800/20 glass-border hover:scale-[1.02] transform smooth">
            <div class="flex items-start justify-between">
              <div>
                <div class="text-xs text-slate-400">Studio</div>
                <h3 class="font-semibold">App SaaS</h3>
              </div>
              <div class="text-xs text-slate-300">production</div>
            </div>
            <p class="mt-3 text-sm text-slate-400">API, authentication, et analytics intégrés.</p>
            <div class="mt-4 flex items-center justify-between">
              <div class="text-xs text-slate-400">Dernier build : 5j</div>
              <div class="flex items-center gap-2">
                <button class="px-3 py-1 rounded-lg bg-white/6 text-sm">Ouvrir</button>
                <button class="px-3 py-1 rounded-lg bg-transparent border border-white/6 text-sm">Dashboard</button>
              </div>
            </div>
          </article>

          <article class="p-5 rounded-2xl bg-gradient-to-br from-neutral-800/40 to-neutral-800/20 glass-border hover:scale-[1.02] transform smooth">
            <div class="flex items-start justify-between">
              <div>
                <div class="text-xs text-slate-400">Voyage</div>
                <h3 class="font-semibold">Widget Booking</h3>
              </div>
              <div class="text-xs text-slate-300">dev</div>
            </div>
            <p class="mt-3 text-sm text-slate-400">Widget léger pour intégration dans sites tiers.</p>
            <div class="mt-4 flex items-center justify-between">
              <div class="text-xs text-slate-400">Dernier build : 3h</div>
              <div class="flex items-center gap-2">
                <button class="px-3 py-1 rounded-lg bg-white/6 text-sm">Ouvrir</button>
                <button class="px-3 py-1 rounded-lg bg-transparent border border-white/6 text-sm">Branch</button>
              </div>
            </div>
          </article>
        </div>
      </section>

      <!-- Footer small -->
      <footer class="mt-10 text-sm text-slate-500">© Loom — Prototype d'interface • Conçu pour être moderne & futuriste</footer>

      <!-- Floating FAB -->
      <button id="fab" class="fixed right-6 bottom-6 z-50 p-4 rounded-3xl bg-loom-500 text-black shadow-2xl hover:scale-105 smooth">＋</button>

    </main>
  </div>

  <!-- Command palette modal (simple) -->
  <div id="palette" class="fixed inset-0 hidden items-start justify-center pt-24 z-50">
    <div class="w-full max-w-2xl p-4 rounded-2xl bg-neutral-900/80 backdrop-blur glass-border">
      <input id="cmd" class="w-full p-4 rounded-lg bg-transparent border border-white/6 neon-focus" placeholder="Tapez une commande ou recherche..." />
      <div class="mt-3 grid gap-2">
        <div class="p-3 rounded-lg hover:bg-white/3 smooth">Open project “Acme Corp”</div>
        <div class="p-3 rounded-lg hover:bg-white/3 smooth">New template</div>
        <div class="p-3 rounded-lg hover:bg-white/3 smooth">Déployer sur staging</div>
      </div>
    </div>
  </div>

  <script>
    // Small interactive behaviors
    const palette = document.getElementById('palette');
    const cmdInput = document.getElementById('cmd');
    document.addEventListener('keydown', (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
        e.preventDefault();
        openPalette();
      }
      if (e.key === 'Escape') closePalette();
    });
    function openPalette(){ palette.classList.remove('hidden'); cmdInput.focus(); }
    function closePalette(){ palette.classList.add('hidden'); }

    // Theme toggle
    const themeToggle = document.getElementById('themeToggle');
    themeToggle.addEventListener('click', () => {
      document.documentElement.classList.toggle('dark');
    });

    // Mobile menu behavior
    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.querySelector('aside');
    menuBtn && menuBtn.addEventListener('click', () => sidebar.classList.toggle('hidden'));

    // FAB quick action
    document.getElementById('fab').addEventListener('click', () => openPalette());
  </script>
</body>
</html>
