<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Suivi Étudiant - Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('graduation-cap-solid.svg') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        :root {
            --primary: #00d2ff;
            --bg-dark: #0f172a;
            --sidebar-bg: rgba(255, 255, 255, 0.03);
            --danger: #ff4d4d;
            --text-color: #e2e8f0;
            --text-muted: #94a3b8;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 280px;
            height: 100vh;
            background: var(--sidebar-bg);
            backdrop-filter: blur(25px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            position: fixed;
            transition: var(--transition);
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 85px;
        }

        .sidebar-header {
            padding: 30px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar-header i {
            font-size: 1.8rem;
            color: var(--primary);
            filter: drop-shadow(0 0 8px var(--primary));
            min-width: 45px;
            text-align: center;
        }

        .logo-text {
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            white-space: nowrap;
            transition: var(--transition);
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            pointer-events: none;
        }

        .sidebar-nav {
            flex: 1;
            padding: 20px 15px;
        }

        .nav-list {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        /* LIEN DE NAVIGATION */
        .nav-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 15px;
            text-decoration: none;
            color: var(--text-muted);
            border-radius: 12px;
            transition: var(--transition);
            white-space: nowrap;
            position: relative;
            /* Nécessaire pour positionner l'indicateur */
        }

        .nav-link i {
            min-width: 25px;
            font-size: 1.2rem;
            text-align: center;
        }

        /* EFFET AU SURVOL ET ACTIF */
        .nav-link:hover,
        .nav-link.active {
            background: rgba(0, 210, 255, 0.1);
            color: var(--primary);
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(0, 210, 255, 0.1);
            color: var(--primary);
        }

        .nav-link.active {
            font-weight: 600;
            box-shadow: inset 4px 0 0 var(--primary);
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
        }

        /* FOOTER */
        .sidebar-footer {
            padding: 20px 15px;
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 12px;
            overflow: hidden;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), #0080ff);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-weight: bold;
            min-width: 40px;
        }

        .user-info {
            transition: var(--transition);
            white-space: nowrap;
        }

        .user-name {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .logout-btn {
            color: var(--text-muted);
            background: none;
            border: none;
            font-size: 1.1rem;
            padding: 8px;
            border-radius: 8px;
            transition: 0.3s;
            cursor: pointer;
        }

        .logout-btn:hover {
            color: var(--danger);
            background: rgba(255, 77, 77, 0.1);
            transform: scale(1.1);
        }

        .sidebar.collapsed .user-info {
            display: none;
        }

        .sidebar.collapsed .sidebar-footer {
            justify-content: center;
            flex-direction: column;
            gap: 15px;
        }

        /* CONTENU */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 40px;
            transition: var(--transition);
        }

        .main-content.expanded {
            margin-left: 85px;
        }

        .toggle-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 30px;
        }

        /* --- PROGRESS BAR --- */
        #top-progress-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: var(--primary);
            box-shadow: 0 0 10px var(--primary);
            z-index: 9999;
            transition: width 0.4s ease, opacity 0.3s ease;
            pointer-events: none;
        }

        .progress-fade-out {
            opacity: 0;
        }

        /* --- DASHBOARD GRID & CARDS --- */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--sidebar-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 25px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.06);
        }

        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: rgba(0, 210, 255, 0.1);
            color: var(--primary);
        }

        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .stat-info p {
            color: var(--text-muted);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- CHART SECTION --- */
        .chart-container {
            background: var(--sidebar-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 20px;
            max-width: 250px;
        }

        .chart-container h2 {
            font-size: 1.1rem;
            margin-bottom: 20px;
            color: var(--text-color);
        }

        .secondary-charts {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .chart-box {
            background: var(--sidebar-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 20px;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-graduation-cap"></i>
            <span class="logo-text">Suivi Étudiant</span>
        </div>

        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="/Dashboard" @class([
                        'nav-link',
                        'active' => request()->is('Dashboard') || request()->is('/'),
                    ])>
                        <i class="fas fa-chart-pie"></i>
                        <span class="nav-text">Tableau de bord</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('etudiants.index') }}" @class(['nav-link', 'active' => request()->is('etudiants*')])>
                        <i class="fas fa-user-graduate"></i>
                        <span class="nav-text">Étudiant</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/annees" @class(['nav-link', 'active' => request()->is('annees*')])>
                        <i class="fas fa-calendar-alt"></i>
                        <span class="nav-text">Année</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('diplomes.index') }}" @class(['nav-link', 'active' => request()->is('diplomes*')])>
                        <i class="fas fa-certificate"></i>
                        <span class="nav-text">Diplôme</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('obtenirs.index') }}" @class(['nav-link', 'active' => request()->is('obtenirs*')])>
                        <i class="fas fa-award"></i>
                        <span class="nav-text">Obtention Diplôme</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="sidebar-footer">
            <div class="user-section">
                <div class="avatar">{{ Auth::user()->initials }}</div>
                <div class="user-info">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">{{ Auth::user()->email }}</span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-power-off"></i>
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENU PRINCIPAL -->
    <main class="main-content" id="main-content">
        <button class="toggle-btn" id="toggle-btn">
            <i class="fas fa-bars"></i>
        </button>

        <!-- CARDS -->
        <div class="dashboard-grid">
            <div class="stat-card">
                <div class="icon-box"><i class="fas fa-users"></i></div>
                <div class="stat-info">
                    <h3>{{ $totalEtudiants ?? 0 }}</h3>
                    <p>Total Étudiants</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="icon-box" style="color: #2ed573; background: rgba(46, 213, 115, 0.1);">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalBACC ?? 0 }}</h3>
                    <p>Diplômés BACC</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="icon-box" style="color: #ffa502; background: rgba(255, 165, 2, 0.1);">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalBEPC ?? 0 }}</h3>
                    <p>Diplômés BEPC</p>
                </div>
            </div>
        </div>

        <!-- CHART PIE -->
        <div class="secondary-charts">
            <!-- Évolution -->
            <div class="chart-box">
                <h3>Évolution des Diplômes</h3>
                <canvas id="evolutionChart"></canvas>
            </div>

            <!-- Mentions -->
            <div class="chart-box">
                <h3>Répartition des Mentions</h3>
                <canvas id="mentionChart"></canvas>
            </div>
        </div>
        <br>
        <div class="chart-container">
            <h2>Répartition par Sexe</h2>
            <canvas id="genderChart"></canvas>
        </div>

    </main>

    <script type="module">
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('toggle-btn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // Chart.js logic
        const ctx = document.getElementById('genderChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Masculin', 'Féminin'],
                datasets: [{
                    data: [{{ $homme }}, {{ $femme }}],
                    backgroundColor: ['#00d2ff', '#ff4d4d'],
                    borderColor: 'transparent',
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#94a3b8'
                        }
                    }
                },
                cutout: '70%'
            }
        });

        // --- CHART 1 : EVOLUTION ANNUELLE ---
        const evolutionCtx = document.getElementById('evolutionChart').getContext('2d');
        new Chart(evolutionCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($evolutionData->pluck('year')) !!},
                datasets: [{
                    label: 'Diplômes délivrés',
                    data: {!! json_encode($evolutionData->pluck('total')) !!},
                    borderColor: '#00d2ff',
                    backgroundColor: 'rgba(0, 210, 255, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // --- CHART 2 : MENTIONS ---
        const mentionCtx = document.getElementById('mentionChart').getContext('2d');
        new Chart(mentionCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($mentionsData->pluck('mention')) !!},
                datasets: [{
                    label: 'Nombre d\'étudiants',
                    data: {!! json_encode($mentionsData->pluck('total')) !!},
                    backgroundColor: ['#2ed573', '#ffa502', '#00d2ff', '#ff4d4d'],
                    borderRadius: 8
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
