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
                    <label class="block text-sm font-medium">Departemen</label>

                <div class="mb-4">
                    <select wire:model="departemen_id"
                        class="w-full mt-1 rounded-lg border-black-300">
                        <option value="">-- Pilih Departemen --</option>
                        @foreach ($departemen as $dep)
                            <option value="{{ $dep->id }}">
                                {{ $dep->nama_departemen }}
                            </option>
                        @endforeach
                    </select> <br>
                    <label class="block text-sm font-medium">Kategori Tiket</label>

                   <select wire:model="prioritas_tiket_id"
                        class="w-full mt-1 rounded-lg border-black-300"
                        @disabled(!$departemen_id)>
                        <option value="">-- Pilih Kategori --</option>

                        @foreach ($prioritastiket as $prioritas)
                            <option value="{{ $prioritas->id }}">
                                {{ $prioritas->nama_prioritas_tiket }}
                            </option>
                        @endforeach
                    </select>
                    @error('prioritas_tiket_id')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Deskripsi</label>
                    <textarea wire:model="deskripsi"class="w-full mt-1 rounded-lg border-black-300" rows="3"></textarea>
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

<div wire:poll.3s class="max-w-[95%] mx-auto overflow-hidden rounded-xl border border-gray-200 bg-white shadow-md">
    <table class="w-full text-sm border-collapse">
        <thead class="bg-gray-50/80 text-gray-700 font-bold uppercase tracking-wider border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 w-[15%] text-center whitespace-nowrap">Nomor</th>
                <th class="px-4 py-4 w-[10%] text-center">Prioritas</th>
                <th class="px-6 py-4 w-[25%] text-center whitespace-nowrap">Agent</th>
                <th class="px-4 py-4 w-[18%] text-center">Status</th>
                <th class="px-4 py-4 w-[22%] text-center">Deskripsi</th>
                <th class="px-4 py-4 w-[10%] text-center">Tanggal</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @forelse ($tikets as $tiket)
                <tr class="hover:bg-blue-50/20 transition-all duration-200">
                    <td class="px-6 py-5 font-bold text-blue-600 text-center whitespace-nowrap">
                        {{ $tiket->nomor_tiket }}
                    </td>

                    <td class="px-4 py-5 text-black-800 font-semibold text-center uppercase text-[11px]">
                        {{ $tiket->prioritas_tiket->nama_prioritas_tiket ?? '-' }}
                    </td>

                    <td class="px-4 py-5 text-black-800 font-semibold text-center uppercase text-[11px]">
                        {{ $tiket->agent?->nama ?? 'Belum Ditugaskan' }}
                    </td>

                    <td class="px-4 py-5 text-center">
                        <div class="flex justify-center">
                            @php
                                $status = strtolower($tiket->status);
                                $badgeStyle = match(true) {
                                    str_contains($status, 'waiting') => 'bg-blue-100 text-blue-700 border-blue-200',
                                    str_contains($status, 'progress') => 'bg-green-100 text-green-700 border-green-200',
                                    default => 'bg-gray-100 text-gray-600 border-gray-200',
                                };
                            @endphp
                            <span class="min-w-[160px] px-3 py-1.5 rounded-full text-[10px] font-extrabold border uppercase tracking-widest shadow-sm {{ $badgeStyle }}">
                                {{ $tiket->status }}
                            </span>
                        </div>
                    </td>

                    <td class="px-4 py-5 text-black-800 italic font-semibold text-center uppercase text-[11px]">
                        <div class="line-clamp-1 max-w-[200px] mx-auto text-xs">
                            {{ $tiket->deskripsi }}
                        </div>
                    </td>

                    <td class="px-4 py-5 text-black-800 font-semibold text-center uppercase text-[11px]">
                        {{ $tiket->created_at->format('d M Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-16 text-center text-gray-400 italic font-medium">
                        Tidak ada data tiket yang tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
         

</div>
