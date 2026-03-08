document.addEventListener("DOMContentLoaded", function () {
  const toastSuccess = document.getElementById("global-toast");
  const toastError = document.getElementById("global-toast-error");
  const toastErrorMsg = document.getElementById("global-toast-error-msg");
  let toastTimeout;

  const showToast = (type, message = "") => {
    clearTimeout(toastTimeout);

    toastSuccess.classList.add("translate-x-full", "opacity-0");
    toastError.classList.add("translate-x-full", "opacity-0");

    const activeToast = type === "success" ? toastSuccess : toastError;
    if (type === "error" && message) {
      toastErrorMsg.textContent = message;
    }

    setTimeout(() => {
      activeToast.classList.remove("translate-x-full", "opacity-0");
    }, 50);

    toastTimeout = setTimeout(() => {
      activeToast.classList.add("translate-x-full", "opacity-0");
    }, 3000);
  };

  const forms = document.querySelectorAll(".ajax-add-cart");

  forms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const btn = form.querySelector(".btn-submit");
      const iconCart = form.querySelector(".icon-cart");
      const iconSuccess = form.querySelector(".icon-success");
      const formData = new FormData(form);

      btn.disabled = true;
      btn.classList.add("opacity-75", "cursor-not-allowed");

      fetch(form.getAttribute("action"), {
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
            throw { status: 500, message: "Respons server tidak valid." };
          }
          if (!response.ok) throw { status: response.status, data: data };
          return data;
        })
        .then((data) => {
          btn.disabled = false;
          btn.classList.remove("opacity-75", "cursor-not-allowed");

          btn.classList.remove("bg-[#ef4444]", "hover:bg-red-600");
          btn.classList.add("bg-[#10b981]", "hover:bg-[#059669]");
          iconCart.classList.add("hidden");
          iconSuccess.classList.remove("hidden");

          showToast("success");

          const badge = document.getElementById("nav-cart-badge");
          if (badge) {
            badge.textContent = data.cart_count;
            badge.classList.remove("hidden");
            badge.classList.add("flex");
            badge.classList.add("scale-150");
            setTimeout(() => badge.classList.remove("scale-150"), 300);
          }

          setTimeout(() => {
            btn.classList.add("bg-[#ef4444]", "hover:bg-red-600");
            btn.classList.remove("bg-[#10b981]", "hover:bg-[#059669]");
            iconCart.classList.remove("hidden");
            iconSuccess.classList.add("hidden");
          }, 2000);
        })
        .catch((error) => {
          btn.disabled = false;
          btn.classList.remove("opacity-75", "cursor-not-allowed");

          if (error.status === 401) {
            window.location.href = error.data?.redirect || BASEURL + "/auth";
          } else if (error.status === 400) {
            showToast("error", error.data?.message || "Stok tidak mencukupi.");
          } else {
            showToast("error", "Terjadi kesalahan sistem.");
          }
        });
    });
  });
});
