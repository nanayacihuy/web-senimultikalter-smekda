document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('agendaModal');
    const form = document.getElementById('agendaForm');
    const modalTitle = document.getElementById('modalTitle');
    const formMethod = document.getElementById('formMethod');

    const namaKegiatan = document.getElementById('namaKegiatan');
    const waktu = document.getElementById('waktu');
    const tempat = document.getElementById('tempat');
    const materi = document.getElementById('materi');

    /*
    |--------------------------------------------------------------------------
    | TAMBAH AGENDA
    |--------------------------------------------------------------------------
    */
    window.openAddModal = function () {

        modalTitle.textContent = 'Tambah Agenda';

        // Form menuju route store
        form.action = '/admin/agenda';

        // Method POST
        formMethod.value = 'POST';

        // Kosongkan semua input
        namaKegiatan.value = '';
        waktu.value = '';
        tempat.value = '';
        materi.value = '';

        // Tampilkan modal
        modal.classList.add('show');

        // Fokus ke input nama
        namaKegiatan.focus();
    };


    /*
    |--------------------------------------------------------------------------
    | UBAH AGENDA
    |--------------------------------------------------------------------------
    */
    window.openEditModal = function (
        id,
        nama,
        waktuData,
        tempatData,
        materiData
    ) {

        modalTitle.textContent = 'Ubah Agenda';

        // Form menuju /admin/agenda/{id}
        form.action = '/admin/agenda/' + id;

        // Laravel akan membaca ini sebagai PUT
        formMethod.value = 'PUT';

        // Isi data lama ke form
        namaKegiatan.value = nama || '';
        waktu.value = waktuData || '';
        tempat.value = tempatData || '';
        materi.value = materiData || '';

        // Tampilkan modal
        modal.classList.add('show');

        // Fokus ke input nama
        namaKegiatan.focus();
    };


    /*
    |--------------------------------------------------------------------------
    | TUTUP MODAL
    |--------------------------------------------------------------------------
    */
    window.closeModal = function () {
        modal.classList.remove('show');
    };


    /*
    |--------------------------------------------------------------------------
    | KLIK DI LUAR MODAL
    |--------------------------------------------------------------------------
    */
    modal.addEventListener('click', function (event) {

        if (event.target === modal) {
            closeModal();
        }

    });


    /*
    |--------------------------------------------------------------------------
    | TOMBOL ESCAPE
    |--------------------------------------------------------------------------
    */
    document.addEventListener('keydown', function (event) {

        if (event.key === 'Escape') {
            closeModal();
        }

    });

});