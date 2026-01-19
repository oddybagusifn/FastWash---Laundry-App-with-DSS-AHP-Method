<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fast Wash | AHP DSS</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @font-face {
            font-family: 'SF Pro Display';
            src: url('/fonts/SF-Pro/SF-Pro-Display-Regular.otf') format('opentype');
            font-weight: 400;
        }

        @font-face {
            font-family: 'SF Pro Display';
            src: url('/fonts/SF-Pro/SF-Pro-Display-Medium.otf') format('opentype');
            font-weight: 500;
        }

        @font-face {
            font-family: 'SF Pro Display';
            src: url('/fonts/SF-Pro/SF-Pro-Display-Semibold.otf') format('opentype');
            font-weight: 600;
        }

        @font-face {
            font-family: 'SF Pro Display';
            src: url('/fonts/SF-Pro/SF-Pro-Display-Bold.otf') format('opentype');
            font-weight: 700;
        }

        body {
            font-family: 'SF Pro Display', -apple-system, BlinkMacSystemFont, sans-serif;
        }
    </style>
</head>

<body class="bg-white flex flex-col min-h-screen overflow-y-auto">

    <!-- MAIN WRAPPER -->
    <div class="flex-1 flex flex-col p-[10px] gap-[10px] ">

        <!-- ================= MAIN IMAGE ================= -->
        <div class="flex-1 rounded-[32px] overflow-hidden relative min-h-[97vh]">
            <!-- <=== h-screen untuk 100vh -->

            <!-- Background -->
            <div class="absolute inset-0">
                <img src="/img/fastwash-bg.png" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-gradient-to-b from-black/90 via-black/30 to-black/70"></div>
            </div>

            <!-- CONTENT -->
            <div class="relative z-10 h-full flex lg:justify-between flex-col lg:flex-row">

                <!-- LEFT -->
                <div class="w-full lg:w-1/2 p-5 sm:p-6 lg:p-10 text-white flex flex-col justify-between">

                    <div>
                        <!-- Logo -->
                        <div class="flex items-center gap-4 mb-10 lg:mb-24">
                            <img src="{{ asset('icons/shop.svg') }}"
                                class="w-[32px] h-[32px] lg:w-[40px] lg:h-[40px]" />
                            <span class="font-medium text-[22px] lg:text-[28px]">
                                Fast Wash
                            </span>
                        </div>

                        <!-- Title -->
                        <div class="max-w-full lg:max-w-[950px]">
                            <div class="flex flex-col sm:flex-row sm:justify-between gap-2 sm:gap-0">
                                <p class="text-[14px] sm:text-[18px] lg:text-[32px] opacity-80">
                                    A12.6504
                                </p>
                                <p class="text-[14px] sm:text-[18px] lg:text-[32px] opacity-80">
                                    Sistem Pendukung Keputusan
                                </p>
                            </div>

                            <h1 class="text-[28px] sm:text-[40px] lg:text-[66px] font-medium leading-tight mt-2">
                                Analytical Hierarchy Process
                            </h1>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <!-- Author -->
                        <div class="mt-6 lg:mt-0">
                            <p class="font-medium text-[20px] sm:text-[24px] lg:text-[32px]">
                                Daffa Naufal Athallah
                            </p>
                            <p class="text-[14px] sm:text-[16px] lg:text-[19px] opacity-70">
                                A12.2023.07078
                            </p>
                        </div>

                        <div class="mt-6 lg:mt-0">
                            <p class="font-medium text-[20px] sm:text-[24px] lg:text-[32px]">
                                Daffa Naufal Athallah
                            </p>
                            <p class="text-[14px] sm:text-[16px] lg:text-[19px] opacity-70">
                                A12.2023.07078
                            </p>
                        </div>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="w-full lg:w-[840px] p-4 lg:p-6">
                    <div class="bg-[#F3F3F3] rounded-[24px] p-4 sm:p-6 h-full shadow-xl overflow-auto">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- FOOTER -->
    @include('partials.footer')

</body>



</html>
