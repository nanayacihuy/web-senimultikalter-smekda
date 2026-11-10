function parseAngkatanHelper(kelas) {
    if (!kelas) return "-";
    const text = kelas.toString().toUpperCase().trim();
    if (/\bXII\b/.test(text) || text.startsWith("12")) return "12";
    if (/\bXI\b/.test(text) || text.startsWith("11")) return "11";
    if (/\bX\b/.test(text) || text.startsWith("10")) return "10";
    return "12";
}
function parseAnggotaData(data = []) {
    if (!Array.isArray(data)) return [];
    return data.map(item => ({
        id: item.id || item.id_anggota || Math.random(),
        nama: item.nama || item.nama_anggota || "-",
        bidang: item.bidang || item.bidang_anggota || "-",
        kelas: item.kelas || item.kelas_anggota || "-",
        angkatan:
            item.angkatan ||
            parseAngkatanHelper(
                item.kelas || item.kelas_anggota
            ),
        status: item.status || "Aktif"
    }));
}
function anggotaApp(data = []) {
    return {
        anggota: parseAnggotaData(data),
        setData(newData) {
            this.anggota = parseAnggotaData(newData);
            this.currentPage = 1;
        },
        /* =====================================================
           FILTER
        ====================================================== */
        search: "",
        bidang: "",
        angkatan: "",
        /* =====================================================
           PAGINATION
        ====================================================== */
        currentPage: 1,
        perPage: 6,
        /* =====================================================
           AMBIL ANGKATAN DARI KELAS
        ====================================================== */
        getAngkatan(kelas) {
            if (!kelas) return "-";
            const text = kelas.toString().toUpperCase().trim();
            /* Cari X, XI, atau XII sebagai tingkat kelas. */
            if (/\bXII\b/.test(text)) return "12";
            if (/\bXI\b/.test(text)) return "11";
            if (/\bX\b/.test(text)) return "10";
            return "-";
        },
        /* =====================================================
           COMPUTED FILTER
        ====================================================== */
        get filtered() {
            const keyword = this.search.toLowerCase().trim();
            return this.anggota.filter(item => {
                const matchSearch =
                    !keyword ||
                    item.nama.toLowerCase().includes(keyword) ||
                    item.bidang.toLowerCase().includes(keyword) ||
                    item.kelas.toLowerCase().includes(keyword);
                const matchBidang =
                    !this.bidang ||
                    item.bidang === this.bidang;
                const matchAngkatan =
                    !this.angkatan ||
                    item.angkatan === this.angkatan;
                return (
                    matchSearch &&
                    matchBidang &&
                    matchAngkatan
                );
            });
        },
        /* =====================================================
           TOTAL BIDANG
        ====================================================== */
        get totalBidang() {
            return new Set(
                this.anggota.map(item => item.bidang)
            ).size;
        },
        get daftarBidang() {
            const defaults = [
                "Vokal",
                "Tari Tradisi",
                "Modern Dance",
                "ASIK",
                "Kabaret"
            ];
            const fromData = this.anggota
                .map(item => item.bidang)
                .filter(Boolean);
            return Array.from(
                new Set([...defaults, ...fromData])
            ).sort();
        },
        get daftarAngkatan() {
            const fromData = this.anggota
                .map(item => item.angkatan)
                .filter(
                    a => a && a !== "-"
                );
            const defaults = ["10", "11", "12"];
            return Array.from(
                new Set([...defaults, ...fromData])
            ).sort();
        },
        /* =====================================================
           TOTAL ANGKATAN
        ====================================================== */
        get totalAngkatan() {
            return new Set(
                this.anggota
                    .map(item => item.angkatan)
                    .filter(angkatan => angkatan !== "-")
            ).size;
        },
        /* =====================================================
           TOTAL AKTIF
        ====================================================== */
        get totalAktif() {
            /*
             * Karena database belum memiliki kolom status,
             * semua anggota dianggap aktif.
             */

            return this.anggota.length;
        },
        /* =====================================================
           TOTAL PAGE
        ====================================================== */
        get totalPages() {
            return Math.ceil(
                this.filtered.length / this.perPage
            );
        },
        /* =====================================================
           START INDEX
        ====================================================== */
        get startIndex() {
            return (
                (this.currentPage - 1) *
                this.perPage
            );
        },
        /* =====================================================
           PAGINATED DATA
        ====================================================== */
        get paginated() {
            const start = this.startIndex;
            const end = start + this.perPage;
            return this.filtered.slice(start, end);
        },
        /* =====================================================
           INITIAL NAMA
        ====================================================== */
        initial(nama) {
            if (!nama) return "?";
            const words = nama.trim().split(" ");
            if (words.length === 1) {
                return words[0]
                    .substring(0, 2)
                    .toUpperCase();
            }
            return (
                words[0][0] +
                words[1][0]
            ).toUpperCase();
        },
        /* =====================================================
           RESET
        ====================================================== */
        reset() {
            this.search = "";
            this.bidang = "";
            this.angkatan = "";
            this.currentPage = 1;
        },
        /* =====================================================
           GO TO PAGE
        ====================================================== */
        goToPage(page) {
            if (
                page >= 1 &&
                page <= this.totalPages
            ) {
                this.currentPage = page;
                this.scrollToTable();
            }
        },
        /* =====================================================
           NEXT PAGE
        ====================================================== */
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
                this.scrollToTable();
            }
        },
        /* =====================================================
           PREVIOUS PAGE
        ====================================================== */
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.scrollToTable();
            }
        },
        /* =====================================================
           SCROLL TABLE
        ====================================================== */
        scrollToTable() {
            const table = document.querySelector(
                ".member-table-wrapper"
            );
            if (table) {
                table.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }
        },
        /* =====================================================
           INIT
        ====================================================== */
        init() {
            /*
             * Ketika search berubah,
             * kembali ke halaman pertama.
             */
            this.$watch("search", () => {
                this.currentPage = 1;
            });
            /*
             * Ketika bidang berubah,
             * kembali ke halaman pertama.
             */
            this.$watch("bidang", () => {
                this.currentPage = 1;
            });
            /*
             * Ketika angkatan berubah,
             * kembali ke halaman pertama.
             */

            this.$watch("angkatan", () => {
                this.currentPage = 1;
            });
        }
    };
}
/* =========================================================
   REVEAL ANIMATION
========================================================= */
document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".reveal");
    const observer = new IntersectionObserver(
        function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.12
        }
    );
    elements.forEach(function (element) {
        observer.observe(element);
    });
});