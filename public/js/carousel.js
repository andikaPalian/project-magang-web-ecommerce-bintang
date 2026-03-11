document.addEventListener("DOMContentLoaded", function () {
  const heroBg = document.getElementById("hero-bg");
  if (!heroBg) return;

  const heroContent = document.getElementById("hero-content");
  const heroLabel = document.getElementById("hero-label");
  const heroTitle = document.getElementById("hero-title");
  const heroSubtitle = document.getElementById("hero-subtitle");
  const heroBtn = document.getElementById("hero-btn");

  const slides = [
    {
      image:
        "https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1600&q=80",
      label: "TI MART",
      title: "SUPER SALE ELEKTRONIK",
      subtitle: "Diskon Hingga 40% untuk Semua Kategori",
      btnText: "DEPLOY NOW",
      btnColor: "bg-[#2563EB]",
    },
    {
      image:
        "https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1600&q=80",
      label: "PROMO GADGET",
      title: "MACBOOK & LAPTOP PRO",
      subtitle: "Cashback Hingga Rp 2.000.000",
      btnText: "VIEW WiSHLIST",
      btnColor: "bg-[#FF5757]",
    },
    {
      image:
        "https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=1600&q=80",
      label: "NEW ARRIVAL",
      title: "ERA BARU SMARTPHONE",
      subtitle: "Pre-order seri terbaru dengan bonus eksklusif",
      btnText: "PRE-ORDER",
      btnColor: "bg-[#FFE600] text-black",
    },
  ];

  let currentIndex = 0;
  const btnPrev = document.getElementById("btn-prev");
  const btnNext = document.getElementById("btn-next");
  const dots = document.querySelectorAll(".dot-btn");

  function updateSlide(index) {
    heroContent.style.opacity = "0";

    setTimeout(() => {
      heroBg.style.backgroundImage = `url('${slides[index].image}')`;

      heroLabel.textContent = slides[index].label;
      heroTitle.textContent = slides[index].title;
      heroSubtitle.textContent = slides[index].subtitle;

      let textColor = slides[index].btnColor.includes("text-black") ? "text-black" : "text-white";
      heroBtn.className = `inline-flex items-center ${slides[index].btnColor.split(" ")[0]} ${textColor} text-sm font-black uppercase tracking-widest border-2 border-black px-8 py-4 shadow-[4px_4px_0_0_#000] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none transition-all`;

      heroBtn.innerHTML = `${slides[index].btnText} <svg class="w-5 h-5 ml-3 border-l-2 border-black pl-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>`;

      heroContent.style.opacity = "1";
    }, 200);

    dots.forEach((dot, i) => {
      if (i === index) {
        dot.className =
          "dot-btn w-8 h-3 bg-[#2563EB] border-2 border-black transition-all duration-300";
      } else {
        dot.className =
          "dot-btn w-3 h-3 bg-white border-2 border-black transition-all duration-300";
      }
    });
  }

  btnNext.addEventListener("click", function () {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlide(currentIndex);
  });

  btnPrev.addEventListener("click", function () {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    updateSlide(currentIndex);
  });

  dots.forEach((dot, index) => {
    dot.addEventListener("click", function () {
      currentIndex = index;
      updateSlide(currentIndex);
    });
  });

  setInterval(function () {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlide(currentIndex);
  }, 5000);
});
