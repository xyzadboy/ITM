<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Tiket Baru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="h-full flex flex-col py-12 px-4 sm:px-6 lg:px-8">

    {{-- Header Section --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="mx-auto h-12 w-12 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </div>
        <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
            Pusat Bantuan Tiket
        </h2>
    </div>

    {{-- Form Section --}}
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow-xl sm:rounded-2xl sm:px-10 border border-gray-100">
            <form action="{{ route('tiket.form') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Tiket</label>
                    <select name="kategori_tiket_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoriTiket as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori_tiket }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Masalah</label>
                    <textarea name="deskripsi" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="Jelaskan detail masalah Anda..."></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-blue-700 shadow-md transition-colors">
                    Kirim Tiket
                </button>
            </form>
        </div>
    </div>

    {{-- Table Section (Daftar Tiket) --}}
    <div class="mt-12 sm:mx-auto sm:w-full sm:max-w-4xl">
        <div class="bg-white shadow-xl sm:rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-semibold text-gray-800">Waiting List</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 font-medium">Nomor Tiket</th>
                            <th class="px-6 py-4 font-medium">Kategori</th>
                            <!-- <th class="px-6 py-4 font-medium">Deskripsi</th> -->
                            <th class="px-6 py-4 font-medium">Agent</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
    @forelse ($tikets as $tiket)
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 font-medium text-blue-600">{{ $tiket->nomor_tiket }}</td>
            <td class="px-6 py-4 text-gray-900">
                {{ $tiket->kategori_tiket->nama_kategori_tiket ?? '-' }}
            </td>
      
            <td class="px-6 py-4">
            {{ $tiket->agent?->nama ?? 'Belum Ditugaskan' }}
            <td class="px-6 py-4">
                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                    {{ $tiket->status }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                {{ $tiket->created_at->format('d M Y') }}
            </td>

        </tr>
    @empty
        <tr>
            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                Belum ada tiket yang dibuat.
            </td>
        </tr>
    @endforelse
</tbody>

                </table>
            </div>
        </div>
    </div>

</body>
</html>