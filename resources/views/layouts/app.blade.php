<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'masyarakatpeduli') }}</title>

    @include('layouts.head')

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <div class="dot-spinner">
                <div class="dot-spinner__dot"></div>
                <div class="dot-spinner__dot"></div>
                <div class="dot-spinner__dot"></div>
                <div class="dot-spinner__dot"></div>
                <div class="dot-spinner__dot"></div>
                <div class="dot-spinner__dot"></div>
                <div class="dot-spinner__dot"></div>
                <div class="dot-spinner__dot"></div>
            </div>
        </div>
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Main Sidebar Container -->
        {{-- @include('layouts.sidebar') --}}
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @include('layouts.footer-script')
</body>

</html>
