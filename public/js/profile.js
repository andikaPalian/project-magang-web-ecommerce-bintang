document.addEventListener("DOMContentLoaded", function () {
  const toastSuccess = document.getElementById("global-toast");
  const toastSuccessMsg = document.getElementById("global-toast-success-msg");
  const toastError = document.getElementById("global-toast-error");
  const toastErrorMsg = document.getElementById("global-toast-error-msg");
  let toastTimeout;

  const showToast = (type, message = "") => {
    clearTimeout(toastTimeout);

    if (toastSuccess) toastSuccess.classList.add("translate-x-full", "opacity-0");
    if (toastError) toastError.classList.add("translate-x-full", "opacity-0");

    const activeToast = type === "success" ? toastSuccess : toastError;

    if (type === "error" && message && toastErrorMsg) {
      toastErrorMsg.textContent = message;
    } else if (type === "success" && message && toastSuccessMsg) {
      toastSuccessMsg.textContent = message;
    }

    if (activeToast) {
      setTimeout(() => {
        activeToast.classList.remove("translate-x-full", "opacity-0");
      }, 50);

      toastTimeout = setTimeout(() => {
        activeToast.classList.add("translate-x-full", "opacity-0");
      }, 3000);
    }
  };

  const formProfile = document.getElementById("form-profile");

  if (formProfile) {
    formProfile.addEventListener("submit", function (e) {
      e.preventDefault();

      const btnSubmit = formProfile.querySelector('button[type="submit"]');
      const originalBtnText = btnSubmit.innerHTML;

      btnSubmit.disabled = true;
      btnSubmit.classList.add("opacity-75", "cursor-wait");
      btnSubmit.innerHTML = `
        MENYIMPAN...
        <svg class="w-5 h-5 ml-3 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
      `;

      const formData = new FormData(formProfile);

      fetch(formProfile.getAttribute("action"), {
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
          btnSubmit.disabled = false;
          btnSubmit.classList.remove("opacity-75", "cursor-wait");
          btnSubmit.innerHTML = originalBtnText;

          showToast("success", data.message);

          if (data.new_name) {
            const profileNameCard = document.querySelector(".w-20.h-20.mx-auto + h3");
            const profileInitial = document.querySelector(".w-20.h-20.mx-auto span");
            const navbarName = document.querySelector("button span.line-clamp-1");

            if (profileNameCard) profileNameCard.textContent = data.new_name.toUpperCase();
            if (profileInitial) profileInitial.textContent = data.new_name.charAt(0).toUpperCase();
            if (navbarName) navbarName.textContent = data.new_name.toUpperCase();
          }
        })
        .catch((error) => {
          btnSubmit.disabled = false;
          btnSubmit.classList.remove("opacity-75", "cursor-wait");
          btnSubmit.innerHTML = originalBtnText;

          if (error.status === 401) {
            window.location.href = error.data?.redirect || BASEURL + "/auth";
          } else {
            showToast("error", error.data?.message || "Terjadi kesalahan saat menyimpan.");
          }
        });
    });
  }
});
