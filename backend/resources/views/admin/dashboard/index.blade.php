 @extends('admin.layouts.app')

 @section('content')
     <!-- Cards -->
     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-6">
         <!-- Jam Digital -->
         <div
             class="bg-white rounded-lg shadow-lg p-8 text-center flex flex-col items-center justify-center cursor-pointer hover:shadow-xl transition">
             <!-- Ikon Jam -->
             <span class="material-icons text-primary text-6xl mb-4">access_time</span>

             <!-- Deskripsi -->
             <p class="text-sm text-gray-500 mb-5 max-w-xs">
                 Lihat waktu terkini yang terus diperbarui secara real-time. Pastikan Anda tidak ketinggalan waktu!
             </p>

             <!-- Jam Digital -->
             <div id="clock" class="text-4xl font-bold text-gray-800"></div>
         </div>

         <!-- Ajukan Kebutuhan Keuangan -->
         <div class="bg-white rounded shadow p-6 text-center flex flex-col items-center justify-center cursor-pointer hover:shadow-lg transition"
             @click="modalOpen = true">
             <span class="material-icons text-primary text-5xl mb-3">attach_money</span>
             <h2 class="text-lg font-semibold mb-1 text-primary">Ajukan Kebutuhan Keuangan</h2>
             <p class="text-gray-600 text-sm mb-3 max-w-xs">Dapatkan bantuan dana sesuai kebutuhan Anda dengan proses mudah
                 dan cepat.</p>
             <button
                 class="mt-auto bg-primary text-white px-5 py-2 rounded hover:bg-primary-light transition flex items-center justify-center gap-2">
                 <span class="material-icons">add</span>
                 Ajukan Sekarang
             </button>
         </div>
     </div>

     <!-- Tabel Pengajuan -->
     <section x-data="pagination()" class="bg-white rounded shadow mt-8">
         <div class="p-4 border-b">
             <h2 class="text-lg font-semibold text-primary">Daftar Pengajuan</h2>
             <p class="text-sm text-gray-500">Pantau dan proses pengajuan yang masuk.</p>
         </div>

         <!-- Form Filter -->
         <form method="GET" action="{{ secure_url(route('dashboards', [], false)) }}"
             class="p-4 bg-white rounded shadow flex flex-col md:flex-row md:items-center md:space-x-4 space-y-3 md:space-y-0">
             <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Cari nama atau deskripsi..."
                 class="px-4 py-2 w-full md:w-1/3 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none" />

             <select name="jenis"
                 class="px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
                 <option value="">Semua Jenis</option>
                 <option value="konsumtif" {{ request('jenis') == 'konsumtif' ? 'selected' : '' }}>Konsumtif
                 </option>
                 <option value="produktif" {{ request('jenis') == 'produktif' ? 'selected' : '' }}>Produktif
                 </option>
                 <option value="darurat" {{ request('jenis') == 'darurat' ? 'selected' : '' }}>Darurat</option>
             </select>

             <select name="status"
                 class="px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
                 <option value="">Semua Status</option>
                 <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                 </option>
                 <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                 </option>
                 <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                 </option>
             </select>

             <div class="flex gap-2 mt-4">
                 <button type="submit"
                     class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded hover:bg-primary-light transition">
                     <span class="material-icons text-white text-base">filter_alt</span>
                     <span>Filter</span>
                 </button>

                 <a href="{{ route('dashboards') }}"
                     class="flex items-center gap-2 bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                     <span class="material-icons text-gray-700 text-base">refresh</span>
                     <span>Reset</span>
                 </a>
             </div>
         </form>

         <!-- Tabel -->
         <div class="overflow-x-auto">
             <table class="w-full text-sm text-gray-700">
                 <thead class="bg-primary text-white">
                     <tr>
                         <th class="py-3 px-4 text-left">#</th>
                         <th class="py-3 px-4 text-left">Nama</th>
                         <th class="py-3 px-4 text-left">No. Telegram</th>
                         <th class="py-3 px-4 text-left">Tanggal</th>
                         <th class="py-3 px-4 text-left">Jenis</th>
                         <th class="py-3 px-4 text-left">Jumlah</th>
                         <th class="py-3 px-4 text-left">Status</th>
                         <th class="py-3 px-4 text-left">Verifikasi</th>
                         <th class="py-3 px-4 text-left">Aksi</th>
                     </tr>
                 </thead>
                 <tbody class="divide-y divide-gray-200">
                     @forelse ($pengajuans as $index => $item)
                         <tr>
                             <td class="px-4 py-3">{{ $index + 1 }}</td>
                             <td class="px-4 py-3">{{ $item->nasabah->nama_lengkap }}</td>
                             <td class="px-4 py-3">{{ $item->nasabah->nomor_telegram }}</td>
                             <td class="px-4 py-3">
                                 {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                             </td>
                             <td class="px-4 py-3 capitalize">{{ $item->jenis_pengajuan }}</td>
                             <td class="px-4 py-3">Rp{{ number_format($item->jumlah_dana, 0, ',', '.') }}</td>
                             <td class="px-4 py-3">
                                 @if (auth()->user()->role === 'admin')
                                     <form action="{{ secure_url(route('pengajuan.ubahStatus', $item->id, false)) }}"
                                         method="POST">
                                         @csrf
                                         @method('PUT')
                                         <select name="status" onchange="this.form.submit()"
                                             class="text-sm border rounded px-2 py-1 focus:ring focus:ring-primary">
                                             <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>
                                                 Menunggu</option>
                                             <option value="disetujui"
                                                 {{ $item->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                             <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>
                                                 Ditolak</option>
                                         </select>
                                     </form>
                                 @else
                                     @php
                                         $statusColor = match ($item->status) {
                                             'pending' => 'bg-yellow-100 text-yellow-800',
                                             'disetujui' => 'bg-green-100 text-green-800',
                                             'ditolak' => 'bg-red-100 text-red-800',
                                             default => 'bg-gray-100 text-gray-800',
                                         };
                                     @endphp
                                     <span class="px-2 py-1 rounded text-xs font-semibold {{ $statusColor }}">
                                         {{ ucfirst($item->status) }}
                                     </span>
                                 @endif

                             </td>
                             <td class="px-4 py-3 text-sm">
                                 @php
                                     $verif = $item->status_verifikasi ?? 'belum diverifikasi';
                                 @endphp
                                 <span
                                     class="{{ $verif == 'terverifikasi'
                                         ? 'text-green-600'
                                         : ($verif == 'verifikasi ditolak'
                                             ? 'text-red-600'
                                             : 'text-yellow-500') }} font-medium">
                                     {{ ucfirst($verif) }}
                                 </span>
                             </td>
                             <td class="px-4 py-3">
                                 <!-- Modal Verifikasi -->
                                 <div x-data="{ show: false }">
                                     @if (auth()->user()->role === 'admin')
                                         <!-- Tombol Verifikasi & Modal -->
                                         <button @click="show = true"
                                             class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 flex items-center gap-1">
                                             <span class="material-icons text-base">fact_check</span> Verifikasi
                                         </button>
                                     @endif

                                     <div x-show="show"
                                         class="fixed inset-0 bg-black/30 backdrop-blur-sm bg-opacity-50 flex items-center justify-center z-50"
                                         x-transition.opacity style="display: none;">
                                         <div @click.away="show = false"
                                             class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6 relative overflow-y-auto max-h-[90vh]">
                                             <button @click="show = false"
                                                 class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold">&times;</button>

                                             <h2 class="text-lg font-semibold mb-4 text-primary">Verifikasi
                                                 Dokumen</h2>

                                             <!-- BUKTI KTP -->
                                             <div class="mb-4">
                                                 <p class="font-medium text-sm mb-1">Bukti KTP</p>
                                                 @if (Str::endsWith($item->bukti_ktp, '.pdf'))
                                                     <iframe src="{{ asset('storage/' . $item->bukti_ktp) }}"
                                                         class="w-full h-64 rounded border"></iframe>
                                                 @else
                                                     <img src="{{ asset('storage/' . $item->bukti_ktp) }}"
                                                         class="w-full max-h-64 object-contain rounded border" />
                                                 @endif
                                             </div>

                                             <!-- SWAFOTO -->
                                             <div class="mb-4">
                                                 <p class="font-medium text-sm mb-1">Swafoto KTP</p>
                                                 @if (Str::endsWith($item->swafoto_ktp, '.pdf'))
                                                     <iframe src="{{ asset('storage/' . $item->swafoto_ktp) }}"
                                                         class="w-full h-64 rounded border"></iframe>
                                                 @else
                                                     <img src="{{ asset('storage/' . $item->swafoto_ktp) }}"
                                                         class="w-full max-h-64 object-contain rounded border" />
                                                 @endif
                                             </div>

                                             <form action="{{ secure_url("/pengajuan/{$item->id}/verifikasi") }}"
                                                 method="POST" class="space-y-4">
                                                 @csrf
                                                 @method('PUT')
                                                 <div>
                                                     <label class="block text-sm font-medium mb-1">Status
                                                         Verifikasi</label>
                                                     <select name="status_verifikasi" required
                                                         class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary">
                                                         <option value="terverifikasi">Terverifikasi</option>
                                                         <option value="verifikasi ditolak">Verifikasi Ditolak
                                                         </option>
                                                     </select>
                                                 </div>
                                                 <div>
                                                     <label class="block text-sm font-medium mb-1">Catatan
                                                         (Opsional)
                                                     </label>
                                                     <textarea name="catatan" rows="3"
                                                         class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary"
                                                         placeholder="Berikan alasan jika ditolak..."></textarea>
                                                 </div>
                                                 <div class="flex justify-end gap-2">
                                                     <button type="button" @click="show = false"
                                                         class="px-4 py-2 border rounded hover:bg-gray-100">Batal</button>
                                                     <button type="submit"
                                                         class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-light">Simpan</button>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>

                                     @if (auth()->user()->role === 'nasabah')
                                         @if ($item->status === 'disetujui' && $item->status_verifikasi === 'terverifikasi')
                                             <!-- Tombol Bayar Sekarang -->
                                             <a href="{{ route('tagihan.show', $item->id) }}"
                                                 class="block bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1 rounded text-sm text-center font-medium transition flex items-center justify-center gap-1">
                                                 💰 Kembalikan Dana
                                             </a>
                                         @elseif ($item->status_verifikasi !== 'terverifikasi')
                                             <span class="text-sm text-yellow-600 font-medium">❗ Menunggu verifikasi
                                                 dokumen</span>
                                         @elseif ($item->status !== 'disetujui')
                                             <span class="text-sm text-blue-600 font-medium">⏳ Menunggu persetujuan
                                                 pengajuan</span>
                                         @else
                                             <span class="text-sm text-gray-500">Menunggu proses</span>
                                         @endif
                                     @endif

                                 </div>
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="9" class="py-10 text-center text-gray-500">
                                 <div class="flex flex-col items-center justify-center space-y-2">
                                     <span
                                         class="material-icons text-4xl text-gray-400 animate-pulse">hourglass_empty</span>
                                     <p class="text-sm font-medium">Belum ada pengajuan masuk</p>
                                     <p class="text-xs text-gray-400">Silakan tunggu atau tambahkan pengajuan
                                         baru.</p>
                                 </div>
                             </td>
                         </tr>
                     @endforelse
                 </tbody>
             </table>
             <div class="p-4">
                 {{ $pengajuans->links('pagination::tailwind') }}
             </div>
         </div>

     </section>


     <!-- Modal Ajukan Kebutuhan Keuangan -->
     <div x-show="modalOpen" x-transition.opacity
         class="fixed top-0 left-0 w-screen h-screen bg-black/30 backdrop-blur-sm bg-opacity-60 z-[9999] flex items-center justify-center"
         style="display: none;">

         <!-- Modal Box -->
         <div @click.away="modalOpen = false"
             class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative max-h-[90vh] overflow-y-auto mx-4 sm:mx-auto">

             <!-- Tombol Close -->
             <button @click="modalOpen = false"
                 class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold">&times;</button>

             <h2 class="text-xl font-semibold mb-4 text-primary">Ajukan Kebutuhan Keuangan</h2>

             <!-- Form ajukan kebutuhan keuangan -->
             <form method="POST" action="{{ secure_url(route('submit.store', [], false)) }}"
                 enctype="multipart/form-data" class="space-y-4">
                 @csrf

                 <!-- Jenis Pengajuan -->
                 <div>
                     <label for="jenis" class="block text-gray-700 font-medium mb-1">Jenis Pengajuan</label>
                     <select id="jenis" name="jenis_pengajuan" required
                         class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary @error('jenis_pengajuan') border-red-500 @enderror">
                         <option value="" disabled {{ old('jenis_pengajuan') ? '' : 'selected' }}>Pilih
                             jenis pengajuan</option>
                         <option value="konsumtif" {{ old('jenis_pengajuan') == 'konsumtif' ? 'selected' : '' }}>
                             Konsumtif</option>
                         <option value="produktif" {{ old('jenis_pengajuan') == 'produktif' ? 'selected' : '' }}>
                             Produktif</option>
                         <option value="darurat" {{ old('jenis_pengajuan') == 'darurat' ? 'selected' : '' }}>
                             Darurat</option>
                     </select>
                     @error('jenis_pengajuan')
                         <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                     @enderror
                 </div>

                 <!-- Jumlah Dana -->
                 <div>
                     <label for="jumlah_dana" class="block text-gray-700 font-medium mb-1">Jumlah Dana
                         (Rp)</label>
                     <input type="number" id="jumlah_dana" name="jumlah_dana" min="500000" max="10000000" required
                         value="{{ old('jumlah_dana') }}"
                         class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary @error('jumlah_dana') border-red-500 @enderror"
                         placeholder="Contoh: 1500000 (maksimal Rp 10.000.000)" />
                     @error('jumlah_dana')
                         <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                     @enderror
                 </div>

                 <!-- No. REK -->
                 <div>
                     <label for="no_rek" class="block text-gray-700 font-medium mb-1">No. Rekening</label>
                     <input type="text" id="no_rek" name="no_rek" required
                         class="w-full border rounded px-3 py-2 bg-white-100 text-gray-700" />
                 </div>

                 <!-- Tanggal Jatuh Tempo (otomatis dari hari ini + 6 bulan + 7 hari) -->
                 <div>
                     <label for="jatuh_tempo" class="block text-gray-700 font-medium mb-1">Jatuh Tempo
                         Pengembalian</label>
                     <input type="text" id="jatuh_tempo" name="jatuh_tempo" readonly
                         class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700" />
                     <small class="text-gray-500 italic">Pengembalian dana maksimal 6 bulan + 7 hari dari
                         tanggal pengajuan</small>
                 </div>

                 <!-- Catatan terkait pencairan dan denda -->
                 <div class="bg-yellow-100 text-yellow-800 text-sm rounded p-3">
                     <p><strong>Catatan:</strong></p>
                     <ul class="list-disc list-inside">
                         <li>Kebutuhan keuangan ≤ Rp5.000.000: Dana akan cair <strong>hari ini juga</strong>.
                         </li>
                         <li>Kebutuhan keuangan > Rp5.000.000: Proses pencairan <strong>maksimal 3 hari</strong>.
                         </li>
                         <li>Keterlambatan pengembalian dana</strong>: Jika pengembalian dana melewati tanggal jatuh
                             tempo, akan
                             dikenakan <strong>denda 1% per minggu</strong> dari total kebutuhan keuangan.</li>
                     </ul>
                 </div>



                 <!-- Keterangan -->
                 <div>
                     <label for="deskripsi_penggunaan" class="block text-gray-700 font-medium mb-1">Keterangan</label>
                     <textarea id="deskripsi_penggunaan" name="deskripsi_penggunaan" rows="3"
                         class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary @error('deskripsi_penggunaan') border-red-500 @enderror"
                         placeholder="Tuliskan keterangan tambahan">{{ old('deskripsi_penggunaan') }}</textarea>
                     <small class="text-gray-500 italic">Contoh: Untuk modal usaha kopi keliling</small>
                     @error('deskripsi_penggunaan')
                         <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                     @enderror
                 </div>

                 <!-- Upload KTP -->
                 <div>
                     <label for="bukti_ktp" class="block text-gray-700 font-medium mb-1">Upload KTP</label>
                     <input type="file" id="bukti_ktp" name="bukti_ktp" accept="image/*,application/pdf" required
                         class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary @error('bukti_ktp') border-red-500 @enderror" />
                     <small class="text-gray-500 text-sm">Format JPG/PNG/PDF. Maksimal ukuran 1MB.</small>
                     @error('bukti_ktp')
                         <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                     @enderror
                 </div>

                 <!-- Upload Swafoto KTP -->
                 <div>
                     <label for="swafoto_ktp" class="block text-gray-700 font-medium mb-1">Upload Swafoto
                         dengan KTP</label>
                     <input type="file" id="swafoto_ktp" name="swafoto_ktp" accept="image/*" required
                         class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-primary @error('swafoto_ktp') border-red-500 @enderror" />
                     <small class="text-gray-500 text-sm">Format JPG/PNG. Maksimal ukuran 1MB.</small>
                     @error('swafoto_ktp')
                         <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                     @enderror
                 </div>


                 <!-- Tombol -->
                 <div class="flex justify-end gap-2 mt-6">
                     <button type="button" @click="modalOpen = false"
                         class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100">Batal</button>
                     <button type="submit"
                         class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-light">Ajukan</button>
                 </div>
             </form>
         </div>
     </div>
 @endsection
