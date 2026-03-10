document.addEventListener("DOMContentLoaded", function () {
  const tabBtns = document.querySelectorAll(".tab-btn");
  const tabContents = document.querySelectorAll(".tab-content");

  if (tabBtns.length > 0) {
    tabBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        tabBtns.forEach((b) => {
          b.classList.remove("bg-[#FFE600]", "shadow-[4px_-4px_0_0_#000]", "translate-y-1", "z-10");
          b.classList.add("bg-white");
        });
        tabContents.forEach((c) => c.classList.add("hidden"));

        btn.classList.remove("bg-white");
        btn.classList.add("bg-[#FFE600]", "shadow-[4px_-4px_0_0_#000]", "translate-y-1", "z-10");

        const targetId = "content-" + btn.getAttribute("data-target");
        document.getElementById(targetId).classList.remove("hidden");
      });
    });
  }

  const formAddCart = document.getElementById("form-add-cart");

  if (formAddCart) {
    formAddCart.addEventListener("submit", function (e) {
      e.preventDefault();

      const form = this;
      const btn = document.getElementById("btn-add-cart");
      const textBtn = document.getElementById("text-add-cart");
      const iconDefault = document.getElementById("icon-cart-default");
      const iconSuccess = document.getElementById("icon-cart-success");
      const alertBox = document.getElementById("ajax-alert");
      const alertText = document.getElementById("ajax-alert-text");

      const formData = new FormData(form);

      btn.disabled = true;
      btn.classList.add("opacity-50", "cursor-not-allowed");

      alertBox.classList.add("hidden");
      alertBox.classList.remove("flex");

      fetch(form.action, {
        method: "POST",
        body: formData,
        headers: {
          Accept: "application/json",
          "X-Requested-With": "XMLHttpRequest",
        },
      })
        .then(async (response) => {
          const rawText = await response.text();
          let data;

          try {
            data = JSON.parse(rawText);
          } catch (e) {
            throw { status: 500, message: "Server comms error." };
          }

          if (!response.ok) {
            throw { status: response.status, data: data };
          }
          return data;
        })
        .then((data) => {
          btn.disabled = false;
          btn.classList.remove("opacity-50", "cursor-not-allowed");

          btn.classList.remove("bg-[#FFE600]", "text-black");
          btn.classList.add("bg-[#A6FAAE]", "text-black");
          textBtn.textContent = "DITAMBAHKAN!";

          iconDefault.classList.add("hidden");
          iconSuccess.classList.remove("hidden");

          const badge = document.getElementById("nav-cart-badge");
          if (badge) {
            badge.textContent = data.cart_count;
            badge.classList.remove("hidden");
            badge.classList.add("flex", "scale-150");
            setTimeout(() => badge.classList.remove("scale-150"), 300);
          }

          setTimeout(() => {
            btn.classList.add("bg-[#FFE600]", "text-black");
            btn.classList.remove("bg-[#A6FAAE]");
            textBtn.textContent = "ADD TO LOADOUT";
            iconDefault.classList.remove("hidden");
            iconSuccess.classList.add("hidden");
          }, 2500);
        })
        .catch((error) => {
          btn.disabled = false;
          btn.classList.remove("opacity-50", "cursor-not-allowed");

          if (error.status === 401) {
            window.location.href = error.data.redirect;
          } else if (error.status === 400) {
            alertText.textContent = error.data?.message || "DEPLOYMENT FAILED.";
            alertBox.classList.remove("hidden");
            alertBox.classList.add("flex");
            window.scrollTo({ top: 0, behavior: "smooth" });
          } else {
            console.error("AJAX System Error:", error);
            alert("SYSTEM MALFUNCTION: Could not connect to server.");
          }
        });
    });
  }
});

window.incrementQty = function (maxStok) {
  const input = document.getElementById("qty-input");
  if (input && parseInt(input.value) < maxStok) {
    input.value = parseInt(input.value) + 1;
  }
};

window.decrementQty = function () {
  const input = document.getElementById("qty-input");
  if (input && parseInt(input.value) > 1) {
    input.value = parseInt(input.value) - 1;
  }
};
