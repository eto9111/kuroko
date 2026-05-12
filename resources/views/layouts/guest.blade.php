<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <!-- Custom Theme Styles -->
        <style>
            body { background-color: #F3F8FF !important; }
            .min-h-screen.bg-gray-100 { background-color: #F3F8FF !important; }
            .bg-white { box-shadow: 0 10px 25px rgba(31, 41, 55, 0.05) !important; border: 1px solid #E5E7EB !important; border-radius: 15px !important; }
            button[type="submit"] { background-color: #2563EB !important; color: #FFFFFF !important; font-weight: bold !important; border-radius: 8px !important; transition: all 0.3s ease !important; }
            button[type="submit"]:hover { background-color: #1E3A8A !important; transform: scale(1.02) !important; }
            input[type="email"], input[type="password"], input[type="text"] { border: 1px solid #E5E7EB !important; border-radius: 8px !important; }
            input[type="email"]:focus, input[type="password"]:focus, input[type="text"]:focus { border-color: #60A5FA !important; box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2) !important; outline: none !important; }
            a { color: #2563EB !important; transition: color 0.3s ease !important; }
            a:hover { color: #1E3A8A !important; text-decoration: underline !important; }
            .text-gray-600 { color: #1F2937 !important; }
            .text-gray-500 { color: #1E3A8A !important; } /* Use primary blue for logo/accents */
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
