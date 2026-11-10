document.addEventListener("DOMContentLoaded", function () {

    /* =====================================================
       SCROLL REVEAL
    ===================================================== */

    const revealElements =
        document.querySelectorAll(".reveal");


    const observer =
        new IntersectionObserver(
            function (entries) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        entry.target.classList.add("show");

                        observer.unobserve(entry.target);

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



    /* =====================================================
       GALLERY
    ===================================================== */

    const galleryCards =
        Array.from(
            document.querySelectorAll(".gallery-card")
        );


    const modal =
        document.getElementById("imageModal");


    const modalImg =
        document.getElementById("modalImg");


    const modalTitle =
        document.getElementById("modalTitle");


    const closeModal =
        document.getElementById("closeModal");


    const prevImage =
        document.getElementById("prevImage");


    const nextImage =
        document.getElementById("nextImage");


    let currentIndex = 0;



    /* =====================================================
       BUKA MODAL
    ===================================================== */

    function openModal(index) {

        currentIndex = index;

        const card =
            galleryCards[currentIndex];


        const image =
            card.dataset.image;


        const title =
            card.dataset.title;


        modalImg.src = image;

        modalImg.alt = title;

        modalTitle.textContent = title;


        modal.classList.add("active");


        document.body.style.overflow = "hidden";

    }



    /* =====================================================
       TUTUP MODAL
    ===================================================== */

    function closeImageModal() {

        modal.classList.remove("active");

        document.body.style.overflow = "";

    }



    /* =====================================================
       SETIAP CARD BISA DIKLIK
    ===================================================== */

    galleryCards.forEach(function (card, index) {

        card.addEventListener("click", function () {

            openModal(index);

        });

    });



    /* =====================================================
       NEXT
    ===================================================== */

    function showNextImage() {

        currentIndex++;

        if (
            currentIndex >= galleryCards.length
        ) {

            currentIndex = 0;

        }


        openModal(currentIndex);

    }



    /* =====================================================
       PREVIOUS
    ===================================================== */

    function showPreviousImage() {

        currentIndex--;

        if (currentIndex < 0) {

            currentIndex =
                galleryCards.length - 1;

        }


        openModal(currentIndex);

    }



    /* =====================================================
       BUTTON
    ===================================================== */

    nextImage.addEventListener(
        "click",
        function (event) {

            event.stopPropagation();

            showNextImage();

        }
    );


    prevImage.addEventListener(
        "click",
        function (event) {

            event.stopPropagation();

            showPreviousImage();

        }
    );


    closeModal.addEventListener(
        "click",
        function () {

            closeImageModal();

        }
    );



    /* =====================================================
       KLIK LUAR GAMBAR
    ===================================================== */

    modal.addEventListener(
        "click",
        function (event) {

            if (
                event.target === modal
            ) {

                closeImageModal();

            }

        }
    );



    /* =====================================================
       KEYBOARD
    ===================================================== */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                !modal.classList.contains("active")
            ) {

                return;

            }


            if (event.key === "Escape") {

                closeImageModal();

            }


            if (event.key === "ArrowRight") {

                showNextImage();

            }


            if (event.key === "ArrowLeft") {

                showPreviousImage();

            }

        }
    );



    /* =====================================================
       SWIPE UNTUK HP
    ===================================================== */

    let touchStartX = 0;

    let touchEndX = 0;


    modal.addEventListener(
        "touchstart",
        function (event) {

            touchStartX =
                event.changedTouches[0].screenX;

        }
    );


    modal.addEventListener(
        "touchend",
        function (event) {

            touchEndX =
                event.changedTouches[0].screenX;


            handleSwipe();

        }
    );


    function handleSwipe() {

        const distance =
            touchEndX - touchStartX;


        /*
         * Swipe kiri
         */

        if (distance < -50) {

            showNextImage();

        }


        /*
         * Swipe kanan
         */

        if (distance > 50) {

            showPreviousImage();

        }

    }

});