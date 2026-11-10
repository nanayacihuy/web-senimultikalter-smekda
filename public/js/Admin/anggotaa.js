document.addEventListener('alpine:init', () => {

        Alpine.data('anggotaApp', () => ({

            sidebarOpen: false,
            modalOpen: false,
            isEdit: false,
            activeMenu: 'anggota',

            form: {
                id: null,
                nama: '',
                kelas: '',
                bidang: ''
            },

            menuItems: [
                {
                    id: 'dashboard',
                    label: 'Dashboard',
                    link: '/admin/dashboard',
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l9 6 9-6"/>
                    </svg>`
                },

                {
                    id: 'profile',
                    label: 'Profile',
                    link: '/admin/profile',
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>`
                },

                {
                    id: 'organigram',
                    label: 'Organigram',
                    link: '/admin/organigram',
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/>
                    </svg>`
                },

                {
                    id: 'anggota',
                    label: 'Anggota',
                    link: '/admin/anggota',
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>`
                },

                {
                    id: 'berita',
                    label: 'Berita',
                    link: '/admin/berita',
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>`
                },

                {
                    id: 'prestasi',
                    label: 'Prestasi',
                    link: '/admin/prestasi',
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>`
                },

                {
                    id: 'agenda',
                    label: 'Agenda',
                    link: '/admin/agenda',
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>`
                },

                {
                    id: 'galeri',
                    label: 'Galeri',
                    link: '/admin/galeri',
                    icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>`
                }
            ],

            /*
            |--------------------------------------------------------------------------
            | MODAL TAMBAH
            |--------------------------------------------------------------------------
            */

            openAddModal() {

                this.isEdit = false;

                this.form = {
                    id: null,
                    nama: '',
                    kelas: '',
                    bidang: ''
                };

                this.modalOpen = true;

                setTimeout(() => {
                    const input = document.getElementById('nama_anggota');

                    if (input) {
                        input.focus();
                    }
                }, 100);
            },

            /*
            |--------------------------------------------------------------------------
            | MODAL EDIT
            |--------------------------------------------------------------------------
            */

            openEditModal(row) {

                this.isEdit = true;

                this.form = {
                    id: row.id,
                    nama: row.nama,
                    kelas: row.kelas,
                    bidang: row.bidang
                };

                this.modalOpen = true;

                setTimeout(() => {
                    const input = document.getElementById('nama_anggota');

                    if (input) {
                        input.focus();
                    }
                }, 100);
            },

            /*
            |--------------------------------------------------------------------------
            | TUTUP MODAL
            |--------------------------------------------------------------------------
            */

            closeModal() {

                this.modalOpen = false;

                this.form = {
                    id: null,
                    nama: '',
                    kelas: '',
                    bidang: ''
                };
            },

            /*
            |--------------------------------------------------------------------------
            | SIMPAN DATA
            |--------------------------------------------------------------------------
            */

            saveForm() {

                const form = document.getElementById('anggotaForm');

                if (!form) {
                    console.error('Form anggota tidak ditemukan.');
                    return;
                }

                if (!this.form.nama.trim()) {
                    alert('Nama anggota wajib diisi.');
                    return;
                }

                if (!this.form.kelas.trim()) {
                    alert('Kelas wajib diisi.');
                    return;
                }

                if (!this.form.bidang.trim()) {
                    alert('Bidang seni wajib diisi.');
                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | TAMBAH
                |--------------------------------------------------------------------------
                */

                if (!this.isEdit) {

                    form.action = "{{ route('admin.anggota.store') }}";

                    document.getElementById('methodInput').value = 'POST';
                }

                /*
                |--------------------------------------------------------------------------
                | EDIT
                |--------------------------------------------------------------------------
                */

                else {

                    form.action =
                        "{{ url('/admin/anggota') }}/" + this.form.id;

                    document.getElementById('methodInput').value = 'PUT';
                }

                /*
                |--------------------------------------------------------------------------
                | Isi input HTML
                |--------------------------------------------------------------------------
                */

                document.getElementById('nama_anggota').value =
                    this.form.nama;

                document.getElementById('kelas_anggota').value =
                    this.form.kelas;

                document.getElementById('bidang_anggota').value =
                    this.form.bidang;

                /*
                |--------------------------------------------------------------------------
                | Submit ke Laravel
                |--------------------------------------------------------------------------
                */

                form.submit();
            },

            /*
            |--------------------------------------------------------------------------
            | HAPUS
            |--------------------------------------------------------------------------
            */

            deleteAnggota(id) {

                if (!confirm(
                    'Apakah Anda yakin ingin menghapus data anggota ini?'
                )) {
                    return;
                }

                const form = document.getElementById(
                    'delete-form-' + id
                );

                if (form) {
                    form.submit();
                }
            }

        }));

    });


    /*
    |--------------------------------------------------------------------------
    | MODAL JAVASCRIPT
    |--------------------------------------------------------------------------
    */

    document.addEventListener('DOMContentLoaded', function () {

        const modalOverlay =
            document.getElementById('modalOverlay');

        const modalTitle =
            document.getElementById('modalTitle');

        const anggotaForm =
            document.getElementById('anggotaForm');

        const methodInput =
            document.getElementById('methodInput');

        const namaInput =
            document.getElementById('nama_anggota');

        const kelasInput =
            document.getElementById('kelas_anggota');

        const bidangInput =
            document.getElementById('bidang_anggota');

        const btnTambah =
            document.getElementById('btnTambah');

        const btnBatal =
            document.getElementById('btnBatal');


        /*
        |--------------------------------------------------------------------------
        | TAMBAH DATA
        |--------------------------------------------------------------------------
        */

        if (btnTambah) {

            btnTambah.addEventListener('click', function () {

                modalTitle.textContent =
                    'Tambah Data Anggota';

                anggotaForm.action =
                    "{{ route('admin.anggota.store') }}";

                methodInput.value = 'POST';

                namaInput.value = '';
                kelasInput.value = '';
                bidangInput.value = '';

                modalOverlay.classList.add('show');

                setTimeout(() => {
                    namaInput.focus();
                }, 100);
            });
        }


        /*
        |--------------------------------------------------------------------------
        | EDIT DATA
        |--------------------------------------------------------------------------
        */

        window.bukaModalEdit = function (
            id,
            nama,
            kelas,
            bidang
        ) {

            modalTitle.textContent =
                'Ubah Data Anggota';

            anggotaForm.action =
                "{{ url('/admin/anggota') }}/" + id;

            methodInput.value = 'PUT';

            namaInput.value = nama;
            kelasInput.value = kelas;
            bidangInput.value = bidang;

            modalOverlay.classList.add('show');

            setTimeout(() => {
                namaInput.focus();
            }, 100);
        };


        /*
        |--------------------------------------------------------------------------
        | TUTUP MODAL
        |--------------------------------------------------------------------------
        */

        window.tutupModal = function () {

            modalOverlay.classList.remove('show');
        };


        /*
        |--------------------------------------------------------------------------
        | BATAL
        |--------------------------------------------------------------------------
        */

        if (btnBatal) {

            btnBatal.addEventListener('click', function () {

                tutupModal();
            });
        }


        /*
        |--------------------------------------------------------------------------
        | KLIK AREA LUAR MODAL
        |--------------------------------------------------------------------------
        */

        if (modalOverlay) {

            modalOverlay.addEventListener('click', function (event) {

                if (event.target === modalOverlay) {

                    tutupModal();
                }
            });
        }


        /*
        |--------------------------------------------------------------------------
        | ESCAPE
        |--------------------------------------------------------------------------
        */

        document.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {

                tutupModal();
            }
        });

    });