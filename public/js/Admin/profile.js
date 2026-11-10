document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       QUILL - DESKRIPSI PROFILE
    ====================================================== */

    const editorDeskripsi = new Quill("#editorDeskripsi", {
        theme: "snow",

        placeholder: "Tulis deskripsi profile...",

        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],

                ["bold", "italic", "underline"],

                ["blockquote", "link"],

                ["image", "video"],

                [
                    {
                        list: "ordered"
                    },
                    {
                        list: "bullet"
                    }
                ],

                [
                    {
                        align: []
                    }
                ],

                ["clean"]
            ]
        }
    });



    /* =====================================================
       QUILL - SEJARAH
    ====================================================== */

    const editorSejarah = new Quill("#editorSejarah", {
        theme: "snow",

        placeholder: "Tulis sejarah...",

        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],

                ["bold", "italic", "underline"],

                ["blockquote", "link"],

                ["image", "video"],

                [
                    {
                        list: "ordered"
                    },
                    {
                        list: "bullet"
                    }
                ],

                [
                    {
                        align: []
                    }
                ],

                ["clean"]
            ]
        }
    });



    /* =====================================================
       ELEMENT BANNER
    ====================================================== */

    const bannerInput =
        document.getElementById("bannerInput");

    const uploadBox =
        document.getElementById("uploadBox");

    const previewImage =
        document.getElementById("previewImage");

    const previewPlaceholder =
        document.getElementById("previewPlaceholder");

    const fileName =
        document.getElementById("fileName");



    /* =====================================================
       FUNGSI PREVIEW GAMBAR
    ====================================================== */

    function previewBanner(file) {

        if (!file) {
            return;
        }


        /* Validasi tipe file */

        const allowedTypes = [
            "image/jpeg",
            "image/png"
        ];

        if (!allowedTypes.includes(file.type)) {

            alert("Format gambar harus JPG atau PNG.");

            bannerInput.value = "";

            return;
        }


        /* Validasi ukuran */

        const maxSize = 2 * 1024 * 1024;

        if (file.size > maxSize) {

            alert("Ukuran gambar maksimal 2MB.");

            bannerInput.value = "";

            return;
        }


        /* Preview */

        const reader = new FileReader();

        reader.onload = function (event) {

            previewImage.src = event.target.result;

            previewImage.style.display = "block";

            previewPlaceholder.style.display = "none";

        };

        reader.readAsDataURL(file);


        /* Nama file */

        fileName.textContent =
            file.name;

    }



    /* =====================================================
       KLIK UPLOAD
    ====================================================== */

    bannerInput.addEventListener(
        "change",
        function () {

            const file = this.files[0];

            previewBanner(file);

        }
    );



    /* =====================================================
       DRAG OVER
    ====================================================== */

    uploadBox.addEventListener(
        "dragover",
        function (event) {

            event.preventDefault();

            uploadBox.classList.add("drag-over");

        }
    );



    /* =====================================================
       DRAG LEAVE
    ====================================================== */

    uploadBox.addEventListener(
        "dragleave",
        function () {

            uploadBox.classList.remove(
                "drag-over"
            );

        }
    );



    /* =====================================================
       DROP
    ====================================================== */

    uploadBox.addEventListener(
        "drop",
        function (event) {

            event.preventDefault();

            uploadBox.classList.remove(
                "drag-over"
            );


            const file =
                event.dataTransfer.files[0];


            if (!file) {
                return;
            }


            /*
             * Masukkan file ke input
             */

            const dataTransfer =
                new DataTransfer();

            dataTransfer.items.add(file);

            bannerInput.files =
                dataTransfer.files;


            previewBanner(file);

        }
    );



    /* =====================================================
       TOMBOL SIMPAN
    ====================================================== */

    const btnSimpan =
        document.getElementById("btnSimpan");


    btnSimpan.addEventListener(
        "click",
        function () {

            const judul =
                document.getElementById(
                    "judulProfile"
                ).value.trim();


            const visi =
                document.getElementById(
                    "visi"
                ).value.trim();


            /*
             * Contoh mendapatkan isi Quill
             */

            const deskripsi =
                editorDeskripsi.root.innerHTML;


            const sejarah =
                editorSejarah.root.innerHTML;


            console.log("Judul:", judul);
            console.log("Deskripsi:", deskripsi);
            console.log("Sejarah:", sejarah);
            console.log("Visi:", visi);


            /*
             * Untuk sementara tampilkan notifikasi.
             *
             * Nanti bagian ini bisa diganti dengan
             * fetch/AJAX atau submit form Laravel.
             */

            alert("Data profile siap disimpan!");

        }
    );

});