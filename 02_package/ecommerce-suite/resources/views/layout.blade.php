<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Панель интернет-магазина' }}</title>
    <style>
        :root {
            color-scheme: light;
            --page: #f3f5f8;
            --panel: #ffffff;
            --text: #172033;
            --muted: #667085;
            --line: #dde3eb;
            --primary: #1f6feb;
            --primary-dark: #1557bb;
            --danger: #c43832;
            --success-bg: #e9f8ef;
            --success-line: #9fd7b4;
            --success-text: #17683b;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            background: var(--page);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
        }

        .app-shell {
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
            min-height: 100vh;
        }

        .sidebar {
            background: #111827;
            color: #fff;
            padding: 24px 18px;
        }

        .brand {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 24px;
        }

        .nav {
            display: grid;
            gap: 6px;
        }

        .nav a {
            color: #d5dce8;
            text-decoration: none;
            padding: 11px 12px;
            border-radius: 8px;
            font-weight: 600;
        }

        .nav a:hover {
            background: #1f2937;
            color: #fff;
        }

        .content {
            padding: 32px;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            font-size: 28px;
            line-height: 1.2;
        }

        .muted {
            color: var(--muted);
            margin: 8px 0 0;
        }

        .panel {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.06);
        }

        .panel-pad {
            padding: 22px;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 13px 14px;
            border-bottom: 1px solid var(--line);
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #f8fafc;
            color: #475467;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 9px 13px;
            border: 0;
            border-radius: 7px;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            font-size: 14px;
        }

        .btn:hover {
            background: var(--primary-dark);
        }

        .btn-light {
            background: #eef2f7;
            color: #243044;
        }

        .btn-light:hover {
            background: #dfe6ef;
        }

        .btn-danger {
            background: var(--danger);
        }

        .btn-danger:hover {
            background: #a92d28;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 18px;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
        }

        .card-name {
            color: var(--muted);
            font-weight: 700;
        }

        .card-value {
            font-size: 32px;
            font-weight: 800;
            margin-top: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 16px 18px;
        }

        label {
            display: block;
            color: #344054;
            font-weight: 700;
            margin-bottom: 7px;
        }

        input, textarea, select {
            width: 100%;
            min-height: 42px;
            padding: 10px 12px;
            border: 1px solid #cfd8e3;
            border-radius: 7px;
            background: #fff;
            color: var(--text);
            font: inherit;
        }

        input:focus, textarea:focus, select:focus {
            outline: 3px solid rgba(31, 111, 235, 0.16);
            border-color: var(--primary);
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 8px;
            background: var(--success-bg);
            border: 1px solid var(--success-line);
            color: var(--success-text);
            font-weight: 700;
        }

        .error {
            color: var(--danger);
            margin: 6px 0 0;
            font-weight: 700;
        }

        .pagination {
            margin-top: 16px;
        }

        @media (max-width: 820px) {
            .app-shell { grid-template-columns: 1fr; }
            .sidebar { padding: 18px; }
            .nav { grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); }
            .content { padding: 20px; }
            .page-head { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand">Интернет-магазин</div>
        <nav class="nav">
            <a href="{{ route('ecommerce-suite.dashboard') }}">Главная</a>
            <a href="{{ route('ecommerce-suite.products.index') }}">Товары</a>
            <a href="{{ route('ecommerce-suite.categories.index') }}">Категории</a>
            <a href="{{ route('ecommerce-suite.suppliers.index') }}">Поставщики</a>
            <a href="{{ route('ecommerce-suite.customers.index') }}">Клиенты</a>
            <a href="{{ route('ecommerce-suite.warehouses.index') }}">Склады</a>
            <a href="{{ route('ecommerce-suite.orders.index') }}">Заказы</a>
        </nav>
    </aside>
    <div class="content">
        <main>
            @if(session('status'))
                <div class="alert">{{ session('status') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
