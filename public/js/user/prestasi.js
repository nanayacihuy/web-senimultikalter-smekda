document.addEventListener("DOMContentLoaded", function () {


    /* =====================================================
       ANIMATION CARD
    ====================================================== */

    const cards =
        document.querySelectorAll(".prestasi-card");


    if ("IntersectionObserver" in window) {


        const observer =
            new IntersectionObserver(
                function (entries) {

                    entries.forEach(function (entry) {

                        if (entry.isIntersecting) {

                            entry.target.classList.add(
                                "show"
                            );


                            observer.unobserve(
                                entry.target
                            );

                        }

                    });

                },
                {
                    threshold: 0.12
                }
            );


        cards.forEach(function (card) {

            observer.observe(card);

        });


    } else {


        cards.forEach(function (card) {

            card.classList.add("show");

        });

    }



    /* =====================================================
       MODAL
    ====================================================== */

    const modal =
        document.getElementById("prestasiModal");


    const modalImage =
        document.getElementById("modalImage");


    const modalTitle =
        document.getElementById("modalTitle");


    const modalDescription =
        document.getElementById("modalDescription");


    const modalDate =
        document.getElementById("modalDate");


    const modalClose =
        document.getElementById("modalClose");


    if (!modal) {
        return;
    }



    /* =====================================================
       OPEN MODAL
    ====================================================== */

    cards.forEach(function (card) {


        const button =
            card.querySelector(".detail-button");


        function openModal() {


            modalTitle.textContent =
                card.dataset.title ||
                "Prestasi Seni Multikalter";


            modalDescription.textContent =
                card.dataset.description ||
                "Tidak ada deskripsi prestasi.";


            modalDate.textContent =
                "Tahun: " +
                (
                    card.dataset.date ||
                    "-"
                );


            modalImage.src =
                card.dataset.image ||
                "/img/DokumSM(4).jpg";


            modalImage.alt =
                card.dataset.title ||
                "Prestasi Seni Multikalter";


            modal.classList.add("active");


            modal.setAttribute(
                "aria-hidden",
                "false"
            );


            document.body.classList.add(
                "modal-open"
            );

        }



        if (button) {

            button.addEventListener(
                "click",
                function (event) {

                    event.stopPropagation();

                    openModal();

                }
            );

        }



        card.addEventListener(
            "click",
            function () {

                openModal();

            }
        );

    });



    /* =====================================================
       CLOSE MODAL
    ====================================================== */

    function closeModal() {


        modal.classList.remove(
            "active"
        );


        modal.setAttribute(
            "aria-hidden",
            "true"
        );


        document.body.classList.remove(
            "modal-open"
        );

    }



    modalClose.addEventListener(
        "click",
        closeModal
    );



    /* =====================================================
       CLICK OUTSIDE
    ====================================================== */

    modal.addEventListener(
        "click",
        function (event) {

            if (event.target === modal) {

                closeModal();

            }

        }
    );



    /* =====================================================
       ESC
    ====================================================== */

    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                modal.classList.contains("active")
            ) {

                closeModal();

            }

        }
    );



    /* =====================================================
       IMAGE FALLBACK
    ====================================================== */

    modalImage.addEventListener(
        "error",
        function () {

            this.onerror = null;

            this.src =
                "/img/DokumSM(4).jpg";

        }
    );

});