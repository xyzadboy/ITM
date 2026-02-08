<div class="h-full flex flex-col py-12 px-4 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="mx-auto h-12 w-12 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg">
            ✍️
        </div>
        <h2 class="mt-6 text-center text-2xl font-bold text-gray-900">
            Pusat Bantuan Tiket
        </h2>
    </div>

    {{-- FORM --}}
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white p-6 shadow-xl rounded-2xl">
            <form wire:submit.prevent="submit">

                <div class="mb-4">
                    <label class="block text-sm font-medium">Kategori Tiket</label>
                    <select wire:model="kategori_tiket_id"
                        class="w-full mt-1 rounded-lg border-gray-300">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoriTiket as $kategori)
                            <option value="{{ $kategori->id }}">
                                {{ $kategori->nama_kategori_tiket }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_tiket_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Deskripsi</label>
                    <textarea wire:model="deskripsi"class="w-full mt-1 rounded-lg border-gray-300" rows="3"></textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg">
                    Kirim Tiket
                </button>

              
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="mt-12 sm:mx-auto sm:w-full sm:max-w-4xl">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">


<div wire:poll.3s>
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-4 py-3">Nomor</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Agent</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($tikets as $tiket)
                        <tr>
                            <td class="px-4 py-3 text-blue-600">
                                {{ $tiket->nomor_tiket }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $tiket->kategori_tiket->nama_kategori_tiket ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $tiket->agent?->nama ?? 'Belum Ditugaskan' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $tiket->status }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $tiket->deskripsi }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $tiket->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-400">
                                Belum ada tiket
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>

</div>
