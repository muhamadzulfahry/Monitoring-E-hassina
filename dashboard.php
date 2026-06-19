<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

function ambilKolom($row, $pilihan_nama) {
    foreach ($pilihan_nama as $nama) {
        if (isset($row[$nama])) return $row[$nama];
    }
    foreach ($row as $key => $value) {
        if (in_array(strtolower($key), array_map('strtolower', $pilihan_nama))) {
            return $value;
        }
    }
    return '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard E-Hassina</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        /* POIN ANIMASI: Membuat teks logo E-Hassina berdenyut & berubah warna neon */
        @keyframes glowPulse {
            0%, 100% { text-shadow: 0 0 4px rgba(255,255,255,0.6); transform: scale(1); }
            50% { text-shadow: 0 0 16px #38bdf8, 0 0 20px #38bdf8; transform: scale(1.03); }
        }
        .animate-logo {
            display: inline-block;
            animation: glowPulse 3s infinite ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen text-gray-800">

   <nav class="relative bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 text-white shadow-lg p-4 overflow-hidden">
        
        <div class="absolute -top-10 -left-10 w-40 h-40 bg-sky-400/20 rounded-full blur-2xl animate-pulse"></div>
        <div class="absolute -bottom-10 right-1/4 w-60 h-20 bg-indigo-400/20 rounded-full blur-xl animate-bounce duration-[6000ms]"></div>

        <div class="relative max-w-7xl mx-auto flex justify-between items-center z-10">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center bg-white/10 backdrop-blur-md p-2 rounded-xl border border-white/20 shadow-inner group">
                    <svg class="w-5 h-5 text-sky-300 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-black tracking-wide flex items-center gap-1.5">
                        <span class="animate-logo text-transparent bg-clip-text bg-gradient-to-r from-sky-200 to-white drop-shadow-[0_2px_8px_rgba(56,189,248,0.4)]">E-Hassina</span> 
                        <span class="text-blue-100 font-light text-lg hidden sm:inline">| Monitoring System</span>
                    </h1>
                </div>
                <span class="ml-2 hidden md:flex items-center gap-1.5 bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-ping"></span>
                    Live Connected
                </span>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/10 text-sm font-medium shadow-sm">
                    <div class="w-2 h-2 bg-sky-400 rounded-full shadow-[0_0_8px_#38bdf8]"></div>
                    <span class="text-blue-50 text-xs">User: <strong class="text-white font-semibold"><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                </div>
                <a href="logout.php" class="bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-4 py-1.5 rounded-xl text-xs font-bold tracking-wide shadow-md hover:shadow-red-500/20 transition-all active:scale-95 duration-200">
                    Keluar
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto p-6">
        
        <div class="mb-8 bg-gradient-to-r from-slate-900 to-indigo-950 rounded-2xl p-6 shadow-lg border border-slate-800 flex flex-col md:flex-row items-center gap-6">
            <div class="w-full md:w-2/5">
                <div class="relative pb-[56.25%] h-0 rounded-xl overflow-hidden shadow-2xl border border-slate-700">
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full" 
                        src="https://www.youtube.com/embed/Yss0AUX6t9o?autoplay=0&mute=0&loop=1&playlist=Yss0AUX6t9o" 
                        title="King Promise - Paris" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
            <div class="w-full md:w-3/5 text-center md:text-left">
                <span class="bg-amber-400/20 text-amber-400 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                    🎵 Multimedia Player System
                </span>
                <h3 class="text-xl font-bold text-white mt-2 mb-1">King Promise - Paris (Official Audio/Video)</h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Fitur pemutar video dan audio bawaan sistem E-Hassina untuk pengujian elemen kompetensi multimedia (Animasi, Video, dan Audio) sesuai parameter instrumen ujian meja.
                </p>
                <div class="mt-4 flex flex-wrap gap-2 justify-center md:justify-start">
                    <span class="bg-slate-800 text-slate-300 text-xs px-3 py-1 rounded-md border border-slate-700">✅ Video Stream Aktif</span>
                    <span class="bg-slate-800 text-slate-300 text-xs px-3 py-1 rounded-md border border-slate-700">✅ Audio Output Stereo</span>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Data Log Mengajar Guru</h2>
                <p class="text-sm text-gray-500">Kelola jam mengajar harian, verifikasi dokumen, dan tanda tangan digital.</p>
            </div>
            <button onclick="toggleModal(true)" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-sm shadow-md transition flex items-center gap-2 cursor-pointer">
                + Tambah Log Absensi
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <th class="p-4 w-16">No</th>
                            <th class="p-4">Nama Guru</th>
                            <th class="p-4">Mata Pelajaran</th>
                            <th class="p-4">Jam Kerja</th>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Tanda Tangan</th>
                            <th class="p-4">File Bukti</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php 
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM absensi ORDER BY id DESC"); 
                        
                        if($query && mysqli_num_rows($query) > 0) {
                            while($row = mysqli_fetch_array($query)) { 
                                $id_data        = ambilKolom($row, ['id', 'ID']);
                                $nama_guru      = ambilKolom($row, ['nama_guru', 'Nama_Guru', 'nama']);
                                $mata_pelajaran = ambilKolom($row, ['mata_pelajaran', 'Mata_Pelajaran', 'mapel']);
                                $jam_kerja      = ambilKolom($row, ['jam_kerja', 'Jam_Kerja', 'jam']);
                                $tanggal        = ambilKolom($row, ['tanggal', 'Tanggal', 'tgl']);
                                $file_bukti     = ambilKolom($row, ['file_bukti', 'File_Bukti', 'bukti']);
                                $tanda_tangan   = ambilKolom($row, ['tanda_tangan', 'Tanda_Tangan', 'ttd']);
                        ?>
                            <tr class="hover:bg-gray-50/70 transition">
                                <td class="p-4 text-sm font-medium text-gray-600"><?php echo $no++; ?></td>
                                <td class="p-4 text-sm font-semibold text-gray-900"><?php echo htmlspecialchars($nama_guru); ?></td>
                                <td class="p-4 text-sm text-gray-600"><?php echo htmlspecialchars($mata_pelajaran); ?></td>
                                <td class="p-4 text-sm">
                                    <span class="bg-blue-50 text-blue-700 text-xs font-bold px-2.5 py-1 rounded-md">
                                        <?php echo htmlspecialchars($jam_kerja ? $jam_kerja : '0'); ?> Jam
                                    </span>
                                </td>
                                <td class="p-4 text-sm text-gray-600">
                                    <?php echo $tanggal ? date('d M Y', strtotime($tanggal)) : '30 Nov -0001'; ?>
                                </td>
                                <td class="p-4 text-sm">
                                    <?php if(!empty($tanda_tangan)): ?>
                                        <div class="inline-block transition-all duration-300 ease-in-out hover:scale-110 hover:shadow-xl hover:shadow-blue-500/40 rounded-lg p-0.5 group">
                                            <img src="<?php echo $tanda_tangan; ?>" alt="TTD" class="h-10 w-auto bg-white border border-gray-200 rounded p-1 max-w-[120px] mix-blend-multiply group-hover:border-blue-500 transition-colors">
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-400 italic text-xs">Belum TTD</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-sm">
                                    <?php if(!empty($file_bukti)): ?>
                                        <a href="uploads/<?php echo $file_bukti; ?>" target="_blank" class="text-blue-600 hover:underline font-medium">Lihat Berkas</a>
                                    <?php else: ?>
                                        <span class="text-gray-400 italic text-xs">Tidak ada berkas</span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4 text-sm text-center">
                                    <a href="proses_hapus.php?id=<?php echo $id_data; ?>" onclick="return confirm('Yakin ingin menghapus data log ini, Zar?')" class="bg-red-100 hover:bg-red-200 text-red-600 font-bold px-3 py-1.5 rounded-lg text-xs transition">
                                        ❌ Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="8" class="p-8 text-center text-sm text-gray-400 italic">Belum ada data log absensi.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php include 'modal_tambah.php'; ?>

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('modalTambah');
            if (show) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                if (typeof resizeCanvas === 'function') { resizeCanvas(); }
            } else {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sistem_informasi";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-Hassina</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-sm border border-gray-100">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">E-Hassina</h2>
            <p class="text-sm text-gray-500">Monitoring Log Mengajar Guru</p>
        </div>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal') : ?>
            <div class="bg-red-50 text-red-600 border border-red-200 p-3 rounded-xl text-sm mb-4 text-center font-medium">
                Username atau password salah!
            </div>
        <?php endif; ?>

        <form action="proses_login.php" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wider">Username</label>
                <input type="text" name="username" required placeholder="Masukkan username" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-1 tracking-wider">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-xl text-sm shadow-md transition-all cursor-pointer">
                Masuk ke Dashboard
            </button>
        </form>
    </div>

</body>
</html>
<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: login.php");
exit;
?>
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
<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    $query = "DELETE FROM absensi WHERE id = '$id'";
    $eksekusi = mysqli_query($koneksi, $query);

    if ($eksekusi) {
        header("Location: dashboard.php?pesan=hapussukses");
        exit;
    } else {
        die("Gagal menghapus data: " . mysqli_error($koneksi));
    }
} else {
    header("Location: dashboard.php?pesan=idkosong");
    exit;
}
?>
<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: login.php?pesan=gagal");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_guru      = mysqli_real_escape_string($koneksi, $_POST['nama_guru']);
    $mata_pelajaran = mysqli_real_escape_string($koneksi, $_POST['mata_pelajaran']);
    $jam_kerja      = mysqli_real_escape_string($koneksi, $_POST['jam_kerja']);
    $tanggal        = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $tanda_tangan   = isset($_POST['tanda_tangan']) ? mysqli_real_escape_string($koneksi, $_POST['tanda_tangan']) : '';

    $file_bukti = "";
    if (isset($_FILES['file_bukti']) && $_FILES['file_bukti']['error'] == 0) {
        $nama_file = time() . '_' . $_FILES['file_bukti']['name'];
        $tmp_file  = $_FILES['file_bukti']['tmp_name'];
        $folder    = "uploads/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file($tmp_file, $folder . $nama_file)) {
            $file_bukti = $nama_file;
        }
    }

    $query = "INSERT INTO absensi (nama_guru, mata_pelajaran, jam_kerja, tanggal, file_bukti, tanda_tangan) 
              VALUES ('$nama_guru', '$mata_pelajaran', '$jam_kerja', '$tanggal', '$file_bukti', '$tanda_tangan')";
    
    $eksekusi = mysqli_query($koneksi, $query);

    if ($eksekusi) {
        header("Location: dashboard.php?pesan=simpansukses");
        exit;
    } else {
        die("Gagal menyimpan data ke database: " . mysqli_error($koneksi));
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>
