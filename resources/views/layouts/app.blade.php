<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <div id="app" class="mt-0 pt-0">
        @include('includes.navbar')

        <main class="mt-0 pt-0">
            <div class="mt-0 pt-0">
                @yield('page-header')
            </div>
            <div class="container mt-0 pt-0">
                @include('includes.message')
                @yield('content')
            </div>
        </main>
        @include('includes.footer')
    </div>
    @include('includes.scripts')
</body>
</html>
