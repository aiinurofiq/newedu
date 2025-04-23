<!DOCTYPE html>
<html lang="en">

<head>
    <title>JT-LK Perum Jasa Tirta I</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Webestica.com">
    <meta name="description" content="Edutirta Learning & Knowledge Management System Perum Jasa Tirta I">
    <script>
        const storedTheme = localStorage.getItem('theme')
        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
        }
        const setTheme = function(theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }
        setTheme(getPreferredTheme())
        window.addEventListener('DOMContentLoaded', () => {
            var el = document.querySelector('.theme-icon-active');
            if (el != 'undefined' && el != null) {
                const showActiveTheme = theme => {
                    const activeThemeIcon = document.querySelector('.theme-icon-active use')
                    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                    const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')
                    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                        element.classList.remove('active')
                    })
                    btnToActive.classList.add('active')
                    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                }
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    if (storedTheme !== 'light' || storedTheme !== 'dark') {
                        setTheme(getPreferredTheme())
                    }
                })
                showActiveTheme(getPreferredTheme())
                document.querySelectorAll('[data-bs-theme-value]').forEach(toggle => {
                    toggle.addEventListener('click', () => {
                        const theme = toggle.getAttribute('data-bs-theme-value')
                        localStorage.setItem('theme', theme)
                        setTheme(theme)
                        showActiveTheme(theme)
                    })
                })
            }
        })
    </script>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsadmin/vendor/libs/sweetalert2/sweetalert2.css') }}" />
</head>

<body>
    <main>
        <section class="p-0 d-flex align-items-center position-relative overflow-hidden">
            <div class="container-fluid">
                <div class="row">
                    <div
                        class="col-12 col-lg-6 d-md-flex align-items-center justify-content-center bg-primary bg-opacity-10 vh-lg-100">
                        <div class="p-3 p-lg-5">
                            <div class="text-center">
                                <h2 class="fw-bold">Welcome to JT-LK community</h2>
                                <p class="mb-0 h6 fw-light">Let's learn something new today!</p>
                            </div> <img src="{{ asset('assets/images/element/02.svg') }}" class="mt-5" alt="">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 m-auto">
                        <div class="row my-5">
                            <div class="col-sm-10 col-xl-8 m-auto"> <span class="mb-0 fs-1">👋</span>
                                <h1 class="fs-2">Login into JT-LK!</h1>
                                <p class="lead mb-4">Nice to see you! Please log in with your account.</p>
                                <form method="POST" action="{{ route('loginpegawai') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="exampleInputEmail1" class="form-label">Kopeg *</label>
                                        <div class="input-group input-group-lg"> <span
                                                class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                                    class="bi bi-envelope-fill"></i></span>
                                            <input id="email" type="text"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="inputPassword5" class="form-label">Password *</label>
                                        <div class="input-group input-group-lg"> <span
                                                class="input-group-text bg-light rounded-start border-0 text-secondary px-3"><i
                                                    class="fas fa-lock"></i></span>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">
                                        </div>
                                        <div id="passwordHelpBlock" class="form-text"> Your password must be 8
                                            characters at least </div>
                                    </div>
                                    <div class="mb-4 d-flex justify-content-between mb-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1" type="checkbox"
                                                name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>Remember me</label>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <div class="text-primary-hover d-none">
                                                <a href="{{ route('password.request') }}" class="text-secondary">
                                                    <u>Forgot password?</u> </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="align-items-center mt-0">
                                        <div class="d-grid">
                                            <button class="btn btn-primary mb-0" type="submit">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i></div>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    <script src="{{ asset('assetsadmin/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script>
        @if (session()->has('error'))
            Swal.fire({
                title: 'Username atau Password Salah',
                text: 'Silahkan login kembali',
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        @endif
    </script>
</body>

</html>
