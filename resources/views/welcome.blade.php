<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>API Jadwal Dokter</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 text-gray-800 antialiased min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <header class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold text-blue-600 mb-3">API Jadwal Dokter</h1>
                <p class="text-xl text-gray-600">Sistem Manajemen Jadwal Dokter yang Andal</p>
        </header>

            <div class="grid gap-8 md:grid-cols-2">
                <!-- Card Informasi -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition transform hover:scale-[1.01] hover:shadow-lg">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-blue-500 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    </svg>
                            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang</h2>
                        </div>
                        <p class="text-gray-600 mb-6">
                            Sistem ini menyediakan API untuk mengelola jadwal dokter di fasilitas kesehatan Anda. 
                            Dengan API ini, Anda dapat mengelola jadwal praktek dokter, melihat ketersediaan dokter, 
                            dan mengatur kuota pasien per hari dengan mudah dan efisien.
                        </p>
                        <div class="flex justify-start">
                            <a href="#endpoints" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25 transition">
                                Lihat Endpoint API
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Cara Penggunaan -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition transform hover:scale-[1.01] hover:shadow-lg">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-green-500 mr-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                            <h2 class="text-2xl font-bold text-gray-800">Cara Penggunaan</h2>
                        </div>
                        <div class="space-y-4 text-gray-600">
                            <p>
                                Untuk menggunakan API ini, Anda perlu melakukan otentikasi dengan token API.
                                Token dapat diperoleh melalui proses registrasi atau login ke sistem.
                            </p>
                            <div class="bg-gray-50 rounded-lg p-4 font-mono text-sm overflow-auto">
                                <code>Authorization: Bearer {your_token}</code>
                            </div>
                            <p>
                                Seluruh response dari API akan dikembalikan dalam format JSON dengan struktur yang konsisten.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Endpoints Section -->
            <div id="endpoints" class="mt-16">
                <h2 class="text-2xl font-bold text-gray-800 mb-8 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                    </svg>
                    Endpoint API yang Tersedia
                </h2>

                <div class="grid gap-4 md:grid-cols-2">
                    <!-- GET /api/schedules -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">GET</span>
                            <span class="text-gray-500 text-xs">Auth Required</span>
                        </div>
                        <h3 class="font-mono text-sm mb-2 text-gray-700">/api/schedules</h3>
                        <p class="text-gray-600 text-sm">Mendapatkan semua jadwal dokter yang tersedia</p>
                        <div class="mt-4">
                            <span class="text-xs font-medium text-gray-500 uppercase">Response:</span>
                            <div class="mt-1 bg-gray-50 rounded p-2 font-mono text-xs overflow-auto">
                                <code>{"message": "berhasil", "body": [...]}</code>
                            </div>
                        </div>
                    </div>

                    <!-- POST /api/schedules -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">POST</span>
                            <span class="text-gray-500 text-xs">Auth Required</span>
                        </div>
                        <h3 class="font-mono text-sm mb-2 text-gray-700">/api/schedules</h3>
                        <p class="text-gray-600 text-sm">Membuat jadwal dokter baru dengan pengaturan hari, waktu dan kuota</p>
                        <div class="mt-4">
                            <span class="text-xs font-medium text-gray-500 uppercase">Response:</span>
                            <div class="mt-1 bg-gray-50 rounded p-2 font-mono text-xs overflow-auto">
                                <code>{"message": "berhasil", "body": [...]}</code>
                            </div>
                        </div>
                    </div>

                    <!-- GET /api/doctors -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">GET</span>
                            <span class="text-gray-500 text-xs">Auth Required</span>
                        </div>
                        <h3 class="font-mono text-sm mb-2 text-gray-700">/api/doctors</h3>
                        <p class="text-gray-600 text-sm">Mendapatkan daftar semua dokter yang terdaftar</p>
                        <div class="mt-4">
                            <span class="text-xs font-medium text-gray-500 uppercase">Response:</span>
                            <div class="mt-1 bg-gray-50 rounded p-2 font-mono text-xs overflow-auto">
                                <code>{"message": "berhasil", "body": [...]}</code>
                            </div>
                        </div>
                    </div>

                    <!-- POST /api/doctors -->
                    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">POST</span>
                            <span class="text-gray-500 text-xs">Auth Required</span>
                        </div>
                        <h3 class="font-mono text-sm mb-2 text-gray-700">/api/doctors</h3>
                        <p class="text-gray-600 text-sm">Mendaftarkan dokter baru ke dalam sistem</p>
                        <div class="mt-4">
                            <span class="text-xs font-medium text-gray-500 uppercase">Response:</span>
                            <div class="mt-1 bg-gray-50 rounded p-2 font-mono text-xs overflow-auto">
                                <code>{"message": "berhasil", "body": {...}}</code>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="mt-20 pt-10 border-t border-gray-200 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} API Jadwal Dokter</p>
                <p class="mt-2">Dikembangkan dengan <span class="text-red-500">❤</span> menggunakan Laravel</p>
            </footer>
        </div>
    </body>
</html>
