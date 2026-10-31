<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'StudySpace')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --background: #111318;
            --surface: #1B1E25;
            --surface-hover: #222630;
            --text: #F5F5F7;
            --muted: #9298A5;
            --accent: #6C9BFF;
            --border: #2B303B;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--text);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* Navigation */

        .navbar {
            background: rgba(17,19,24,.94);
            border-bottom: 1px solid var(--border);
            padding: 21px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            color: var(--text);
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -1px;
            text-decoration: none;
        }

        .brand span {
            color: var(--accent);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: .2s;
        }

        .nav-links a:hover {
            color: var(--text);
        }

        .nav-user {
            color: var(--muted);
            font-size: 13px;
        }

        .role-label {
            color: var(--accent);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            background: #202B40;
            padding: 6px 9px;
            border-radius: 5px;
        }

        /* Main Content */

        .main-container {
            max-width: 1180px;
            margin: 48px auto;
            padding: 0 28px;
            min-height: 65vh;
        }

        .page-heading {
            margin-bottom: 30px;
        }

        .page-heading h1 {
            font-size: 34px;
            font-weight: 700;
            letter-spacing: -1.3px;
            margin-bottom: 10px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        /* Cards */

        .card {
            background: var(--surface);
            padding: 28px;
            border: 1px solid var(--border);
            border-radius: 14px;
            margin-bottom: 20px;
        }

        /* Buttons */

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            background: var(--accent);
            color: #101827;
            padding: 12px 19px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn:hover {
            background: #8BB0FF;
        }

        .btn-light {
            background: #292E38;
            color: var(--text);
        }

        .btn-light:hover {
            background: #363D49;
        }

        /* Forms */

        input, select, textarea {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: #151820;
            color: var(--text);
            font-family: inherit;
            font-size: 14px;
            margin-top: 8px;
            outline: none;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--accent);
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #D7DAE2;
            margin-top: 20px;
        }

        /* Messages */

        .success-message {
            background: #183327;
            color: #83D9A8;
            border: 1px solid #28543C;
            padding: 14px 17px;
            border-radius: 9px;
            margin-bottom: 24px;
            font-size: 13px;
        }

        .error-message {
            color: #FF8585;
            font-size: 12px;
            margin-top: 7px;
        }

        /* Footer */

        .footer {
            border-top: 1px solid var(--border);
            color: #737987;
            text-align: center;
            padding: 25px 20px;
            font-size: 12px;
            margin-top: 70px;
        }

        /* Responsive */

        @media(max-width: 600px) {
            .navbar {
                padding: 17px 5%;
            }

            .nav-links {
                gap: 17px;
            }

            .main-container {
                margin-top: 30px;
                padding: 0 17px;
            }

            .page-heading h1 {
                font-size: 27px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar">

        <a href="/" class="brand">
            studyspace<span>.</span>
        </a>

        <div class="nav-links">

            <a href="/">Home</a>
            <a href="/courses">Courses</a>
            <a href="/materials">Study Materials</a>

            @guest

                <a href="/login">Login</a>
                <a href="/register">Sign Up</a>

            @else

                <a href="/feedback/create">Feedback</a>

                @if(Auth::user()->role === 'admin')
                    <a href="/feedback">Manage Feedback</a>
                @endif

                <span class="nav-user">
                    Hi, {{ Auth::user()->name }}
                </span>

                <span class="role-label">
                    {{ Auth::user()->role }}
                </span>

                <form action="/logout" method="POST" style="display: inline;">
                    @csrf

                    <button type="submit" class="btn btn-light"
                            style="padding: 9px 14px;">
                        Logout
                    </button>
                </form>

            @endguest

        </div>

    </nav>

    <!-- Main Content -->
    <main class="main-container">

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>

    <!-- Footer -->
    <footer class="footer">
        © {{ date('Y') }} StudySpace. Designed for better learning.
    </footer>

</body>
</html>
