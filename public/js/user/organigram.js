document.addEventListener("DOMContentLoaded", function () {

    /* 1. Animasi muncul halus saat scroll */
    const revealElements = document.querySelectorAll(".reveal");

    const revealObserver = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add("active");
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    revealElements.forEach(function (element) {
        revealObserver.observe(element);
    });

    /* 2. Efek sorot kartu saat kursor mengarah ke pelatih */
    const pelatihCards = document.querySelectorAll(".pelatih-card");

    pelatihCards.forEach(function (card) {
        card.addEventListener("mouseenter", function () {
            pelatihCards.forEach(function (otherCard) {
                if (otherCard !== card) {
                    otherCard.style.opacity = "0.4";
                }
            });
        });

        card.addEventListener("mouseleave", function () {
            pelatihCards.forEach(function (otherCard) {
                otherCard.style.opacity = "1";
            });
        });
    });

    /* 3. Otomatis buat foto avatar inisial jika foto pelatih/pembina belum ada atau gagal dimuat */
    const images = document.querySelectorAll(".pelatih-card img, .pembina-card img");

    images.forEach(function (img) {
        img.addEventListener("error", function () {
            const name = this.getAttribute("alt") || "Pengurus";
            this.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=047857&color=fff&size=128`;
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {

            const galleryItems =
                document.querySelectorAll(".organigram-photo");

            const modal =
                document.getElementById("imageModal");

            const modalImage =
                document.getElementById("modalImage");

            const modalCaption =
                document.getElementById("modalCaption");

            const closeModal =
                document.getElementById("closeModal");

            const prevImage =
                document.getElementById("prevImage");

            const nextImage =
                document.getElementById("nextImage");


            let currentIndex = 0;


            /* ==============================
               BUKA MODAL
            =============================== */

            galleryItems.forEach((item, index) => {

                item.addEventListener("click", function () {

                    currentIndex = index;

                    showImage(currentIndex);

                    modal.classList.remove("hidden");

                    document.body.style.overflow = "hidden";

                });

            });


            /* ==============================
               TAMPILKAN FOTO
            =============================== */

            function showImage(index) {

                const item =
                    galleryItems[index];

                const image =
                    item.getAttribute("data-image");

                const img =
                    item.querySelector("img");

                modalImage.src = image;

                modalCaption.textContent =
                    img ? img.alt : "";

            }


            /* ==============================
               NEXT
            =============================== */

            nextImage.addEventListener("click", function (event) {

                event.stopPropagation();

                currentIndex++;

                if (currentIndex >= galleryItems.length) {

                    currentIndex = 0;

                }

                showImage(currentIndex);

            });


            /* ==============================
               PREVIOUS
            =============================== */

            prevImage.addEventListener("click", function (event) {

                event.stopPropagation();

                currentIndex--;

                if (currentIndex < 0) {

                    currentIndex =
                        galleryItems.length - 1;

                }

                showImage(currentIndex);

            });


            /* ==============================
               TUTUP MODAL
            =============================== */

            closeModal.addEventListener("click", function () {

                modal.classList.add("hidden");

                document.body.style.overflow = "";

            });


            /* Klik area luar foto */
            modal.addEventListener("click", function (event) {

                if (event.target === modal) {

                    modal.classList.add("hidden");

                    document.body.style.overflow = "";

                }

            });


            /* ==============================
               KEYBOARD
            =============================== */

            document.addEventListener("keydown", function (event) {

                if (modal.classList.contains("hidden")) {
                    return;
                }

                if (event.key === "Escape") {

                    modal.classList.add("hidden");

                    document.body.style.overflow = "";

                }

                if (event.key === "ArrowRight") {

                    currentIndex++;

                    if (currentIndex >= galleryItems.length) {
                        currentIndex = 0;
                    }

                    showImage(currentIndex);

                }

                if (event.key === "ArrowLeft") {

                    currentIndex--;

                    if (currentIndex < 0) {
                        currentIndex = galleryItems.length - 1;
                    }

                    showImage(currentIndex);

                }

            });


            /* ==============================
               REVEAL ANIMATION
            =============================== */

            const revealElements =
                document.querySelectorAll(".reveal");

            const observer =
                new IntersectionObserver(
                    function (entries) {

                        entries.forEach(function (entry) {

                            if (entry.isIntersecting) {

                                entry.target.classList.add("active");

                            }

                        });

                    },
                    {
                        threshold: 0.1
                    }
                );


            revealElements.forEach(function (element) {

                observer.observe(element);

            });

        });