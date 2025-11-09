<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Footlock QC - Audit System')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        .paper-card {
            max-width: 21cm; /* A4 width */
            margin: 0 auto;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 2.5rem;
        }
        .header-section {
            border-bottom: 3px solid #667eea;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        .section-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .form-control, .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.75rem;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .badge-aspect-visual {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            color: white;
        }
        .badge-aspect-dimensional {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            color: white;
        }
        .badge-aspect-packaging {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            color: white;
        }
        .table {
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .table thead th {
            background: #f3f4f6;
            font-weight: 600;
            border-bottom: 2px solid #e5e7eb;
            padding: 0.75rem;
        }
        .table tbody tr:hover {
            background-color: #f9fafb;
        }
        .table tbody td {
            padding: 0.75rem;
        }
        .form-check-input {
            width: 1.25rem;
            height: 1.25rem;
            cursor: pointer;
        }
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 1rem 2rem;
            font-weight: 600;
            border-radius: 0.5rem;
            width: 100%;
            color: white;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .toggle-view-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: white;
            border: 2px solid #667eea;
            color: #667eea;
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            font-weight: 600;
            z-index: 1000;
        }
        .toggle-view-btn:hover {
            background: #667eea;
            color: white;
        }
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .toggle-view-btn, .btn-submit {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <!-- Toggle View Button -->
    <a href="{{ route('audits.index') }}" class="toggle-view-btn">
        <i class="bi bi-layout-sidebar"></i> View Full System
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    @stack('scripts')
</body>
</html>
