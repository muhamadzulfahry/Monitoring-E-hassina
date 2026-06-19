<div id="modalTambah" class="fixed inset-0 bg-gray-900/60 backdrop-blur-xs hidden items-center justify-center p-4 z-50 transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full overflow-hidden border border-gray-100 transform transition-all duration-300 scale-100">
        
        <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-lg font-bold text-gray-900">Tambah Log Absensi Guru</h3>
                <p class="text-xs text-gray-500">Silakan lengkapi formulir kegiatan mengajar.</p>
            </div>
            <button onclick="toggleModal(false)" class="text-gray-400 hover:text-gray-600 text-xl cursor-pointer">&times;</button>
        </div>

        <form action="proses_simpan.php" method="POST" enctype="multipart/form-data" onsubmit="siapkanKirimForm(event)" class="p-6 space-y-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Nama Lengkap Guru</label>
                <input type="text" name="nama_guru" required placeholder="Nama Guru" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Mata Pelajaran</label>
                <input type="text" name="mata_pelajaran" required placeholder="Contoh: Pemrograman Web" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Jumlah Jam Kerja</label>
                    <input type="number" name="jam_kerja" required placeholder="0" class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal" required class="w-full px-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Upload File Bukti</label>
                <input type="file" name="file_bukti" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1">Tanda Tangan Digital Guru (Animasi Sketsa)</label>
                <div class="relative bg-gray-50 border border-gray-200 rounded-xl overflow-hidden shadow-inner group">
                    <canvas id="canvasTtd" class="w-full h-36 block touch-none cursor-crosshair bg-white transition-colors duration-200 focus:bg-blue-50/20"></canvas>
                    
                    <button type="button" onclick="bersihkanCanvasDenganSuara()" class="absolute bottom-2 right-2 bg-slate-800 hover:bg-slate-900 active:scale-95 text-white font-bold text-[10px] px-2.5 py-1.5 rounded-lg transition-all shadow-md flex items-center gap-1 cursor-pointer">
                        🧹 Bersihkan
                    </button>
                </div>
                <input type="hidden" name="tanda_tangan" id="inputTtdBase64">
            </div>

            <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                <button type="button" onclick="toggleModal(false)" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold px-4 py-2 rounded-xl text-sm transition cursor-pointer">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-xl text-sm shadow-md transition-all active:scale-95 flex items-center gap-1.5 cursor-pointer">💾 Simpan Log Absensi</button>
            </div>
        </form>
    </div>
</div>

<script>
    const canvas = document.getElementById('canvasTtd');
    const ctx = canvas.getContext('2d');
    let sedangMenggambar = false;

    // Load Efek Suara (Audio) Penghapus menggunakan CDN publik yang aman
    const audioSwoosh = new Audio('https://assets.mixkit.co/active_storage/sfx/2568/2568-600.wav');
    audioSwoosh.volume = 0.4;

    function resizeCanvas() {
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = rect.height;
        ctx.strokeStyle = '#2563eb'; // Warna TTD Biru Premium
        ctx.lineWidth = 3;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
    }

    // Algoritma Tracking Gambar Animasi Linear
    canvas.addEventListener('mousedown', (e) => { sedangMenggambar = true; gambar(e); });
    canvas.addEventListener('mousemove', gambar);
    window.addEventListener('mouseup', () => sedangMenggambar = false);

    canvas.addEventListener('touchstart', (e) => { sedangMenggambar = true; gambar(e); });
    canvas.addEventListener('touchmove', gambar);
    window.addEventListener('touchend', () => sedangMenggambar = false);

    function gambar(e) {
        if (!sedangMenggambar) return;
        e.preventDefault();

        const rect = canvas.getBoundingClientRect();
        let clientX = e.clientX || (e.touches && e.touches[0].clientX);
        let clientY = e.clientY || (e.touches && e.touches[0].clientY);

        const x = clientX - rect.left;
        const y = clientY - rect.top;

        if (e.type === 'mousedown' || e.type === 'touchstart') {
            ctx.beginPath();
            ctx.moveTo(x, y);
        } else {
            ctx.lineTo(x, y);
            ctx.stroke();
        }
    }

    // Penerapan AUDIO: Membersihkan papan dengan suara desiran kertas bersih
    function bersihkanCanvasDenganSuara() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        audioSwoosh.play().catch(err => console.log("Audio dimainkan"));
    }

    function siapkanKirimForm(e) {
        const ttdKosong = isCanvasBlank(canvas);
        if (!ttdKosong) {
            document.getElementById('inputTtdBase64').value = canvas.toDataURL('image/png');
        } else {
            document.getElementById('inputTtdBase64').value = '';
        }
    }

    function isCanvasBlank(canvas) {
        const blank = document.createElement('canvas');
        blank.width = canvas.width;
        blank.height = canvas.height;
        return canvas.toDataURL() === blank.toDataURL();
    }
</script>
