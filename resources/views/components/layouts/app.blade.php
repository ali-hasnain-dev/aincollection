<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/x-icon" href="{{ asset('web/logo1.png') }}">

    @vite('resources/css/app.css')
    <title>{{ $title ?? 'Posh' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
    <script>
        document.addEventListener('livewire:init', () => {
                Livewire.on('notification', (event) => {
                    if (event[0].id) {
                        $('.addToCardDesc-' + event[0].id).hide();
                        $('#prod-' + event[0].id).show();
                    }

                    // toastr.options.closeButton = true;
                    // toastr.options.progressBar = true;
                    // if (event[0].type == 'success') {
                    //     toastr.success(event[0].message);
                    // } else if (event[0].type == 'error') {
                    //     toastr.error(event[0].message);
                    // } else if (event[0].type == 'info') {
                    //     toastr.info(event[0].message);
                    // } else if (event[0].type == 'warning') {
                    //     toastr.warning(event[0].message);
                    // }

                });
            });

            function addbutton(id) {
                $('.addToCardDesc-' + id).show();
                $('#prod-' + id).hide();
            }
    </script>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <livewire:web.commons.header />
    <div class="w-full mt-5 mb-5 px-4 md:px-8 lg:px-16 xl:px-32 2xl:px-64 flex-grow">
        {{ $slot }}
    </div>
    <a href="whatsapp://send?phone=123456789" target="_blank" class="fixed bottom-10 right-6 bg-green-500 p-3 rounded-full">
        <!-- Replace with your WhatsApp icon or use an emoji -->
        <img src="https://img.icons8.com/color/96/whatsapp--v1.png" alt="WhatsApp Icon" class="w-6 h-6">
    </a>
    <livewire:web.commons.footer />
</body>

</html>