document.addEventListener('alpine:init', () => {
    Alpine.data('prestasiApp', () => ({
        sidebarOpen: false,
        modalOpen: false,
        isEdit: false,
        searchQuery: '',
        filterDate: '',
        activeMenu: 'prestasi', // Menandai menu 'Prestasi' aktif di sidebar

        // Form Model
        form: {
            id: null,
            nama: '',
            tingkat: 'Kab. Purwakarta',
            bidang: '',
            tanggal: '',
            deskripsi: '',
            gambar: ''
        },

        // Data Dummy Prestasi
        prestasiList: [
            { id: 1, nama: 'FLS3N', tingkat: 'Kab. Purwakarta', bidang: 'Kabaret', tanggal: '17 Juli 2026', deskripsi: 'blablablabla', gambar: '' },
            { id: 2, nama: 'FLS3N', tingkat: 'Kab. Purwakarta', bidang: 'Kabaret', tanggal: '17 Juli 2026', deskripsi: 'blablablabla', gambar: '' }
        ],

        // Filter Pencarian Prestasi
        get filteredPrestasi() {
            return this.prestasiList.filter(item => {
                return item.nama.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                       item.bidang.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                       item.tingkat.toLowerCase().includes(this.searchQuery.toLowerCase());
            });
        },

        // Menu Items Navigasi Sidebar
        menuItems: [
            { id: 'dashboard', label: 'Dashboard', link: '/admin/dashboard', icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M3 7l9 6 9-6M3 7l9-6 9 6"></path></svg>` },
            { id: 'profile', label: 'Profile', link: '/admin/profile', icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>` },
            { id: 'organigram', label: 'Organigram', link: '/admin/organigram', icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"></path></svg>` },
            { id: 'anggota', label: 'Anggota', link: '/admin/anggota', icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>` },
            { id: 'berita', label: 'Berita', link: '/admin/berita', icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>` },
            { id: 'prestasi', label: 'Prestasi', link: '/admin/prestasi', icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>` },
            { id: 'agenda', label: 'Agenda', link: '/admin/agenda', icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>` },
            { id: 'galeri', label: 'Galeri', link: '/admin/galeri', icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>` }
        ],

        // Modal Handlers
        openAddModal() {
            this.isEdit = false;
            this.form = { id: Date.now(), nama: '', tingkat: 'Kab. Purwakarta', bidang: '', tanggal: '17 Juli 2026', deskripsi: 'blablablabla', gambar: '' };
            this.modalOpen = true;
        },

        openEditModal(row) {
            this.isEdit = true;
            this.form = { ...row };
            this.modalOpen = true;
        },

        saveForm() {
            if (this.isEdit) {
                const idx = this.prestasiList.findIndex(item => item.id === this.form.id);
                if (idx !== -1) {
                    this.prestasiList[idx] = { ...this.form };
                }
            } else {
                this.prestasiList.push({ ...this.form });
            }
            this.modalOpen = false;
        },

        deletePrestasi(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data prestasi ini?')) {
                this.prestasiList = this.prestasiList.filter(item => item.id !== id);
            }
        }
    }));
});