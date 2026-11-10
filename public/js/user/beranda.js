document.addEventListener("DOMContentLoaded", function () {
    /* =====================================================
       REVEAL ANIMATION
    ===================================================== */
    const revealElements =
        document.querySelectorAll(".reveal");
    const revealObserver =
        new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("active");
                        revealObserver.unobserve(
                            entry.target
                        );
                    }
                });
            },
            {
                threshold: 0.12
            }
        );
    revealElements.forEach(function (element) {
        revealObserver.observe(element);
    });
    /* =====================================================
       GALLERY MODAL
    ===================================================== */
    const galleryItems =
        document.querySelectorAll(".gallery-item");
    const galleryModal =
        document.getElementById("galleryModal");
    const modalImage =
        document.getElementById("modalImage");
    const modalClose =
        document.getElementById("modalClose");
    galleryItems.forEach(function (item) {
        item.addEventListener(
            "click",
            function () {
                const image =
                    item.getAttribute("data-image");
                if (image) {
                    modalImage.src = image;
                    galleryModal.classList.add("show");
                    document.body.style.overflow =
                        "hidden";
                }
            }
        );

    });
    /* Tutup modal */
    function closeModal() {
        galleryModal.classList.remove("show");
        document.body.style.overflow = "";
    }
    if (modalClose) {
        modalClose.addEventListener(
            "click",
            closeModal
        );
    }
    /* Klik area luar gambar */
    if (galleryModal) {
        galleryModal.addEventListener(
            "click",
            function (event) {
                if (
                    event.target === galleryModal
                ) {
                    closeModal();
                }
            }
        );
    }
    /* Tombol ESC */
    document.addEventListener(
        "keydown",
        function (event) {

            if (
                event.key === "Escape" &&
                galleryModal.classList.contains("show")
            ) {

                closeModal();

            }

        }
    );



    /* =====================================================
       PARALLAX HERO
    ===================================================== */

    const heroImage =
        document.querySelector(".hero-image");


    window.addEventListener(
        "scroll",
        function () {

            if (!heroImage) return;


            const scroll =
                window.scrollY;


            if (scroll < window.innerHeight) {

                heroImage.style.transform =
                    `translateY(${scroll * 0.08}px)`;

            }

        }
    );



    /* =====================================================
       CARD INTERACTION
    ===================================================== */

    const bidangCards =
        document.querySelectorAll(".bidang-card");


    bidangCards.forEach(function (card) {

        card.addEventListener(
            "mouseenter",
            function () {

                bidangCards.forEach(function (other) {

                    if (other !== card) {

                        other.style.opacity = "0.7";

                    }

                });

            }
        );


        card.addEventListener(
            "mouseleave",
            function () {

                bidangCards.forEach(function (other) {

                    other.style.opacity = "1";

                });

            }
        );

    });



    /* =====================================================
       SMOOTH SCROLL
    ===================================================== */

    const internalLinks =
        document.querySelectorAll(
            'a[href^="#"]'
        );


    internalLinks.forEach(function (link) {

        link.addEventListener(
            "click",
            function (event) {

                const targetId =
                    link.getAttribute("href");


                if (
                    targetId === "#" ||
                    targetId.length < 2
                ) {

                    return;

                }


                const target =
                    document.querySelector(targetId);


                if (target) {

                    event.preventDefault();


                    target.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });

                }

            }
        );

    });



    /* =====================================================
       ACTIVE SECTION
    ===================================================== */

    const sections =
        document.querySelectorAll(
            "main section[id]"
        );


    const navLinks =
        document.querySelectorAll(
            ".nav-menu a"
        );


    if (sections.length > 0) {

        const sectionObserver =
            new IntersectionObserver(
                function (entries) {

                    entries.forEach(function (entry) {

                        if (
                            entry.isIntersecting
                        ) {

                            navLinks.forEach(
                                function (link) {

                                    link.classList.remove(
                                        "active"
                                    );

                                }
                            );

                        }

                    });

                },
                {
                    threshold: 0.5
                }
            );


        sections.forEach(function (section) {

            sectionObserver.observe(section);

        });

    }



    /* =====================================================
       PREVENT IMAGE DRAG
    ===================================================== */

    document
        .querySelectorAll("img")
        .forEach(function (image) {

            image.addEventListener(
                "dragstart",
                function (event) {

                    event.preventDefault();

                }
            );

        });

});