<!DOCTYPE html>
    <html>
        <head>
            <title>Essai</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css"
            integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
            @vite(['resources/css/app.css','resources/js/app.js'])
        </head>
        <body class="bg-[#EEE]">
            @isset($header)
                <header class="bg-[#EEE] z-50 h-20 w-full top-0 left-0 fixed flex items-center justify-between mt-0 mb-20 mx-0 shadow-2xl">
                    {{ $header }}
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>

            @isset($footer)
                <footer class="bg-[#CCC] h-20 w-full relative flex mb-0 mt-50 bottom-0 left-0 gap-50 justify-start items-center px-20">
                        {{ $footer }}
                </footer>
            @endisset

        </body>
    </html>
