<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name') }}</title>
        <style>
            /* Add your CSS styles here */
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                padding: 20px;
            }

            .container {
                max-width: 650px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                margin-top: 100px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #6F3C96 !important;
                font-size: 22px !important;
            }

            /* Add more styles as needed */

        </style>
    </head>

    <body>
        {{-- Add your logo here --}}

        <div class="container">
            <div style="text-align: center; border-bottom: 1px solid #C4C4C4; margin-bottom: 50px">
                <img src="{{ asset('img/logo-text.png') }}" alt="Your Logo"
                    style="max-width: 500px;margin-bottom: 10px;">
            </div>
            @yield('content')
        </div>

        <footer>
            {{-- Footer content --}}
        </footer>
    </body>

</html>