document.addEventListener("DOMContentLoaded", function () {
    /* =================================================
       SCROLL REVEAL
    ================================================= */
    const revealElements = document.querySelectorAll(".reveal");
    const revealObserver = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");

                    revealObserver.unobserve(entry.target);
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
    /* =================================================
       ELEMENT MODAL
    ================================================= */
    const modal = document.getElementById("agendaModal");
    const modalImage = document.getElementById("modalImage");
    const modalTitle = document.getElementById("modalTitle");
    const modalDate = document.getElementById("modalDate");
    const modalLocation = document.getElementById("modalLocation");
    const modalDescription = document.getElementById("modalDescription");
    const modalClose = document.getElementById("modalClose");
    const modalOk = document.getElementById("modalOk");
    /* =================================================
       SEMUA KARTU AGENDA
    ================================================= */
    const agendaCards = document.querySelectorAll(".agenda-card");
    /* =================================================
       BUKA MODAL
    ================================================= */
    function openModal(card) {
        const title = card.dataset.title;
        const date = card.dataset.date;
        const location = card.dataset.location;
        const description = card.dataset.description;
        const image = card.dataset.image;
        modalTitle.textContent = title;
        modalDate.textContent = date;
        modalLocation.textContent = "⌖ " + location;
        modalDescription.textContent = description;
        modalImage.src = image;
        modalImage.alt = title;
        modal.classList.add("active");
        document.body.style.overflow = "hidden";
    }
    /* =================================================
       KLIK CARD
    ================================================= */
    agendaCards.forEach(function (card) {
        card.addEventListener("click", function () {
            /*
             * Kalau yang diklik adalah button,
             * tetap buka modal.
             */

            openModal(card);
        });

    });
    /* =================================================
       TUTUP MODAL
    ================================================= */
    function closeModal() {
        modal.classList.remove("active");
        document.body.style.overflow = "";
    }
    modalClose.addEventListener("click", closeModal);
    modalOk.addEventListener("click", closeModal);
    /* =================================================
       KLIK AREA LUAR MODAL
    ================================================= */
    modal.addEventListener("click", function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });
    /* =================================================
       TOMBOL ESC
    ================================================= */
    document.addEventListener("keydown", function (event) {
        if (
            event.key === "Escape" &&
            modal.classList.contains("active")
        ) {
            closeModal();
        }
    });
    /* =================================================
       SMOOTH SCROLL HERO
    ================================================= */
    const heroButton = document.querySelector(".hero-button");
    if (heroButton) {
        heroButton.addEventListener("click", function (event) {
            event.preventDefault();
            const target = document.getElementById("agendaList");
            target.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        });
    }
});