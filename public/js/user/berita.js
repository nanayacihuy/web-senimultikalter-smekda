document.addEventListener(
    "DOMContentLoaded",
    function () {


        /* =========================================
           SCROLL REVEAL
        ========================================= */

        const revealElements =
            document.querySelectorAll(
                ".reveal"
            );


        const revealObserver =
            new IntersectionObserver(
                function (entries) {

                    entries.forEach(
                        function (entry) {

                            if (
                                entry.isIntersecting
                            ) {

                                entry.target.classList.add(
                                    "show"
                                );

                                revealObserver.unobserve(
                                    entry.target
                                );

                            }

                        }
                    );

                },
                {
                    threshold: 0.12
                }
            );


        revealElements.forEach(
            function (element) {

                revealObserver.observe(
                    element
                );

            }
        );



        /* =========================================
           MODAL
        ========================================= */

        const modal =
            document.getElementById(
                "newsModal"
            );


        const modalImage =
            document.getElementById(
                "modalImage"
            );


        const modalTitle =
            document.getElementById(
                "modalTitle"
            );


        const modalDescription =
            document.getElementById(
                "modalDescription"
            );


        const modalDate =
            document.getElementById(
                "modalDate"
            );


        const modalClose =
            document.getElementById(
                "modalClose"
            );


        const newsCards =
            document.querySelectorAll(
                ".news-card, .featured-card"
            );



        /* =========================================
           BUKA BERITA
        ========================================= */

        newsCards.forEach(
            function (card) {

                card.addEventListener(
                    "click",
                    function (event) {


                        /*
                         * Jika yang diklik
                         * adalah tombol baca
                         * atau card biasa
                         */

                        const title =
                            card.dataset.title;


                        const description =
                            card.dataset.description;


                        const date =
                            card.dataset.date;


                        const image =
                            card.dataset.image;


                        if (!title) {
                            return;
                        }


                        modalTitle.textContent =
                            title;


                        modalDescription.textContent =
                            description;


                        modalDate.textContent =
                            "upload: " + date;


                        modalImage.src =
                            image;


                        modalImage.alt =
                            title;


                        modal.classList.add(
                            "active"
                        );


                        document.body.style.overflow =
                            "hidden";

                    }
                );

            }
        );



        /* =========================================
           TUTUP MODAL
        ========================================= */

        function closeModal() {

            modal.classList.remove(
                "active"
            );


            document.body.style.overflow =
                "";


            setTimeout(
                function () {

                    modalImage.src =
                        "";

                },
                300
            );

        }


        modalClose.addEventListener(
            "click",
            closeModal
        );



        /* =========================================
           KLIK AREA LUAR MODAL
        ========================================= */

        modal.addEventListener(
            "click",
            function (event) {

                if (
                    event.target === modal
                ) {

                    closeModal();

                }

            }
        );



        /* =========================================
           TOMBOL ESC
        ========================================= */

        document.addEventListener(
            "keydown",
            function (event) {

                if (
                    event.key === "Escape" &&
                    modal.classList.contains(
                        "active"
                    )
                ) {

                    closeModal();

                }

            }
        );



        /* =========================================
           HOVER CARD
        ========================================= */

        const cards =
            document.querySelectorAll(
                ".news-card"
            );


        cards.forEach(
            function (card) {

                card.addEventListener(
                    "mouseenter",
                    function () {

                        card.style.setProperty(
                            "--card-scale",
                            "1"
                        );

                    }
                );

            }
        );



        /* =========================================
           DISABLE DRAG IMAGE
        ========================================= */

        document
            .querySelectorAll("img")
            .forEach(
                function (image) {

                    image.addEventListener(
                        "dragstart",
                        function (event) {

                            event.preventDefault();

                        }
                    );

                }
            );

    }
);