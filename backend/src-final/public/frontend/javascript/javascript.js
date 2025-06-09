document.addEventListener("DOMContentLoaded", function () {
  console.log("Navbar script loaded");

  const currentPath = window.location.pathname;
  console.log("Current Path:", currentPath);

  // Highlight link aktif di navbar
  document.querySelectorAll(".nav-link").forEach((link) => {
    const linkPath = new URL(link.href).pathname;
    const isRoot = linkPath === "/" && (currentPath === "/" || currentPath === "/index.html");

    if (linkPath === currentPath || isRoot) {
      document.querySelectorAll(".nav-link").forEach((l) => l.classList.remove("active"));
      link.classList.add("active");
      console.log("Active set on:", link.textContent.trim());
    }
  });

  // ✅ Offcanvas tambahan (class handling saat show/hide)
  const offcanvasElement = document.getElementById("offcanvasMenu");
  if (offcanvasElement) {
    offcanvasElement.addEventListener("show.bs.offcanvas", function () {
      document.body.classList.add("offcanvas-open");
    });

    offcanvasElement.addEventListener("hidden.bs.offcanvas", function () {
      document.body.classList.remove("offcanvas-open");
    });
  }

  // ✅ Pagination konten artikel
  let currentPage = 1;
  const totalPages = 2;

  function showPage(page) {
    for (let i = 1; i <= totalPages; i++) {
      const el = document.getElementById(`page-${i}`);
      if (el) el.classList.add("d-none");
    }

    const target = document.getElementById(`page-${page}`);
    if (target) target.classList.remove("d-none");

    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    if (prevBtn) prevBtn.disabled = page === 1;
    if (nextBtn) nextBtn.disabled = page === totalPages;
  }

  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");

  if (prevBtn && nextBtn) {
    prevBtn.addEventListener("click", () => {
      if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
      }
    });

    nextBtn.addEventListener("click", () => {
      if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
      }
    });

    showPage(currentPage); // inisialisasi
  }

  // ✅ Banner horizontal scroll (jika ada)
  const track = document.getElementById("mainBannerTrack");
  const cards = document.querySelectorAll(".main-banner-card");
  let index = 0;

  const scrollRight = document.getElementById("scrollRight");
  const scrollLeft = document.getElementById("scrollLeft");

  function updateSlide() {
    if (track && cards.length > 0) {
      const cardWidth = cards[0].offsetWidth;
      track.style.transform = `translateX(-${cardWidth * index}px)`;
    }
  }

  if (scrollRight && scrollLeft) {
    scrollRight.onclick = () => {
      if (index < cards.length - 1) {
        index++;
        updateSlide();
      }
    };

    scrollLeft.onclick = () => {
      if (index > 0) {
        index--;
        updateSlide();
      }
    };
  }
});
