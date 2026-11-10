<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya | Seni Multikalter</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Custom JS (Alpine component: akunApp) -->
    <script src="{{ asset('js/admin/akun.js') }}"></script>
</head>
<body class="bg-[#4A0000] font-sans antialiased" x-data="akunApp()">
    @include('components.admin.navbar')
    <div class="flex pt-20 flex-1">
        @include('components.admin.sidebar')
        <!-- =====================================================
             MAIN CONTENT
        ====================================================== -->
        <main class="flex-1 p-6 md:p-8 bg-white rounded-tl-3xl min-h-[calc(100vh-5rem)] md:ml-64">
            <h2 class="text-3xl font-bold text-[#4A0000] mb-1">Akun Saya</h2>
            <p class="text-sm text-gray-500 mb-6">
                Kelola nama, username, dan password akun admin Anda sendiri.
            </p>
            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            <!-- VALIDATION ERROR -->
            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- =====================================================
                 FORM AKUN
            ====================================================== -->
            <form
                action="{{ route('admin.akun.update') }}"
                method="POST"
                class="max-w-xl space-y-5 bg-[#FDF7F7] border border-[#e6c9c9] rounded-2xl p-6">
                @csrf
                @method('PUT')
                <!-- NAMA -->
                <div>
                    <label class="block text-sm font-bold text-[#4A0000] mb-1">Nama Lengkap</label>
                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama', $admin->nama ?? '') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A0000] text-sm"
                        required>
                </div>
                <!-- USERNAME -->
                <div>
                    <label class="block text-sm font-bold text-[#4A0000] mb-1">Username</label>
                    <input
                        type="text"
                        name="username"
                        value="{{ old('username', $admin->username ?? '') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A0000] text-sm"
                        required>
                </div>
                <!-- PASSWORD -->
                <div>
                    <label class="block text-sm font-bold text-[#4A0000] mb-1">Password Baru</label>
                    <div class="relative">
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            name="password"
                            placeholder="Kosongkan jika tidak ingin mengganti password"
                            class="w-full px-4 py-2.5 pr-11 rounded-lg border border-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A0000] text-sm">
                        <button
                            type="button"
                            @click="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-lg"
                            tabindex="-1">
                            <span x-show="!showPassword">👁</span>
                            <span x-show="showPassword" style="display:none;">🙈</span>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        Minimal 6 karakter. Kosongkan bila tidak ingin mengubah password.
                    </p>
                </div>
                <!-- SUBMIT -->
                <button
                    type="submit"
                    class="bg-[#4A0000] text-white font-semibold px-6 py-2.5 rounded-lg hover:bg-[#660000] transition">Simpan Perubahan</button>
            </form>
        </main>
    </div>
</body>
</html>