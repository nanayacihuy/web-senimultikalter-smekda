<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $profile->judul ?? 'Profile Organisasi' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Typography -->
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-amber-800 selection:text-white">

    @include('components.navbar')


    <!-- =========================================================
         HERO / BANNER
    ========================================================== -->
    <header class="relative w-full h-64 md:h-80 bg-stone-900 flex items-center justify-center overflow-hidden">

        @if(!empty($profile?->banner))

            <img
                src="{{ asset('uploads/profile/' . $profile->banner) }}"
                alt="Banner Profile"
                class="absolute inset-0 w-full h-full object-cover opacity-50"
            >

        @else

            <div class="absolute inset-0 bg-gradient-to-r from-amber-950 to-stone-900 opacity-90"></div>

        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-stone-900 via-transparent to-transparent"></div>


        <!-- HERO TITLE -->
        <div class="relative z-10 text-center px-4 max-w-3xl">

            <span class="inline-block text-xs font-semibold uppercase tracking-widest text-amber-400 bg-amber-950/60 backdrop-blur-md px-3 py-1 rounded-full mb-3 border border-amber-500/30">
                PROFILE
            </span>

            <h1 class="text-2xl md:text-4xl font-bold text-white tracking-tight leading-tight drop-shadow-md">
                {{ $profile->judul ?? 'Profil Kami' }}
            </h1>

        </div>

    </header>


    <!-- =========================================================
         MAIN CONTENT
    ========================================================== -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 py-10 space-y-8">


        <!-- =====================================================
             TENTANG KAMI
        ====================================================== -->
        @if(!empty($profile?->deskripsi))

            <section class="bg-white p-6 md:p-8 rounded-2xl border border-stone-200/80 shadow-sm hover:shadow-md transition-shadow duration-300">

                <div class="flex items-center space-x-3 mb-4 pb-3 border-b border-stone-100">

                    <div class="w-2.5 h-6 bg-amber-800 rounded-full"></div>

                    <h2 class="text-xl font-bold text-stone-800 tracking-tight">
                        Tentang Kami
                    </h2>

                </div>

                <div class="prose prose-stone prose-sm max-w-none text-stone-600 leading-relaxed">

                    {!! $profile->deskripsi !!}

                </div>

            </section>

        @endif



        <!-- =====================================================
             TUJUAN
        ====================================================== -->
        @if(!empty($profile?->tujuan))

            <section class="bg-white p-6 md:p-8 rounded-2xl border border-stone-200/80 shadow-sm hover:shadow-md transition-shadow duration-300">

                <div class="flex items-center space-x-3 mb-4 pb-3 border-b border-stone-100">

                    <div class="w-2.5 h-6 bg-amber-800 rounded-full"></div>

                    <h2 class="text-xl font-bold text-stone-800 tracking-tight">
                        Tujuan
                    </h2>

                </div>

                <div class="prose prose-stone prose-sm max-w-none text-stone-600 leading-relaxed">

                    {!! $profile->tujuan !!}

                </div>

            </section>

        @endif



        <!-- =====================================================
             VISI & MISI
        ====================================================== -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


            <!-- =================================================
                 VISI
            ================================================== -->
            <section class="bg-white p-6 rounded-2xl border border-stone-200/80 shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow duration-300">

                <div>

                    <div class="flex items-center space-x-3 mb-4 pb-3 border-b border-stone-100">

                        <div class="p-2 bg-amber-50 rounded-lg text-amber-800">

                            <svg
                                class="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />
                            </svg>

                        </div>

                        <h2 class="text-lg font-bold text-stone-800">
                            Visi
                        </h2>

                    </div>


                    @if(!empty($profile?->visi))

                        <p class="text-sm text-stone-600 leading-relaxed italic">
                            "{{ $profile->visi }}"
                        </p>

                    @else

                        <p class="text-sm text-stone-400 italic">
                            Belum ada visi yang ditambahkan.
                        </p>

                    @endif

                </div>

            </section>



            <!-- =================================================
                 MISI
            ================================================== -->
            <section class="bg-white p-6 rounded-2xl border border-stone-200/80 shadow-sm hover:shadow-md transition-shadow duration-300">

                <div class="flex items-center space-x-3 mb-4 pb-3 border-b border-stone-100">

                    <div class="p-2 bg-amber-50 rounded-lg text-amber-800">

                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>

                    </div>

                    <h2 class="text-lg font-bold text-stone-800">
                        Misi
                    </h2>

                </div>


                @if(!empty($profile?->misi))

                    <div class="prose prose-stone prose-sm max-w-none text-stone-600 leading-relaxed">

                        {!! $profile->misi !!}

                    </div>

                @else

                    <p class="text-sm text-stone-400 italic">
                        Belum ada misi yang ditambahkan.
                    </p>

                @endif

            </section>

        </div>

    </main>


    @include('components.footer')

</body>
</html>