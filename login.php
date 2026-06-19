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
