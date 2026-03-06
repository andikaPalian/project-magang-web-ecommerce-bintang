document.addEventListener("DOMContentLoaded", function () {
  const heroBg = document.getElementById("hero-bg");
  if (!heroBg) return;

  const heroContent = document.getElementById("hero-content");
  const heroLabel = document.getElementById("hero-label");
  const heroTitle = document.getElementById("hero-title");
  const heroSubtitle = document.getElementById("hero-subtitle");
  const heroBtn = document.getElementById("hero-btn");

  // Slides Data
  const slides = [
    {
      image:
        "https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1600&q=80",
      label: "ALASKA ELECTRONICS",
      title: "Super Sale Elektronik",
      subtitle: "Diskon Hingga 40% untuk Semua Kategori",
      btnText: "Belanja Sekarang",
    },
    {
      image:
        "https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1600&q=80",
      label: "PROMO GADGET",
      title: "MacBook & Laptop Pro",
      subtitle: "Cashback hingga Rp 2.000.000 khusus bulan ini",
      btnText: "Lihat Koleksi",
    },
    {
      image:
        "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=1600&q=80",
      label: "NEW ARRIVAL",
      title: "Era Baru Smartphone",
      subtitle: "Pre-order seri terbaru dengan bonus eksklusif",
      btnText: "Pre-Order Sekarang",
    },
  ];

  let currentIndex = 0;
  const btnPrev = document.getElementById("btn-prev");
  const btnNext = document.getElementById("btn-next");
  const dots = document.querySelectorAll(".dot-btn");

  // Update slide function with current index and slide image
  function updateSlide(index) {
    // Fade out current slide
    heroContent.style.opacity = "0";

    // Set timeout for smooth transition
    setTimeout(() => {
      heroBg.style.backgroundImage = `url('${slides[index].image}')`;

      heroLabel.textContent = slides[index].label;
      heroTitle.textContent = slides[index].title;
      heroSubtitle.textContent = slides[index].subtitle;

      heroBtn.innerHTML = `${slides[index].btnText} <svg class="w-4 h-4 ml-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>`;

      // Fade in new slide
      heroContent.style.opacity = "1";
    }, 300);

    dots.forEach((dot, i) => {
      if (i === index) {
        dot.className = "dot-btn w-8 h-1.5 bg-white rounded-full transition-all duration-300";
      } else {
        dot.className = "dot-btn w-2 h-1.5 bg-white/50 rounded-full transition-all duration-300";
      }
    });
  }

  // Next Button Click
  btnNext.addEventListener("click", function () {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlide(currentIndex);
  });

  // Previous Button Click
  btnPrev.addEventListener("click", function () {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlide(currentIndex);
  });

  // Dot Button Click
  dots.forEach((dot, index) => {
    dot.addEventListener("click", function () {
      currentIndex = index;
      updateSlide(currentIndex);
    });
  });

  // Auto Slide Every 5 seconds
  setInterval(function () {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlide(currentIndex);
  }, 5000);
});
