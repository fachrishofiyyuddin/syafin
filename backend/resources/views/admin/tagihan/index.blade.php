 @extends('admin.layouts.app')

 @section('content')
     <!-- Pengembalian -->
     <section class="bg-white rounded shadow mt-8">

         <div x-data='tagihanModern(@json($bulanList), {{ $sudahDibayar }}, {{ $denda }})'
             class="max-w-2xl mx-auto p-4 space-y-6 text-gray-700">

             <h1 class="text-2xl font-bold text-primary mb-2">🧾 Pengembalian Dana Anda</h1>
             <p class="text-sm text-gray-500">Centang bulan yang ingin dibayar. Status dan total akan muncul
                 otomatis.</p>

             <!-- ℹ️ Info Edukasi -->
             <div class="bg-blue-50 border border-blue-200 text-blue-700 text-sm rounded p-4">
                 💡 <strong>Tips:</strong> Bayarlah tagihan Anda <u>sebelum tanggal jatuh tempo</u> untuk
                 menghindari denda tambahan.<br>
                 Jika terlambat membayar lebih dari <strong>7 hari setelah jatuh tempo</strong>, maka akan
                 dikenakan <strong>denda 1% per minggu</strong> dari total kebutuhan keuangan.
             </div>

             <!-- ⛔️ Notifikasi Denda -->
             @if ($denda > 0)
                 <div class="bg-red-100 border border-red-200 text-red-800 text-sm p-4 rounded shadow mb-4">
                     ⚠️ Anda terlambat membayar lebih dari <strong>7 hari</strong> setelah jatuh tempo
                     ({{ $jatuhTempo->format('d M Y') }}).<br>
                     Denda sebesar <strong>Rp{{ number_format($denda, 0, ',', '.') }}</strong> telah ditambahkan
                     ke tagihan Anda.<br>
                     Semakin lama Anda menunda pembayaran, semakin besar dendanya!
                 </div>
             @endif

             <!-- Daftar Bulan -->
             <div class="space-y-4">
                 <template x-for="(bulan, i) in bulanList" :key="i">
                     <label
                         class="block bg-white border rounded-lg shadow-sm p-4 flex items-center justify-between transition hover:shadow-md"
                         :class="bulan.status === 'lunas' ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'">
                         <div>
                             <h2 class="text-lg font-semibold" x-text="bulan.nama"></h2>
                             <p class="text-sm text-gray-500" x-text="'Rp' + format(bulan.nominal)"></p>
                         </div>
                         <template x-if="bulan.status === 'lunas'">
                             <span class="text-green-600 font-semibold">Lunas</span>
                         </template>
                         <template x-if="bulan.status !== 'lunas'">
                             <input type="checkbox" x-model="bulan.dipilih"
                                 class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                         </template>
                     </label>
                 </template>
             </div>

             <!-- Ringkasan Sticky -->
             <div class="sticky bottom-4 bg-white border rounded-xl shadow-lg p-4 z-50 space-y-3">
                 <div class="flex justify-between text-sm">
                     <span>Total Tagihan:</span>
                     <strong x-text="'Rp' + format(totalTagihan() + denda)"></strong>
                 </div>
                 <div class="flex justify-between text-sm text-green-600">
                     <span>Sudah Dibayar:</span>
                     <strong x-text="'Rp' + format(sudahDibayar)"></strong>
                 </div>
                 <div class="flex justify-between text-sm text-red-600">
                     <span>Denda (Jika Ada):</span>
                     <strong x-text="'Rp' + format(denda)"></strong>
                 </div>
                 <div class="flex justify-between text-base text-red-600 font-semibold border-t pt-2">
                     <span>Bayar Sekarang:</span>
                     <span x-text="'Rp' + format(totalBayarSekarang() + denda)"></span>
                 </div>

                 <button @click="bayarSekarang" :disabled="totalBayarSekarang() === 0"
                     class="w-full mt-2 py-3 text-white text-lg font-semibold rounded-lg transition-all flex justify-center items-center gap-2"
                     :class="totalBayarSekarang() === 0 ?
                         'bg-gray-300 cursor-not-allowed' :
                         'bg-emerald-600 hover:bg-emerald-700'">
                     💳 Bayar Sekarang
                 </button>
             </div>
         </div>

     </section>


     <script>
         function tagihanModern(bulanListFromLaravel, sudahDibayar, denda) {
             return {
                 bulanList: bulanListFromLaravel.map(b => ({
                     ...b,
                     dipilih: false
                 })),
                 sudahDibayar,
                 denda,

                 format(nom) {
                     return nom.toLocaleString('id-ID');
                 },
                 totalTagihan() {
                     const totalBulan = this.bulanList.reduce((sum, b) => sum + b.nominal, 0);
                     return totalBulan + this.denda;
                 },
                 totalBayarSekarang() {
                     const total = this.bulanList
                         .filter(b => b.dipilih && b.status !== 'lunas')
                         .reduce((sum, b) => sum + b.nominal, 0);
                     return total + (this.denda > 0 ? this.denda : 0);
                 },
                 async bayarSekarang() {
                     const bulanDipilih = this.bulanList
                         .filter(b => b.dipilih && b.status !== 'lunas')
                         .map(b => b.format); // "2025-07", dsb

                     const res = await fetch("{{ secure_url(route('bayar.sekarang', [], false)) }}", {
                         method: 'POST',
                         headers: {
                             'Content-Type': 'application/json',
                             'X-CSRF-TOKEN': '{{ csrf_token() }}',
                         },
                         body: JSON.stringify({
                             pengajuan_id: {{ $pengajuan->id }},
                             total: this.totalBayarSekarang(),
                             bulan: bulanDipilih
                         })
                     });

                     const data = await res.json();

                     window.snap.pay(data.token, {
                         onSuccess: function(result) {
                             fetch("{{ secure_url(route('pembayaran.updateStatus', [], false)) }}", {
                                     method: 'POST',
                                     headers: {
                                         'Content-Type': 'application/json',
                                         'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                     },
                                     body: JSON.stringify({
                                         pengajuan_id: {{ $pengajuan->id }}
                                     })
                                 })
                                 .then(response => response.json())
                                 .then(res => {
                                     alert('Pembayaran berhasil dan status diupdate!');
                                     window.location.reload();
                                 })
                                 .catch(err => {
                                     alert('Pembayaran berhasil, tapi gagal update status!');
                                 });
                         },
                         onPending: function(result) {
                             alert('Menunggu pembayaran...');
                         },
                         onError: function(result) {
                             alert('Pembayaran gagal!');
                         },
                         onClose: function() {
                             alert('Pembayaran dibatalkan!');
                         }
                     });
                 }
             }
         }
     </script>
 @endsection
