<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@include('frontEnd.layouts.head')
	<body class="d-flex flex-column min-vh-100">
        <input type="hidden" id="isVerify" value="{{Auth::guard('student')->user()?->isVerify}}">
		@include('frontEnd.layouts.navbar')
		<main id="main" class="main">
			@yield('content')
        </main>

		@include('frontEnd.layouts.footer')
		@include('frontEnd.layouts.script')
	</body>
</html>
