<!DOCTYPE html>
<html lang="en">

<head>
	<title>JTLearning Perum Jasa Tirta I</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Edutirta Learning & Knowledge Management System Perum Jasa Tirta I">
	<script>
	const storedTheme = localStorage.getItem('theme')
	const getPreferredTheme = () => {
		if(storedTheme) {
			return storedTheme
		}
		return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
	}
	const setTheme = function(theme) {
		if(theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
			document.documentElement.setAttribute('data-bs-theme', 'dark')
		} else {
			document.documentElement.setAttribute('data-bs-theme', theme)
		}
	}
	setTheme(getPreferredTheme())
	window.addEventListener('DOMContentLoaded', () => {
		var el = document.querySelector('.theme-icon-active');
		if(el != 'undefined' && el != null) {
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
				if(storedTheme !== 'light' || storedTheme !== 'dark') {
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
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/choices/css/choices.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/stepper/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/aos/aos.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/plyr/plyr.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}"></head>

	{{-- Datatables --}}
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

	@livewireStyles

<body>
    
	<header class="navbar-light navbar-sticky">
		@include('layouts-landing.nav')
	</header>
	<main>
        <section class="pt-0">
            <div class="container">
                <div class="row">
                    @yield('content-landing')
				</div>
			</div>
		</section>
	</main>
    @include('layouts-landing.footer')



<div class="back-top "><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle "></i></div>


@livewireScripts
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- Include DataTables with defer attribute -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" defer></script>

<!-- Other scripts -->
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/choices/js/choices.min.js') }}"></script>
<script src="{{ asset('assets/vendor/purecounterjs/dist/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/sticky-js/sticky.min.js') }}"></script>
<script src="{{ asset('assets/vendor/stepper/js/bs-stepper.min.js') }} "></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/plyr/plyr.js')}}"></script>
<script src="{{ asset('assets/js/functions.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>

<!-- DataTables initialization script -->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@yield('script')
@stack('script')

</body>


</html>