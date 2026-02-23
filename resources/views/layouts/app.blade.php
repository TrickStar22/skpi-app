<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SKPI - Prestasi Mahasiswa')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container { max-width: 1400px; margin: 0 auto; }
        .header { text-align: center; color: white; margin-bottom: 30px; }
        .header h1 { font-size: 2.5em; }
        .btn-logout {
            position: absolute; top: 20px; right: 20px;
            padding: 10px 20px; background: #dc3545; color: white;
            border: none; border-radius: 5px; cursor: pointer;
            text-decoration: none;
        }
        .welcome-banner {
            background: white; border-radius: 10px; padding: 20px;
            margin-bottom: 20px; display: flex; align-items: center;
        }
        .user-avatar {
            width: 50px; height: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; color: white; font-size: 24px;
            margin-right: 15px;
        }
        .alert {
            padding: 15px; border-radius: 8px; margin-bottom: 20px;
        }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
        .btn {
            padding: 10px 20px; border: none; border-radius: 5px;
            cursor: pointer; font-size: 1em;
        }
        .btn-primary { background: #764ba2; color: white; }
        .form-container {
            background: white; border-radius: 15px; padding: 30px;
            margin-bottom: 30px;
        }
        .form-title {
            color: #764ba2; margin-bottom: 20px;
            border-bottom: 2px solid #764ba2; padding-bottom: 10px;
        }
        .form-group { margin-bottom: 15px; }
        .form-group label {
            display: block; margin-bottom: 5px; font-weight: 600;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 10px; border: 1px solid #ddd;
            border-radius: 5px;
        }
        .table-container {
            background: white; border-radius: 15px; padding: 20px;
            overflow-x: auto;
        }
        table { width: 100%; border-collapse: collapse; }
        th { background: #764ba2; color: white; padding: 12px; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .status-badge {
            padding: 5px 10px; border-radius: 15px; font-size: 0.85em;
        }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-verified { background: #d4edda; color: #155724; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container">
        @auth
            <a href="#" class="btn-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                🚪 Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endauth

        <div class="header">
            <h1>🎓 SKPI - Prestasi Mahasiswa</h1>
            <p>Sistem Informasi Prestasi dan Pendamping Ijazah</p>
        </div>

        @auth
            <div class="welcome-banner">
                <div class="user-avatar">
                    {{ Auth::user()->isDosen() ? '👨‍🏫' : '👨‍🎓' }}
                </div>
                <div>
                    <h3>{{ Auth::user()->name }}</h3>
                    <p>
                        @if(Auth::user()->isDosen())
                            Dosen - {{ Auth::user()->nidn }}
                        @else
                            Mahasiswa - {{ Auth::user()->prodi }} ({{ Auth::user()->nim }})
                        @endif
                    </p>
                </div>
            </div>
        @endauth

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>