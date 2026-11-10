document.addEventListener('alpine:init', () => {

Alpine.data('beritaApp', (dataBerita = []) => ({

    // ==========================================
    // SIDEBAR & MODAL
    // ==========================================

    sidebarOpen: false,

    modalOpen: false,

    isEdit: false,

    activeMenu: 'berita',


    // ==========================================
    // SEARCH & FILTER
    // ==========================================

    searchQuery: '',

    filterDate: '',


    // ==========================================
    // FORM
    // ==========================================

    form: {
        id_berita: null,
        judul_berita: '',
        deskripsi_berita: '',
        tanggal_upload: '',
        foto: ''
    },


    // ==========================================
    // DATA BERITA DARI DATABASE
    // ==========================================

    beritaList: dataBerita,


    // ==========================================
    // FILTER DATA BERITA
    // ==========================================

    get filteredBerita() {

        return this.beritaList.filter(item => {

            // Jika data kosong, jangan error
            const judul = item.judul_berita
                ? String(item.judul_berita).toLowerCase()
                : '';

            const deskripsi = item.deskripsi_berita
                ? String(item.deskripsi_berita).toLowerCase()
                : '';

            const tanggal = item.tanggal_upload
                ? String(item.tanggal_upload)
                : '';


            // Filter pencarian
            const cocokSearch =
                judul.includes(this.searchQuery.toLowerCase()) ||
                deskripsi.includes(this.searchQuery.toLowerCase());


            // Filter tanggal
            const cocokTanggal =
                this.filterDate === '' ||
                tanggal === this.filterDate;


            return cocokSearch && cocokTanggal;

        });

    },


    // ==========================================
    // MENU SIDEBAR
    // ==========================================

    menuItems: [

        {
            id: 'dashboard',
            label: 'Dashboard',
            link: '/admin/dashboard',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l9 6 9-6M3 7l9-6 9 6">
                </path>
            </svg>`
        },


        {
            id: 'profile',
            label: 'Profile',
            link: '/admin/profile',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7-7z">
                </path>
            </svg>`
        },


        {
            id: 'organigram',
            label: 'Organigram',
            link: '/admin/organigram',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0">
                </path>
            </svg>`
        },


        {
            id: 'anggota',
            label: 'Anggota',
            link: '/admin/anggota',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>`
        },


        {
            id: 'berita',
            label: 'Berita',
            link: '/admin/berita',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                </path>
            </svg>`
        },


        {
            id: 'prestasi',
            label: 'Prestasi',
            link: '/admin/prestasi',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                </path>
            </svg>`
        },


        {
            id: 'agenda',
            label: 'Agenda',
            link: '/admin/agenda',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>`
        },


        {
            id: 'galeri',
            label: 'Galeri',
            link: '/admin/galeri',
            icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>`
        }

    ],


    // ==========================================
    // BUKA MODAL TAMBAH
    // ==========================================

    openAddModal() {

        this.isEdit = false;

        this.form = {
            id_berita: null,
            judul_berita: '',
            deskripsi_berita: '',
            tanggal_upload: '',
            foto: ''
        };

        this.modalOpen = true;

    },


    // ==========================================
    // BUKA MODAL EDIT
    // ==========================================

    openEditModal(row) {

        this.isEdit = true;

        this.form = {
            id_berita: row.id_berita,
            judul_berita: row.judul_berita,
            deskripsi_berita: row.deskripsi_berita,
            tanggal_upload: row.tanggal_upload,
            foto: row.foto
        };

        this.modalOpen = true;

    },


    // ==========================================
    // SIMPAN FORM
    // ==========================================

    saveForm() {

        /*
         * Untuk TAMBAH data, penyimpanan sekarang
         * dilakukan oleh Laravel melalui form POST.
         *
         * Jadi fungsi ini tidak lagi digunakan
         * untuk memasukkan data dummy.
         */

        if (!this.isEdit) {

            this.modalOpen = false;

            return;

        }


        /*
         * Edit database akan kita sambungkan
         * melalui route PUT/PATCH Laravel.
         *
         * Untuk sementara tidak mengubah data
         * hanya di JavaScript.
         */

    },


    // ==========================================
    // HAPUS BERITA
    // ==========================================

    deleteBerita(id) {

        if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {

            const form = document.createElement('form');

            form.method = 'POST';

            form.action = `/admin/berita/${id}`;


            const csrf = document.createElement('input');

            csrf.type = 'hidden';

            csrf.name = '_token';

            csrf.value =
                document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';


            const method = document.createElement('input');

            method.type = 'hidden';

            method.name = '_method';

            method.value = 'DELETE';


            form.appendChild(csrf);

            form.appendChild(method);

            document.body.appendChild(form);

            form.submit();

        }

    }

}));

});
