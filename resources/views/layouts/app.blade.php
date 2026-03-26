<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Suivi Étudiant - Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('graduation-cap-solid.svg') }}">
    {{-- <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <script src="{{asset('js/all.min.js')}}"></script> --}}
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

        /* Logo */
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

        /* Menu */
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
        }

        .nav-link i {
            min-width: 25px;
            font-size: 1.2rem;
            text-align: center;
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

        /* --- FOOTER (Profil + Déconnexion) --- */
        .sidebar-footer {
            padding: 20px 15px;
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: space-between;
            /* Aligne le bouton à droite */
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
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* --- CONTENU --- */
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

        .welcome-card {
            background: var(--sidebar-bg);
            padding: 30px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* --- STYLES AJOUTÉS POUR LE TABLEAU ET MODAL --- */
        .action-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-add {
            background: var(--primary);
            color: #000;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .btn-add:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .table-container {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 15px;
            color: var(--text-muted);
            font-weight: 500;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.9rem;
        }

        .btn-edit {
            color: var(--primary);
            margin-right: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-delete {
            color: var(--danger);
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            transform: scale(1.2);
        }

        /* MODAL STYLES */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #1e293b;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .modal-header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            color: var(--primary);
            font-size: 1.5rem;
        }

        .close-modal {
            color: var(--text-muted);
            cursor: pointer;
            font-size: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group.full {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--primary);
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: #000;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        /* --- TABLEAU --- */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-add {
            background: var(--primary);
            color: #0f172a;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 210, 255, 0.4);
        }

        .table-wrapper {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: var(--text-color);
        }

        th {
            text-align: left;
            padding: 15px;
            color: var(--text-muted);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .actions {
            display: flex;
            gap: 15px;
        }

        .btn-icon {
            cursor: pointer;
            font-size: 1.1rem;
            transition: 0.2s;
        }

        .btn-edit {
            color: var(--primary);
        }

        .btn-delete {
            color: var(--danger);
        }

        .btn-icon:hover {
            transform: scale(1.2);
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: #1e293b;
            padding: 30px;
            border-radius: 20px;
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }

        .modal-header {
            margin-bottom: 25px;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            color: var(--primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            outline: none;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-cancel {
            background: transparent;
            border: 1px solid var(--text-muted);
            color: var(--text-muted);
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-save {
            background: var(--primary);
            border: none;
            color: #000;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        /* --- STYLES TABLEAU ET BOUTONS --- */
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-add {
            background: var(--primary);
            color: #0f172a;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(0, 210, 255, 0.4);
        }

        .table-container {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            color: var(--text-muted);
            padding: 15px;
            font-weight: 600;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .action-icons {
            display: flex;
            gap: 15px;
        }

        .action-icons i {
            cursor: pointer;
            font-size: 1.1rem;
            transition: 0.2s;
        }

        .fa-edit {
            color: var(--primary);
        }

        .fa-trash {
            color: var(--danger);
        }

        .action-icons i:hover {
            transform: scale(1.2);
        }

        /* --- STYLES MODAL --- */
        .modal {
            display: none;
            position: fixed;
            z-index: 1100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #1e293b;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            color: var(--primary);
        }

        .close-modal {
            color: var(--text-muted);
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: white;
            outline: none;
        }

        .form-group input:focus {
            border-color: var(--primary);

            .header-flex {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .btn-add {
                background: var(--primary);
                color: #000;
                border: none;
                padding: 10px 20px;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: var(--transition);
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .btn-add:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 210, 255, 0.3);
            }

            /* --- TABLEAU --- */
            .table-container {
                background: var(--sidebar-bg);
                border-radius: 20px;
                border: 1px solid rgba(255, 255, 255, 0.05);
                overflow: hidden;
                width: 100%;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
            }

            th,
            td {
                padding: 15px 20px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            th {
                color: var(--text-muted);
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.8rem;
                letter-spacing: 1px;
            }

            /* --- STYLES BADGES MENTION (NOUVEAU) --- */
            .badge-mention {
                padding: 5px 12px;
                border-radius: 6px;
                font-size: 0.75rem;
                font-weight: 700;
                display: inline-block;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .m-passable {
                background: rgba(148, 163, 184, 0.15);
                color: var(--mnt-passable);
                border: 1px solid rgba(148, 163, 184, 0.2);
            }

            .m-assez-bien {
                background: rgba(255, 193, 7, 0.15);
                color: var(--mnt-assez-bien);
                border: 1px solid rgba(255, 193, 7, 0.2);
            }

            .m-bien {
                background: rgba(0, 210, 255, 0.15);
                color: var(--mnt-bien);
                border: 1px solid rgba(0, 210, 255, 0.2);
            }

            .m-tres-bien {
                background: rgba(34, 197, 94, 0.15);
                color: var(--mnt-tres-bien);
                border: 1px solid rgba(34, 197, 94, 0.2);
            }

            .m-excellent {
                background: rgba(168, 85, 247, 0.15);
                color: var(--mnt-excellent);
                border: 1px solid rgba(168, 85, 247, 0.2);
            }

            .action-icons {
                display: flex;
                gap: 15px;
            }

            .action-icons i {
                cursor: pointer;
                transition: 0.2s;
            }

            .fa-edit {
                color: var(--primary);
            }

            .fa-trash {
                color: var(--danger);
            }

            .action-icons i:hover {
                transform: scale(1.2);
            }

            /* MODAL (INCHANGÉ) */
            .modal {
                display: none;
                position: fixed;
                z-index: 2000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                backdrop-filter: blur(5px);
                align-items: center;
                justify-content: center;
            }

            .modal-content {
                background: var(--bg-dark);
                border: 1px solid rgba(255, 255, 255, 0.1);
                padding: 30px;
                border-radius: 20px;
                width: 450px;
                position: relative;
            }

            .modal-header {
                margin-bottom: 20px;
                font-size: 1.2rem;
                font-weight: 700;
                color: var(--primary);
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                color: var(--text-muted);
                font-size: 0.9rem;
            }

            .form-group input,
            .form-group select {
                width: 100%;
                padding: 10px;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 8px;
                color: white;
                outline: none;
            }

            .form-group input:focus,
            .form-group select:focus {
                border-color: var(--primary);
            }

            .btn-save {
                width: 100%;
                padding: 12px;
                background: var(--primary);
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                margin-top: 10px;
            }

            .close-btn {
                position: absolute;
                top: 20px;
                right: 20px;
                cursor: pointer;
                color: var(--text-muted);
            }
        }

        .btn-submit {
            width: 100%;
            background: var(--primary);
            color: #0f172a;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
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


        select {
            background-color: #1a1a2e;
            color: white;
            border: 1px solid #333;
        }

        select option {
            background-color: #1a1a2e;
            color: white;
            padding: 10px;
        }

        .filters-section {
            background: var(--sidebar-bg);
            padding: 30px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .filter-group select {
            min-width: 150px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            outline: none;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
        }

        /* Styles pour les Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .stat-card {
            background: var(--sidebar-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .bg-blue {
            background: rgba(0, 210, 255, 0.2);
            color: var(--primary);
        }

        .bg-green {
            background: rgba(46, 213, 115, 0.2);
            color: #2ed573;
        }

        .bg-orange {
            background: rgba(255, 165, 2, 0.2);
            color: #ffa502;
        }

        .stat-info h3 {
            font-size: 1.8rem;
            margin-bottom: 2px;
        }

        .stat-info p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Style du Chart */
        .chart-container {
            margin-top: 30px;
            background: var(--sidebar-bg);
            padding: 20px;
            border-radius: 15px;
            max-width: 500px;
        }

        /* --- STYLES DES ALERTES --- */
        .alert {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            position: relative;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideIn 0.5s ease-out;
            gap: 15px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            /* Vert transparent */
            border-left: 5px solid #10b981;
            color: #10b981;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            /* Rouge transparent */
            border-left: 5px solid #ef4444;
            color: #ef4444;
        }

        .alert-icon {
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .alert-content {
            flex: 1;
        }

        .alert-content strong {
            display: block;
            font-size: 0.95rem;
            margin-bottom: 2px;
        }

        .alert-content p,
        .alert-content ul {
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1.2;
            display: inline-block;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .alert-content ul {
            padding-left: 20px;
        }

        .alert-close {
            background: none;
            border: none;
            color: currentColor;
            cursor: pointer;
            opacity: 0.5;
            transition: 0.3s;
            padding: 5px;
        }

        .alert-close:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .alert-content p strong {
            display: inline !important;
            font-weight: 1000;
            color: inherit;
        }

        .btn-filter-resete {
            background-color: var(--sidebar-bg);
            color: #fff;
            border-radius: 8px;

        }

        <style>

        /* --- PAGINATION CUSTOM (Indispensable pour le thème sombre) --- */
        .pagination-container {
            margin-top: 25px;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            border-radius: 10px;
            overflow: hidden;
            gap: 5px;
        }

        .page-link {
            background: #1e293b;
            /* Couleur de votre sidebar/carte */
            color: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 18px;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            display: block;
        }

        .page-item.active .page-link {
            background: var(--primary) !important;
            /* Votre couleur jaune/dorée */
            color: #000 !important;
            font-weight: bold;
        }

        .page-item.disabled .page-link {
            background: rgba(255, 255, 255, 0.02);
            color: #444;
        }

        /* Masquer le texte "Showing 1 to 5 of 20 results" qui casse souvent le layout */
        .pagination-container nav div:first-child {
            display: none;
        }
    </style>

    </style>
    </style>
    @stack('styles')
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-graduation-cap" style="color: #00d2ff;"></i>
            <span class="logo-text" style="color: #00d2ff;">Suivi Étudiant</span>
        </div>

        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="/Dashboard" @class(['nav-link', 'active' => request()->is('/')])>
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

        <!-- FOOTER : Profil + Logout -->
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

        @yield('content')
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('toggle-btn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // Initialisation de la barre de progression
        const progressBar = document.createElement('div');
        progressBar.id = 'top-progress-bar';
        document.body.prepend(progressBar);

        const Progress = {
            timer: null,
            start() {
                progressBar.classList.remove('progress-fade-out');
                progressBar.style.width = '0%';
                setTimeout(() => progressBar.style.width = '30%', 50);

                // Simulation d'une progression lente
                this.timer = setInterval(() => {
                    let currentWidth = parseFloat(progressBar.style.width);
                    if (currentWidth < 90) {
                        progressBar.style.width = (currentWidth + Math.random() * 5) + '%';
                    }
                }, 400);
            },
            finish() {
                clearInterval(this.timer);
                progressBar.style.width = '100%';
                setTimeout(() => {
                    progressBar.classList.add('progress-fade-out');
                    setTimeout(() => progressBar.style.width = '0%', 300);
                }, 200);
            }
        };

        // Déclencher sur les clics de liens (pour la navigation classique)
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                if (!link.hash && link.hostname === window.location.hostname && !e.ctrlKey && !e.shiftKey) {
                    Progress.start();
                }
            });
        });

        // Déclencher automatiquement pour Livewire (si vous l'utilisez)
        document.addEventListener('livewire:init', () => {
            Livewire.hook('request', ({
                next
            }) => {
                Progress.start();
                next((response) => {
                    Progress.finish();
                });
            });
        });

        // Finir le chargement quand la page est prête
        window.addEventListener('load', () => Progress.finish());
    </script>
</body>

</html>
