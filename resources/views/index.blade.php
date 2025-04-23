<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="w-full min-h-dvh flex justify-center items-center bg-[#FDFDFC] dark:bg-[#0a0a0a] text-red-600">
        <section>
            <h1 class="font-bold text-4xl">
                Coming Soon!
            </h1>
        </section>
    </body>
</html>
