function openModal(modalId) {
  document.getElementById(modalId).classList.remove("hidden");
  document.getElementById(modalId).classList.add("flex");
  document.body.style.overflow = "hidden";
}

function closeModal(modalId) {
  document.getElementById(modalId).classList.add("hidden");
  document.getElementById(modalId).classList.remove("flex");
  document.body.style.overflow = "auto";
}

function showAlert(type, message) {
  if (type === "success") {
    document.getElementById("successMessage").innerText = message;
    openModal("successModal");
  } else {
    document.getElementById("errorMessage").innerText = message;
    openModal("errorModal");
  }
}

function reloadPage() {
  window.location.reload();
}

function openEditModal(productData) {
  document.getElementById("edit_id").value = productData.id;
  document.getElementById("edit_name").value = productData.name;
  document.getElementById("edit_category_id").value = productData.category_id;
  document.getElementById("edit_price").value = productData.price;
  document.getElementById("edit_discount").value = productData.discount_price || "";
  document.getElementById("edit_weight").value = productData.weight_grams;
  document.getElementById("edit_description").value = productData.description;
  document.getElementById("edit_status").value = productData.is_active;
  openModal("editProductModal");
}

function openSpecModal(productId, productName) {
  document.getElementById("specProductName").innerText = `MANAGE SPECS: ${productName}`;
  document.getElementById("spec_product_id").value = productId;
  document.getElementById("specTableBody").innerHTML =
    `<tr><td colspan="3" class="p-4 text-center font-black uppercase text-gray-400">Loading Data...</td></tr>`;
  openModal("specModal");

  fetch(`${BASEURL}/adminproduct/getSpecs/${productId}`, {
    headers: { Accept: "application/json" },
  })
    .then((res) => res.json())
    .then((response) => {
      let html = "";
      if (response.data.length === 0) {
        html = `<tr><td colspan="3" class="p-6 text-center text-gray-500 font-black uppercase text-xs">Belum ada spesifikasi.</td></tr>`;
      } else {
        response.data.forEach((spec) => {
          html += `
          <tr class="border-b-2 border-black hover:bg-gray-100 transition-colors">
            <td class="p-3 border-r-2 border-black w-1/3">${spec.spec_name}</td>
            <td class="p-3 border-r-2 border-black w-1/2">${spec.spec_value}</td>
            <td class="p-3 text-center">
              <button onclick="deleteSpec(${spec.id}, ${productId})" class="text-[#FF5757] hover:underline text-xs font-black uppercase tracking-widest">HAPUS</button>
            </td>
          </tr>
        `;
        });
      }
      document.getElementById("specTableBody").innerHTML = html;
    })
    .catch(() => {
      document.getElementById("specTableBody").innerHTML =
        `<tr><td colspan="3" class="p-4 text-center text-[#FF5757] font-black uppercase">Gagal memuat data dari server!</td></tr>`;
    });
}

const addSpecForm = document.getElementById("addSpecForm");
if (addSpecForm) {
  addSpecForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const productId = formData.get("product_id");

    fetch(this.action, {
      method: "POST",
      headers: { Accept: "application/json" },
      body: formData,
    })
      .then((res) => res.text())
      .then((text) => {
        try {
          const data = JSON.parse(text);
          if (data.status === "success") {
            addSpecForm.reset();
            openSpecModal(
              productId,
              document.getElementById("specProductName").innerText.replace("MANAGE SPECS: ", ""),
            );
          } else {
            showAlert("error", data.message);
          }
        } catch (err) {
          showAlert("error", "Terjadi kesalahan internal pada server saat menyimpan spesifikasi.");
        }
      })
      .catch(() => {
        showAlert("error", "Gagal terhubung ke server. Periksa koneksi Anda.");
      });
  });
}

let specIdToDelete = null;
let productIdForSpec = null;

function deleteSpec(specId, productId) {
  specIdToDelete = specId;
  productIdForSpec = productId;
  openModal("confirmDeleteModal");
}

function executeDeleteSpec() {
  closeModal("confirmDeleteModal");

  const formData = new FormData();
  formData.append("id", specIdToDelete);

  fetch(`${BASEURL}/adminproduct/deleteSpecs`, {
    method: "POST",
    headers: { Accept: "application/json" },
    body: formData,
  })
    .then((res) => res.text())
    .then((text) => {
      try {
        const data = JSON.parse(text);
        if (data.status === "success") {
          openSpecModal(
            productIdForSpec,
            document.getElementById("specProductName").innerText.replace("MANAGE SPECS: ", ""),
          );
        } else {
          showAlert("error", data.message);
        }
      } catch (err) {
        showAlert("error", "Terjadi kesalahan internal pada server saat menghapus spesifikasi.");
      }
    })
    .catch(() => {
      showAlert("error", "Koneksi terputus. Gagal menghubungi server.");
    });
}

const addForm = document.getElementById("addForm");
if (addForm) {
  addForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    closeModal("addProductModal");
    fetch(this.action, {
      method: "POST",
      headers: { Accept: "application/json" },
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        data.status === "success"
          ? showAlert("success", data.message)
          : showAlert("error", data.message);
      })
      .catch(() => showAlert("error", "Gagal terhubung ke server. Pastikan koneksi stabil."));
  });
}

const editForm = document.getElementById("editForm");
if (editForm) {
  editForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    closeModal("editProductModal");
    fetch(this.action, {
      method: "POST",
      headers: { Accept: "application/json" },
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        data.status === "success"
          ? showAlert("success", data.message)
          : showAlert("error", data.message);
      })
      .catch(() => showAlert("error", "Gagal terhubung ke server. Pastikan koneksi stabil."));
  });
}

let currentPage = 1;
const rowsPerPage = 5;
let filteredRows = [];

function filterTable() {
  const categoryFilter = document.getElementById("categoryFilter").value.toUpperCase();
  const searchFilter = document.getElementById("searchInput").value.toUpperCase();
  const trs = Array.from(document.querySelectorAll("table tbody tr.product-row"));
  filteredRows = [];

  trs.forEach((tr) => {
    const tdDetails = tr.getElementsByTagName("td")[0];
    if (tdDetails) {
      const nameValue =
        tdDetails.querySelector("span.max-w-xs").textContent ||
        tdDetails.querySelector("span.max-w-xs").innerText;
      const categoryValue =
        tdDetails.querySelector(".product-category").textContent ||
        tdDetails.querySelector(".product-category").innerText;

      const matchCategory =
        categoryFilter === "ALL" || categoryValue.toUpperCase().includes(categoryFilter);
      const matchSearch = nameValue.toUpperCase().includes(searchFilter);

      if (matchCategory && matchSearch) {
        filteredRows.push(tr);
      } else {
        tr.style.display = "none";
      }
    }
  });

  const noResultRow = document.getElementById("noResultRow");
  if (noResultRow && typeof HAS_REAL_DATA !== "undefined" && HAS_REAL_DATA) {
    if (filteredRows.length === 0) {
      noResultRow.classList.remove("hidden");
    } else {
      noResultRow.classList.add("hidden");
    }
  }
  currentPage = 1;
  displayPage();
}

function displayPage() {
  filteredRows.forEach((tr) => (tr.style.display = "none"));
  const start = (currentPage - 1) * rowsPerPage;
  const end = start + rowsPerPage;
  const paginatedRows = filteredRows.slice(start, end);
  paginatedRows.forEach((tr) => (tr.style.display = ""));
  updatePaginationUI();
}

function updatePaginationUI() {
  const totalRows = filteredRows.length;
  const totalPages = Math.ceil(totalRows / rowsPerPage);
  const infoDiv = document.getElementById("paginationInfo");
  const controlsDiv = document.getElementById("paginationControls");

  if (totalRows === 0) {
    infoDiv.innerHTML = "SHOWING 0 OF 0 PRODUCTS";
    controlsDiv.innerHTML = "";
    return;
  }

  const currentStart = (currentPage - 1) * rowsPerPage + 1;
  const currentEnd = Math.min(currentPage * rowsPerPage, totalRows);
  infoDiv.innerHTML = `SHOWING ${currentStart}-${currentEnd} OF ${totalRows} PRODUCTS`;

  let html = "";
  const prevDisabled = currentPage === 1 ? "opacity-50 cursor-not-allowed pointer-events-none" : "";
  html += `<button onclick="changePage(${currentPage - 1})" class="w-10 h-10 flex items-center justify-center bg-white border-2 border-black font-black text-sm shadow-[4px_4px_0_0_#000] hover:bg-gray-100 hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all ${prevDisabled}">&lt;</button>`;

  for (let i = 1; i <= totalPages; i++) {
    const activeClass =
      i === currentPage
        ? "bg-black text-white shadow-[4px_4px_0_0_#000]"
        : "bg-white text-black shadow-[4px_4px_0_0_#000] hover:bg-gray-100 hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none";
    html += `<button onclick="changePage(${i})" class="w-10 h-10 flex items-center justify-center border-2 border-black font-black text-sm transition-all ${activeClass}">${i}</button>`;
  }

  const nextDisabled =
    currentPage === totalPages ? "opacity-50 cursor-not-allowed pointer-events-none" : "";
  html += `<button onclick="changePage(${currentPage + 1})" class="w-10 h-10 flex items-center justify-center bg-white border-2 border-black font-black text-sm shadow-[4px_4px_0_0_#000] hover:bg-gray-100 hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all ${nextDisabled}">&gt;</button>`;

  controlsDiv.innerHTML = html;
}

function changePage(page) {
  currentPage = page;
  displayPage();
}

function resetFilter() {
  document.getElementById("categoryFilter").value = "ALL";
  document.getElementById("searchInput").value = "";
  filterTable();
}

document.addEventListener("DOMContentLoaded", () => {
  filterTable();
});
