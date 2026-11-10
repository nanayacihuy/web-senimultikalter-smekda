<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile | Seni Multikalter</title>

    {{-- =====================================================
         TAILWIND
    ====================================================== --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- =====================================================
         ALPINE
    ====================================================== --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js">
    </script>

    {{-- =====================================================
         QUILL CSS
    ====================================================== --}}
    <link
        href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css"
        rel="stylesheet">

    <style>

        /* =====================================================
           PROFILE CONTENT
        ====================================================== */

        .profile-content {
            padding: 2rem;
            background: #f3f4f6;
            min-height: calc(100vh - 72px);
        }

        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }


        /* =====================================================
           GRID
        ====================================================== */

        .profile-grid {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(280px, 1fr);
            gap: 1.5rem;
            align-items: start;
        }


        /* =====================================================
           CARD
        ====================================================== */

        .profile-card,
        .banner-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
        }

        .card-header {
            padding: 1rem 1.5rem;
            background: #3b1206;
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 600;
        }

        .card-body,
        .banner-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }


        /* =====================================================
           FORM
        ====================================================== */

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            color: #374151;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .form-group input[type="text"] {
            width: 100%;
            padding: 0.7rem 0.9rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: 0.2s;
            box-sizing: border-box;
        }

        .form-group input[type="text"]:focus {
            border-color: #3b1206;
            box-shadow: 0 0 0 2px rgba(59, 18, 6, 0.12);
        }


        /* =====================================================
           QUILL
        ====================================================== */

        .quill-editor {
            height: 180px;
            background: #ffffff;
            border-radius: 0 0 8px 8px;
        }

        .ql-toolbar.ql-snow {
            border-radius: 8px 8px 0 0;
        }

        .ql-container.ql-snow {
            border-radius: 0 0 8px 8px;
            font-size: 14px;
        }


        /* =====================================================
           BANNER
        ====================================================== */

        .banner-preview {
            width: 100%;
            height: 220px;
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 8px;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;
        }

        #previewImage {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            gap: 0.5rem;

            color: #9ca3af;
        }

        .preview-icon {
            font-size: 2rem;
        }


        /* =====================================================
           UPLOAD
        ====================================================== */

        .upload-box {
            border: 1px solid #d1d5db;
            background: #f9fafb;

            padding: 1rem;

            border-radius: 8px;

            text-align: center;

            cursor: pointer;

            display: flex;
            flex-direction: column;

            gap: 0.3rem;

            transition: 0.2s;
        }

        .upload-box:hover {
            background: #f3f4f6;
        }

        .upload-icon {
            font-size: 1.4rem;
            color: #4b5563;
        }

        .file-name {
            min-height: 20px;

            font-size: 0.875rem;

            color: #4b5563;

            word-break: break-all;
        }


        /* =====================================================
           BUTTON
        ====================================================== */

        .btn-simpan {
            width: 100%;

            padding: 0.75rem 1.5rem;

            background: #3b1206;

            color: #ffffff;

            border: none;

            border-radius: 8px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.2s;
        }

        .btn-simpan:hover {
            background: #581c09;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 1023px) {

            .profile-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 640px) {

            .profile-content {
                padding: 1rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .card-body,
            .banner-body {
                padding: 1rem;
            }

            .banner-preview {
                height: 180px;
            }

        }

    </style>

</head>


<body
    x-data="{ sidebarOpen: false }"
    class="bg-gray-100 min-h-screen flex flex-col">


    {{-- =====================================================
         NAVBAR ADMIN
    ====================================================== --}}

    @include('components.admin.navbar')


    <div class="flex flex-1 w-full relative">


        {{-- =====================================================
             SIDEBAR
        ====================================================== --}}

        <aside class="w-64 flex-shrink-0 bg-white border-r">

            @include('components.admin.sidebar')

        </aside>


        {{-- =====================================================
             MAIN CONTENT
        ====================================================== --}}

        <main class="flex-1 profile-content">

            <div class="profile-container">


                {{-- =====================================================
                     PAGE TITLE
                ====================================================== --}}

                <h1 class="page-title">
                    Kelola Profile
                </h1>


                {{-- =====================================================
                     SUCCESS MESSAGE
                ====================================================== --}}

                @if(session('success'))

                    <div class="mb-5 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">

                        {{ session('success') }}

                    </div>

                @endif


                {{-- =====================================================
                     ERROR MESSAGE
                ====================================================== --}}

                @if($errors->any())

                    <div class="mb-5 rounded-lg bg-red-100 border border-red-300 text-red-700 px-4 py-3">

                        <ul class="list-disc list-inside">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- =====================================================
                     AMBIL 6 MISI DARI DATABASE
                ====================================================== --}}

                @php

                    $misiItems = [];

                    if (!empty($profile?->misi)) {

                        preg_match_all(
                            '/<li>(.*?)<\/li>/s',
                            $profile->misi,
                            $matches
                        );

                        $misiItems = $matches[1] ?? [];

                    }

                @endphp


                {{-- =====================================================
                     FORM
                ====================================================== --}}

                <form
                    id="profileForm"
                    action="{{ route('admin.profile.update') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf

                    @method('PUT')


                    <div class="profile-grid">


                        {{-- =====================================================
                             INFORMASI PROFILE
                        ====================================================== --}}

                        <section class="profile-card">


                            <div class="card-header">
                                Informasi Profile
                            </div>


                            <div class="card-body">


                                {{-- =================================================
                                     JUDUL
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="judulProfile">
                                        Judul Profile
                                    </label>

                                    <input
                                        type="text"
                                        id="judulProfile"
                                        name="judul"
                                        value="{{ old('judul', $profile->judul ?? '') }}"
                                        placeholder="Masukkan judul profile"
                                        required>

                                </div>


                                {{-- =================================================
                                     DESKRIPSI PROFILE
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="editorDeskripsi">
                                        Deskripsi Profile
                                    </label>


                                    <div
                                        id="editorDeskripsi"
                                        class="quill-editor">
                                    </div>


                                    <input
                                        type="hidden"
                                        name="deskripsi"
                                        id="deskripsi"
                                        value="{{ old('deskripsi', $profile->deskripsi ?? '') }}">

                                </div>


                                {{-- =================================================
                                     TUJUAN
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="editorTujuan">
                                        Tujuan
                                    </label>


                                    <div
                                        id="editorTujuan"
                                        class="quill-editor">
                                    </div>


                                    <input
                                        type="hidden"
                                        name="tujuan"
                                        id="tujuan"
                                        value="{{ old('tujuan', $profile->tujuan ?? '') }}">

                                </div>


                                {{-- =================================================
                                     VISI
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="visi">
                                        Visi
                                    </label>

                                    <input
                                        type="text"
                                        id="visi"
                                        name="visi"
                                        value="{{ old('visi', $profile->visi ?? '') }}"
                                        placeholder="Masukkan visi organisasi">

                                </div>


                                {{-- =================================================
                                     MISI 1
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="misi1">
                                        Misi 1
                                    </label>

                                    <input
                                        type="text"
                                        id="misi1"
                                        name="misi1"
                                        value="{{ old('misi1', $misiItems[0] ?? '') }}"
                                        placeholder="Masukkan misi 1">

                                </div>


                                {{-- =================================================
                                     MISI 2
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="misi2">
                                        Misi 2
                                    </label>

                                    <input
                                        type="text"
                                        id="misi2"
                                        name="misi2"
                                        value="{{ old('misi2', $misiItems[1] ?? '') }}"
                                        placeholder="Masukkan misi 2">

                                </div>


                                {{-- =================================================
                                     MISI 3
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="misi3">
                                        Misi 3
                                    </label>

                                    <input
                                        type="text"
                                        id="misi3"
                                        name="misi3"
                                        value="{{ old('misi3', $misiItems[2] ?? '') }}"
                                        placeholder="Masukkan misi 3">

                                </div>


                                {{-- =================================================
                                     MISI 4
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="misi4">
                                        Misi 4
                                    </label>

                                    <input
                                        type="text"
                                        id="misi4"
                                        name="misi4"
                                        value="{{ old('misi4', $misiItems[3] ?? '') }}"
                                        placeholder="Masukkan misi 4">

                                </div>


                                {{-- =================================================
                                     MISI 5
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="misi5">
                                        Misi 5
                                    </label>

                                    <input
                                        type="text"
                                        id="misi5"
                                        name="misi5"
                                        value="{{ old('misi5', $misiItems[4] ?? '') }}"
                                        placeholder="Masukkan misi 5">

                                </div>


                                {{-- =================================================
                                     MISI 6
                                ================================================== --}}

                                <div class="form-group">

                                    <label for="misi6">
                                        Misi 6
                                    </label>

                                    <input
                                        type="text"
                                        id="misi6"
                                        name="misi6"
                                        value="{{ old('misi6', $misiItems[5] ?? '') }}"
                                        placeholder="Masukkan misi 6">

                                </div>


                            </div>

                        </section>


                        {{-- =====================================================
                             FOTO PROFILE
                        ====================================================== --}}

                        <section class="banner-card">


                            <div class="card-header">
                                Foto Profile
                            </div>


                            <div class="banner-body">


                                {{-- =================================================
                                     PREVIEW
                                ================================================== --}}

                                <div
                                    class="banner-preview"
                                    id="bannerPreview">


                                    @if(!empty($profile?->banner))

                                        <img
                                            id="previewImage"
                                            src="{{ asset('uploads/profile/' . $profile->banner) }}"
                                            alt="Foto Profile">


                                        <div
                                            class="preview-placeholder"
                                            id="previewPlaceholder"
                                            style="display:none;">

                                            <div class="preview-icon">
                                                🖼
                                            </div>

                                            <span>
                                                Preview Foto
                                            </span>

                                        </div>


                                    @else

                                        <img
                                            id="previewImage"
                                            src=""
                                            alt="Preview Foto"
                                            style="display:none;">


                                        <div
                                            class="preview-placeholder"
                                            id="previewPlaceholder">

                                            <div class="preview-icon">
                                                🖼
                                            </div>

                                            <span>
                                                Preview Foto
                                            </span>

                                        </div>

                                    @endif


                                </div>


                                {{-- =================================================
                                     UPLOAD
                                ================================================== --}}

                                <label
                                    for="bannerInput"
                                    class="upload-box">

                                    <div class="upload-icon">
                                        ⇧
                                    </div>

                                    <strong>
                                        Klik untuk upload gambar
                                    </strong>

                                    <span class="text-xs text-gray-500">
                                        JPG, PNG, WEBP max 2MB
                                    </span>

                                </label>


                                <input
                                    type="file"
                                    id="bannerInput"
                                    name="banner"
                                    accept="image/jpeg,image/png,image/webp"
                                    hidden>


                                {{-- =================================================
                                     FILE NAME
                                ================================================== --}}

                                <p
                                    class="file-name"
                                    id="fileName">

                                    @if(!empty($profile?->banner))
                                        {{ $profile->banner }}
                                    @endif

                                </p>


                                {{-- =================================================
                                     BUTTON SIMPAN
                                ================================================== --}}

                                <button
                                    type="submit"
                                    class="btn-simpan">

                                    Simpan

                                </button>


                            </div>

                        </section>


                    </div>

                </form>


            </div>

        </main>

    </div>


    {{-- =====================================================
         QUILL JS
    ====================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /* =====================================================
               TOOLBAR QUILL
            ====================================================== */

            const quillToolbar = [
                [
                    {
                        header: [1, 2, 3, false]
                    }
                ],

                [
                    'bold',
                    'italic',
                    'underline',
                    'strike'
                ],

                [
                    {
                        list: 'ordered'
                    },
                    {
                        list: 'bullet'
                    }
                ],

                [
                    {
                        align: []
                    }
                ],

                [
                    'clean'
                ]
            ];


            /* =====================================================
               QUILL DESKRIPSI
            ====================================================== */

            const quillDeskripsi =
                new Quill('#editorDeskripsi', {

                    theme: 'snow',

                    modules: {
                        toolbar: quillToolbar
                    }

                });


            const inputDeskripsi =
                document.getElementById('deskripsi');


            /* =====================================================
               LOAD DESKRIPSI DARI DATABASE
            ====================================================== */

            if (
                inputDeskripsi &&
                inputDeskripsi.value
            ) {

                quillDeskripsi.clipboard.dangerouslyPasteHTML(
                    inputDeskripsi.value
                );

            }


            /* =====================================================
               QUILL TUJUAN
            ====================================================== */

            const quillTujuan =
                new Quill('#editorTujuan', {

                    theme: 'snow',

                    modules: {
                        toolbar: quillToolbar
                    }

                });


            const inputTujuan =
                document.getElementById('tujuan');


            /* =====================================================
               LOAD TUJUAN DARI DATABASE
            ====================================================== */

            if (
                inputTujuan &&
                inputTujuan.value
            ) {

                quillTujuan.clipboard.dangerouslyPasteHTML(
                    inputTujuan.value
                );

            }


            /* =====================================================
               FORM SUBMIT
            ====================================================== */

            const profileForm =
                document.getElementById('profileForm');


            profileForm.addEventListener(
                'submit',
                function () {


                    /* DESKRIPSI */

                    inputDeskripsi.value =
                        quillDeskripsi.root.innerHTML;


                    /* TUJUAN */

                    inputTujuan.value =
                        quillTujuan.root.innerHTML;

                }
            );


            /* =====================================================
               PREVIEW BANNER
            ====================================================== */

            const bannerInput =
                document.getElementById('bannerInput');

            const previewImage =
                document.getElementById('previewImage');

            const previewPlaceholder =
                document.getElementById('previewPlaceholder');

            const fileName =
                document.getElementById('fileName');


            bannerInput.addEventListener(
                'change',
                function (event) {


                    const file =
                        event.target.files[0];


                    if (!file) {
                        return;
                    }


                    /* =================================================
                       UKURAN FILE
                    ================================================== */

                    if (
                        file.size >
                        2 * 1024 * 1024
                    ) {

                        alert(
                            'Ukuran gambar maksimal 2MB.'
                        );

                        bannerInput.value = '';

                        return;

                    }


                    /* =================================================
                       FORMAT FILE
                    ================================================== */

                    const allowedTypes = [
                        'image/jpeg',
                        'image/png',
                        'image/webp'
                    ];


                    if (
                        !allowedTypes.includes(
                            file.type
                        )
                    ) {

                        alert(
                            'Format gambar harus JPG, PNG, atau WEBP.'
                        );

                        bannerInput.value = '';

                        return;

                    }


                    /* =================================================
                       NAMA FILE
                    ================================================== */

                    fileName.textContent =
                        file.name;


                    /* =================================================
                       PREVIEW GAMBAR
                    ================================================== */

                    const reader =
                        new FileReader();


                    reader.onload =
                        function (e) {


                            previewImage.src =
                                e.target.result;


                            previewImage.style.display =
                                'block';


                            previewPlaceholder.style.display =
                                'none';

                        };


                    reader.readAsDataURL(file);

                }
            );

        });

    </script>

</body>

</html>