document.addEventListener("DOMContentLoaded", () => {
  const wishlistButtons = document.querySelectorAll(".btn-wishlist");

  wishlistButtons.forEach((button) => {
    button.addEventListener("click", async function (e) {
      e.preventDefault();

      const url = this.getAttribute("href");
      const icon = this.querySelector("svg");

      try {
        const response = await fetch(url, {
          method: "GET",
          headers: {
            "X-Requested-With": "XMLHttpRequest",
          },
        });

        if (response.status === 401) {
          const data = await response.json();
          window.location.href = data.redirect;
          return;
        }

        if (!response.ok) throw new Error("Network response was not ok");

        const data = await response.json();

        if (data.status === "success") {
          if (data.action === "added") {
            icon.classList.remove("text-black");
            icon.classList.add("fill-[#FF5757]", "text-[#FF5757]");
            icon.setAttribute("fill", "currentColor");
            showToast("WISHLIST UPDATED", data.message || "Product saved.", "success");
          } else {
            icon.classList.add("text-black");
            icon.classList.remove("fill-[#FF5757]", "text-[#FF5757]");
            icon.setAttribute("fill", "none");
            showToast("WISHLIST UPDATED", data.message || "Product removed.", "success");
          }

          const badge = document.getElementById("wishlist-badge");
          if (badge) {
            badge.innerText = data.wishlist_count;
          }
        }
      } catch (error) {
        console.error("Error:", error);
        showToast("ERROR", "Action failed. Check console.", "error");
      }
    });
  });

  // Fungsi pembantu untuk memunculkan Toast Notification
  function showToast(title, message, type) {
    const toastId = type === "success" ? "global-toast" : "global-toast-error";
    const toast = document.getElementById(toastId);

    if (!toast) return;

    const titleEl = toast.querySelector("h4");
    const msgEl = toast.querySelector("p");

    if (titleEl) titleEl.innerText = title;
    if (msgEl) msgEl.innerText = message;

    // Munculkan toast
    toast.classList.remove("translate-x-full", "opacity-0");

    // Hilangkan otomatis setelah 3 detik
    setTimeout(() => {
      toast.classList.add("translate-x-full", "opacity-0");
    }, 3000);
  }

  // === LOGIKA HAPUS ITEM DI HALAMAN WISHLIST ===
  const removeButtons = document.querySelectorAll(".btn-remove-wishlist");

  removeButtons.forEach((btn) => {
    btn.addEventListener("click", async function (e) {
      e.preventDefault();

      const url = this.getAttribute("data-url");
      const card = this.closest(".wishlist-card"); // Cari elemen kartu produk terdekat

      try {
        const response = await fetch(url, {
          method: "GET",
          headers: { "X-Requested-With": "XMLHttpRequest" },
        });

        const data = await response.json();

        if (data.status === "success") {
          card.style.transition = "all 0.3s ease";
          card.style.transform = "scale(0.9)";
          card.style.opacity = "0";

          setTimeout(() => {
            card.remove();

            const totalCountEl = document.getElementById("wishlist-total-count");
            if (totalCountEl) {
              totalCountEl.innerText = data.wishlist_count;
            }

            const navBadge = document.getElementById("wishlist-badge");
            if (navBadge) {
              navBadge.innerText = data.wishlist_count;
            }

            const grid = document.getElementById("wishlist-grid");
            if (grid && grid.children.length === 0) {
              const template = document
                .getElementById("empty-wishlist-template")
                .content.cloneNode(true);
              const container = document.getElementById("wishlist-container");
              container.innerHTML = "";
              container.appendChild(template);
            }

            showToast("ITEM REMOVED", data.message, "success");
          }, 300);
        }
      } catch (error) {
        console.error("Error removing item:", error);
        showToast("ERROR", "Gagal menghapus produk.", "error");
      }
    });
  });
});
