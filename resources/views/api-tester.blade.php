<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API Tester - Jadwal Dokter</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-3">Uji API Jadwal Dokter</h1>
            <p class="text-xl text-gray-600">Akses API langsung dari browser</p>
        </header>

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 mb-8">
            <div class="p-6 md:p-8">
                <div class="space-y-6">
                    <!-- Form untuk API Request -->
                    <div class="space-y-4">
                        <div>
                            <label for="token" class="block text-sm font-medium text-gray-700 mb-1">Token Autentikasi</label>
                            <input type="text" id="token" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Bearer token_anda_disini">
                            <p class="mt-1 text-xs text-gray-500">Format: Bearer token_anda_disini</p>
                        </div>

                        <div>
                            <label for="endpoint" class="block text-sm font-medium text-gray-700 mb-1">Endpoint API</label>
                            <div class="flex">
                                <select id="method" class="rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-700 text-sm font-medium px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="GET">GET</option>
                                    <option value="POST">POST</option>
                                    <option value="PUT">PUT</option>
                                    <option value="DELETE">DELETE</option>
                                </select>
                                <input type="text" id="endpoint" class="flex-1 rounded-r-md border border-gray-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500" value="http://localhost:8000/api/schedules">
                            </div>
                        </div>

                        <div>
                            <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Body Request (untuk POST/PUT)</label>
                            <textarea id="body" rows="6" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 font-mono text-sm" placeholder='{
    "doctor_id": 1,
    "days": ["Senin", "Selasa"], 
    "start_time": "08:00",
    "end_time": "12:00",
    "quota": 20
}'></textarea>
                        </div>

                        <button onclick="sendRequest()" class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Kirim Request
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hasil API Response -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="border-b border-gray-100 px-6 py-4">
                <h2 class="text-lg font-medium text-gray-800">Hasil Response</h2>
            </div>
            <div class="p-6">
                <div id="loading" class="flex justify-center items-center py-8" style="display: none;">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                </div>
                <pre id="result" class="bg-gray-50 rounded-md p-4 font-mono text-sm overflow-auto max-h-96 text-gray-700">// Hasil response akan muncul di sini</pre>
            </div>
        </div>

        <!-- Quick Reference Card -->
        <div class="mt-8 grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 p-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Endpoint API</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mr-2">GET</span>
                        <code class="text-sm text-gray-700">/api/schedules</code>
                    </div>
                    <div class="flex items-center">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mr-2">POST</span>
                        <code class="text-sm text-gray-700">/api/schedules</code>
                    </div>
                    <div class="flex items-center">
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mr-2">GET</span>
                        <code class="text-sm text-gray-700">/api/doctors</code>
                    </div>
                    <div class="flex items-center">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full mr-2">POST</span>
                        <code class="text-sm text-gray-700">/api/doctors</code>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100 p-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Contoh Body Request</h3>
                <div class="space-y-3">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-1">POST /api/schedules</h4>
                        <pre class="bg-gray-50 rounded-md p-3 font-mono text-xs overflow-auto text-gray-700">{
  "doctor_id": 1,
  "days": ["Senin", "Selasa"], 
  "start_time": "08:00",
  "end_time": "12:00",
  "quota": 20
}</pre>
                    </div>
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-1">POST /api/doctors</h4>
                        <pre class="bg-gray-50 rounded-md p-3 font-mono text-xs overflow-auto text-gray-700">{
  "doctor_name": "Dr. Budi Santoso",
  "specialization": "Umum"
}</pre>
                    </div>
                </div>
            </div>
        </div>

        <footer class="mt-20 pt-8 border-t border-gray-200 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} API Jadwal Dokter</p>
            <p class="mt-2">Dikembangkan dengan <span class="text-red-500">❤</span> menggunakan Laravel</p>
        </footer>
    </div>

    <script>
        function sendRequest() {
            const token = document.getElementById('token').value;
            const method = document.getElementById('method').value;
            const endpoint = document.getElementById('endpoint').value;
            const bodyText = document.getElementById('body').value;
            
            const resultElem = document.getElementById('result');
            const loadingElem = document.getElementById('loading');
            
            resultElem.textContent = '';
            loadingElem.style.display = 'flex';
            
            const options = {
                method: method,
                headers: {
                    'Content-Type': 'application/json'
                }
            };
            
            // Tambahkan token autentikasi jika disediakan
            if (token && token.trim() !== '') {
                options.headers['Authorization'] = token.startsWith('Bearer ') ? token : `Bearer ${token}`;
            }
            
            // Tambahkan body untuk POST/PUT request
            if ((method === 'POST' || method === 'PUT') && bodyText.trim() !== '') {
                try {
                    options.body = bodyText.trim();
                } catch (error) {
                    loadingElem.style.display = 'none';
                    resultElem.textContent = `Error parsing JSON: ${error.message}`;
                    return;
                }
            }
            
            fetch(endpoint, options)
                .then(response => {
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json().then(data => ({
                            status: response.status,
                            statusText: response.statusText,
                            data
                        }));
                    } else {
                        return response.text().then(text => ({
                            status: response.status,
                            statusText: response.statusText,
                            data: text
                        }));
                    }
                })
                .then(({ status, statusText, data }) => {
                    loadingElem.style.display = 'none';
                    
                    const responseInfo = `Status: ${status} ${statusText}\n\n`;
                    
                    if (typeof data === 'object') {
                        resultElem.textContent = responseInfo + JSON.stringify(data, null, 2);
                    } else {
                        resultElem.textContent = responseInfo + data;
                    }
                })
                .catch(error => {
                    loadingElem.style.display = 'none';
                    resultElem.textContent = `Error: ${error.message}`;
                });
        }
    </script>
</body>
</html> 