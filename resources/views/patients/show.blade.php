<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis Pasien - {{ $patientData['info']['name'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        medical: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen font-sans">
    <header class="bg-white shadow-sm border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-medical-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-slate-800">Farmakogenetik</h1>
                        <p class="text-sm text-slate-500">Rekam Medis Pasien</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-600">Terakhir diperbarui: {{ now()->translatedFormat('j F Y, g:i A') }}</span>
                    <div class="w-8 h-8 bg-slate-200 rounded-full flex items-center justify-center">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-4">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-medical-500 to-medical-700 rounded-xl flex items-center justify-center text-white text-xl font-semibold">
                        {{ $patientData['info']['initials'] }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800">{{ $patientData['info']['name'] }}</h2>
                        <p class="text-slate-600 mb-2">No. Rekam Medis:
                            {{ $patientData['info']['medical_record_number'] }}</p>
                        <div class="flex flex-wrap gap-4 text-sm">
                            <span class="flex items-center text-slate-600">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0v1a2 2 0 001.732 1 2 2 0 001.732-1V7M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V9a2 2 0 00-2-2h-2">
                                    </path>
                                </svg>
                                Tgl. Lahir: {{ $patientData['info']['dob'] }}
                            </span>
                            <span class="flex items-center text-slate-600">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $patientData['info']['gender'] }}, {{ $patientData['info']['age'] }} tahun
                            </span>
                            <span class="flex items-center text-slate-600">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                {{ $patientData['info']['phone'] }}
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm mt-2">
                            <span class="text-slate-600"><strong>NIK:</strong>
                                {{ $patientData['info']['national_id'] }}</span>
                            <span class="text-slate-600"><strong>Tempat Lahir:</strong>
                                {{ $patientData['info']['birth_place'] }}</span>
                            <span class="text-slate-600"><strong>Agama:</strong>
                                {{ $patientData['info']['religion'] }}</span>
                        </div>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm mt-1">
                            <span class="text-slate-600"><strong>Pekerjaan:</strong>
                                {{ $patientData['info']['occupation'] }}</span>
                            <span class="text-slate-600"><strong>Pendidikan:</strong>
                                {{ $patientData['info']['education'] }}</span>
                            <span class="text-slate-600"><strong>Status Pernikahan:</strong>
                                {{ $patientData['info']['marital_status'] }}</span>
                        </div>
                        <p class="text-sm text-slate-600 mt-1"><strong>Alamat:</strong>
                            {{ $patientData['info']['address'] }}</p>
                    </div>
                </div>
                <div class="text-right">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">Pasien
                        Aktif</span>
                    <p class="text-sm text-slate-500 mt-1">ID Pasien: #{{ $patientData['info']['id'] }}</p>
                </div>
            </div>
        </div>

        @if ($patientData['latest_record'])
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-medical-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            Pengukuran Fisik
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="bg-slate-50 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-slate-800">
                                    {{ $patientData['latest_record']['height'] ?? 'N/A' }}</div>
                                <div class="text-sm text-slate-600">Tinggi (cm)</div>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-slate-800">
                                    {{ $patientData['latest_record']['weight'] ?? 'N/A' }}</div>
                                <div class="text-sm text-slate-600">Berat (kg)</div>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-slate-800">
                                    {{ $patientData['latest_record']['bmi'] ?? 'N/A' }}</div>
                                <div class="text-sm text-slate-600">IMT</div>
                                @if ($patientData['latest_record']['bmi_status'] == 'Normal')
                                    <div class="text-xs text-green-600 mt-1">
                                        {{ $patientData['latest_record']['bmi_status'] }}
                                    </div>
                                @else
                                    <div class="text-xs text-amber-600 mt-1">
                                        {{ $patientData['latest_record']['bmi_status'] }}
                                    </div>
                                @endif
                            </div>
                            <div class="bg-slate-50 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-slate-800">
                                    @if ($patientData['diabetes_diagnosis_date'])
                                        Tipe 2
                                    @else
                                        N/A
                                    @endif
                                </div>
                                <div class="text-sm text-slate-600">Status Diabetes</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-medical-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                            Gula Darah & Hasil Lab
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-slate-50 rounded-lg p-4">
                                <div class="text-xl font-bold text-slate-800">
                                    {{ $patientData['latest_record']['standard_blood_sugar'] ?? 'N/A' }} mg/dL</div>
                                <div class="text-sm text-slate-600">Gula Darah Sewaktu</div>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-4">
                                <div class="text-xl font-bold text-slate-800">
                                    {{ $patientData['latest_record']['fasting_blood_sugar'] ?? 'N/A' }} mg/dL</div>
                                <div class="text-sm text-slate-600">Gula Darah Puasa</div>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-4">
                                <div class="text-xl font-bold text-slate-800">
                                    {{ $patientData['latest_record']['hba1c'] ?? 'N/A' }}%</div>
                                <div class="text-sm text-slate-600">Hasil HbA1c</div>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-4">
                                <div class="text-xl font-bold text-slate-800">
                                    {{ $patientData['latest_record']['irs1_variant'] ?? 'N/A' }}</div>
                                <div class="text-sm text-slate-600">IRS1 rs1801278</div>
                                <div class="text-xs text-slate-600 mt-1">Varian Genetik</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-medical-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Riwayat Medis
                        </h3>
                        <div class="space-y-4">
                            @forelse ($patientData['medical_history'] as $record)
                                <div class="border-l-4 border-medical-500 pl-4 py-3 bg-slate-50 rounded-r-lg">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-medium text-slate-800">{{ $record['title'] }}</h4>
                                            <p class="text-sm text-slate-600">Dr. {{ $record['doctor_name'] }} -
                                                {{ $record['doctor_specialization'] }}</p>
                                        </div>
                                        <span class="text-sm text-slate-500">{{ $record['date'] }}</span>
                                    </div>
                                    <div class="bg-white rounded-lg p-3 mt-2">
                                        <h5 class="font-medium text-slate-700 mb-2">Resep:</h5>
                                        <div class="text-sm text-slate-600 mb-2 prose prose-sm">
                                            {!! nl2br(e($record['prescription'])) !!}</div>
                                        <h5 class="font-medium text-slate-700 mb-2">Catatan:</h5>
                                        <p class="text-sm text-slate-600">{{ $record['notes'] }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-slate-500">Tidak ada riwayat medis ditemukan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    @if ($patientData['diagnoses']['primary'])
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-medical-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Diagnosis Utama
                            </h3>
                            <div class="space-y-3">
                                <div
                                    class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                                    <div>
                                        <div class="font-medium text-slate-800">
                                            {{ $patientData['diagnoses']['primary']['name'] }}</div>
                                        <div class="text-sm text-slate-600">
                                            {{ $patientData['diagnoses']['primary']['description'] }}</div>
                                        <div class="text-xs text-slate-500 mt-1">
                                            {{ $patientData['diagnoses']['primary']['code'] }}</div>
                                    </div>
                                    <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (!empty($patientData['diagnoses']['other']))
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                            <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-medical-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                Kondisi Medis Lainnya
                            </h3>
                            <div class="space-y-3">
                                @foreach ($patientData['diagnoses']['other'] as $condition)
                                    <div
                                        class="flex items-center justify-between p-3 bg-amber-50 rounded-lg border border-amber-200">
                                        <div>
                                            <div class="font-medium text-slate-800">{{ $condition['name'] }}</div>
                                            <div class="text-sm text-slate-600">{{ $condition['description'] }}</div>
                                        </div>
                                        <span class="w-3 h-3 bg-amber-400 rounded-full"></span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-medical-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                </path>
                            </svg>
                            Hasil Tes Genetik
                        </h3>
                        <div class="space-y-3">
                            @forelse ($patientData['genetic_results'] as $result)
                                <div class="border border-slate-200 rounded-lg p-3">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="font-medium text-slate-800">{{ $result['gene_name'] }}</div>
                                        <span
                                            class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">{{ $result['status'] }}</span>
                                    </div>
                                    <div class="text-sm text-slate-600">{{ $result['variant'] ?? 'N/A' }}</div>
                                    <div class="text-xs text-slate-500 mt-1">{{ $result['description'] ?? '' }}</div>
                                </div>
                            @empty
                                <p class="text-slate-500">Tidak ada hasil tes genetik ditemukan.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.314 16.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                            Alergi Obat
                        </h3>
                        <div class="space-y-2">
                            @forelse ($patientData['allergies'] as $allergy)
                                <div class="flex items-center p-3 bg-red-50 rounded-lg border border-red-200">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-3"></div>
                                    <div>
                                        <div class="font-medium text-slate-800">{{ $allergy['name'] }}</div>
                                        <div class="text-sm text-slate-600">{{ $allergy['reaction'] }}</div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-slate-500">Tidak ada alergi obat yang diketahui.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 text-center">
                <h3 class="text-lg font-medium text-slate-600">Tidak ada rekam medis yang ditemukan untuk pasien ini.
                </h3>
            </div>
        @endif
    </main>
</body>

</html>
