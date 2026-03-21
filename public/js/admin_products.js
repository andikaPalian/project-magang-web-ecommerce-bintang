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
  document.getElementById(type === "success" ? "successMessage" : "errorMessage").innerText =
    message;
  openModal(type === "success" ? "successModal" : "errorModal");
}

function reloadPage() {
  window.location.reload();
}

function openEditModal(btnElement) {
  const product = JSON.parse(btnElement.getAttribute("data-product"));

  document.getElementById("edit_id").value = product.id;
  document.getElementById("edit_name").value = product.name;
  document.getElementById("edit_price").value = product.price;
  document.getElementById("edit_discount").value = product.discount_price || "";
  document.getElementById("edit_weight").value = product.weight_grams;
  document.getElementById("edit_description").value = product.description;

  document.getElementById("edit_hiddenCategoryInput").value = product.category_id;
  document.getElementById("editCategorySelectedText").innerText =
    product.category_name || "-- SELECT CATEGORY --";

  document.getElementById("edit_hiddenStatusInput").value = product.is_active;
  document.getElementById("editStatusSelectedText").innerText =
    product.is_active == 1 ? "ACTIVE / PUBLISHED" : "DRAFT / HIDDEN";

  openModal("editProductModal");
}

function toggleGenericDropdown(menuId, iconId) {
  const menu = document.getElementById(menuId);
  const icon = document.getElementById(iconId);
  menu.classList.toggle("hidden");
  menu.classList.toggle("flex");
  icon.style.transform = menu.classList.contains("hidden") ? "rotate(0deg)" : "rotate(180deg)";
}

function toggleEditCategory() {
  toggleGenericDropdown("editCategoryMenu", "editCategoryIcon");
}
function toggleEditStatus() {
  toggleGenericDropdown("editStatusMenu", "editStatusIcon");
}

function selectEditCategory(id, name) {
  document.getElementById("edit_hiddenCategoryInput").value = id;
  document.getElementById("editCategorySelectedText").innerText = name;
  toggleEditCategory();
}

function selectEditStatus(val, name) {
  document.getElementById("edit_hiddenStatusInput").value = val;
  document.getElementById("editStatusSelectedText").innerText = name;
  toggleEditStatus();
}

function toggleFilterCategory() {
  toggleGenericDropdown("filterCategoryMenu", "filterCategoryIcon");
}

function selectFilterCategory(val, name) {
  document.getElementById("categoryFilter").value = val;
  document.getElementById("filterCategoryText").innerText = name;
  toggleFilterCategory();
  filterTable();
}

document.addEventListener("click", (event) => {
  const dropdowns = [
    { wrapper: "editCustomCategoryDropdown", menu: "editCategoryMenu", icon: "editCategoryIcon" },
    { wrapper: "editCustomStatusDropdown", menu: "editStatusMenu", icon: "editStatusIcon" },
    { wrapper: "filterCategoryDropdown", menu: "filterCategoryMenu", icon: "filterCategoryIcon" },
  ];

  dropdowns.forEach(({ wrapper, menu, icon }) => {
    const elWrapper = document.getElementById(wrapper);
    const elMenu = document.getElementById(menu);
    if (elWrapper && elMenu && !elWrapper.contains(event.target)) {
      elMenu.classList.add("hidden");
      elMenu.classList.remove("flex");
      const elIcon = document.getElementById(icon);
      if (elIcon) elIcon.style.transform = "rotate(0deg)";
    }
  });
});

let productIdToDelete = null;

function deleteProduct(productId) {
  productIdToDelete = productId;
  openModal("confirmDeleteProductModal");
}

function executeDeleteProduct() {
  closeModal("confirmDeleteProductModal");
  fetch(`${BASEURL}/adminproduct/delete/${productIdToDelete}`, {
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
        showAlert("success", data.message);
      } else {
        showAlert("error", data.message);
      }
    })
    .catch(() => showAlert("error", "Koneksi terputus. Gagal menghubungi server."));
}

function openSpecModal(productId, productName) {
  document.getElementById("specProductName").innerText = `MANAGE SPECS: ${productName}`;
  document.getElementById("spec_product_id").value = productId;
  const tbody = document.getElementById("specTableBody");

  tbody.innerHTML = `<tr><td colspan="3" class="p-4 text-center font-black uppercase text-gray-400">Loading Data...</td></tr>`;
  openModal("specModal");

  fetch(`${BASEURL}/adminproduct/getSpecs/${productId}`, {
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  })
    .then((res) => res.json())
    .then(({ data }) => {
      if (data.length === 0) {
        tbody.innerHTML = `<tr><td colspan="3" class="p-6 text-center text-gray-500 font-black uppercase text-xs">Belum ada spesifikasi.</td></tr>`;
        return;
      }
      tbody.innerHTML = data
        .map(
          (spec) => `
        <tr class="border-b-2 border-black hover:bg-gray-100 transition-colors" id="spec-row-${spec.id}">
          <td class="p-3 border-r-2 border-black w-1/3">${spec.spec_name}</td>
          <td class="p-3 border-r-2 border-black w-1/2">${spec.spec_value}</td>
          <td class="p-3 text-center flex justify-center gap-3 mt-1">
            <button onclick="editSpecRow(${spec.id}, '${spec.spec_name.replace(/'/g, "\\'")}', '${spec.spec_value.replace(/'/g, "\\'")}', ${productId})" class="text-[#2563EB] hover:underline text-[10px] font-black uppercase tracking-widest">EDIT</button>
            <button onclick="deleteSpec(${spec.id}, ${productId})" class="text-[#FF5757] hover:underline text-[10px] font-black uppercase tracking-widest">HAPUS</button>
          </td>
        </tr>
      `,
        )
        .join("");
    })
    .catch(() => {
      tbody.innerHTML = `<tr><td colspan="3" class="p-4 text-center text-[#FF5757] font-black uppercase">Gagal memuat data dari server!</td></tr>`;
    });
}

function editSpecRow(specId, currentName, currentValue, productId) {
  document.getElementById(`spec-row-${specId}`).innerHTML = `
    <td class="p-2 border-r-2 border-black w-1/3">
      <input type="text" id="edit-spec-name-${specId}" value="${currentName}" class="w-full p-2 bg-[#F8F9FA] border-2 border-black font-bold text-xs uppercase focus:outline-none focus:bg-white focus:shadow-[2px_2px_0_0_#2563EB] transition-all">
    </td>
    <td class="p-2 border-r-2 border-black w-1/2">
      <input type="text" id="edit-spec-val-${specId}" value="${currentValue}" class="w-full p-2 bg-[#F8F9FA] border-2 border-black font-bold text-xs focus:outline-none focus:bg-white focus:shadow-[2px_2px_0_0_#2563EB] transition-all">
    </td>
    <td class="p-2 text-center flex justify-center gap-2 mt-0.5">
      <button onclick="saveSpecRow(${specId}, ${productId})" class="bg-[#FFE600] text-black px-2 py-1 border-2 border-black text-[10px] font-black uppercase shadow-[2px_2px_0_0_#000] hover:-translate-y-0.5 transition-all">SAVE</button>
      <button onclick="openSpecModal(${productId}, document.getElementById('specProductName').innerText.replace('MANAGE SPECS: ', ''))" class="bg-white text-black px-2 py-1 border-2 border-black text-[10px] font-black uppercase shadow-[2px_2px_0_0_#000] hover:-translate-y-0.5 transition-all">X</button>
    </td>
  `;
}

function saveSpecRow(specId, productId) {
  const formData = new FormData();
  formData.append("id", specId);
  formData.append("spec_name", document.getElementById(`edit-spec-name-${specId}`).value);
  formData.append("spec_value", document.getElementById(`edit-spec-val-${specId}`).value);

  fetch(`${BASEURL}/adminproduct/updateSpecs`, {
    method: "POST",
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
        openSpecModal(
          productId,
          document.getElementById("specProductName").innerText.replace("MANAGE SPECS: ", ""),
        );
      } else {
        showAlert("error", data.message);
      }
    })
    .catch(() => showAlert("error", "Gagal memperbarui spesifikasi."));
}

const addSpecForm = document.getElementById("addSpecForm");
if (addSpecForm) {
  addSpecForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch(this.action, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.status === "success") {
          this.reset();
          openSpecModal(
            formData.get("product_id"),
            document.getElementById("specProductName").innerText.replace("MANAGE SPECS: ", ""),
          );
        } else {
          showAlert("error", data.message);
        }
      })
      .catch(() => showAlert("error", "Gagal menyimpan spesifikasi."));
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
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
        openSpecModal(
          productIdForSpec,
          document.getElementById("specProductName").innerText.replace("MANAGE SPECS: ", ""),
        );
      } else {
        showAlert("error", data.message);
      }
    })
    .catch(() => showAlert("error", "Gagal menghapus spesifikasi."));
}

const editForm = document.getElementById("editForm");
if (editForm) {
  editForm.addEventListener("submit", function (e) {
    e.preventDefault();
    closeModal("editProductModal");
    fetch(this.action, {
      method: "POST",
      headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
      body: new FormData(this),
    })
      .then((res) => res.json())
      .then((data) => showAlert(data.status, data.message))
      .catch(() => showAlert("error", "Gagal memperbarui produk."));
  });
}

let currentPage = 1;
const rowsPerPage = 5;
let filteredRows = [];

function filterTable() {
  const categoryFilter = document.getElementById("categoryFilter").value.toUpperCase();
  const searchFilter = document.getElementById("searchInput").value.toUpperCase();
  filteredRows = [];

  document.querySelectorAll("table tbody tr.product-row").forEach((tr) => {
    try {
      const tdName = tr.getElementsByTagName("td")[1];
      const tdCategory = tr.getElementsByTagName("td")[2];

      if (tdName && tdCategory) {
        const nameSpan = tdName.querySelector(".product-name-text");
        const nameValue = (nameSpan ? nameSpan.textContent : tdName.textContent).toUpperCase();
        const categoryValue = tdCategory.textContent.trim().toUpperCase();

        const matchCategory = categoryFilter === "ALL" || categoryValue.includes(categoryFilter);
        const matchSearch = nameValue.includes(searchFilter);

        if (matchCategory && matchSearch) {
          filteredRows.push(tr);
        } else {
          tr.style.display = "none";
        }
      }
    } catch (e) {
      console.error("Error filtering row:", e);
    }
  });

  const noResultRow = document.getElementById("noResultRow");
  if (noResultRow && typeof HAS_REAL_DATA !== "undefined" && HAS_REAL_DATA) {
    noResultRow.classList.toggle("hidden", filteredRows.length > 0);
  }

  currentPage = 1;
  displayPage();
}

function displayPage() {
  filteredRows.forEach((tr) => (tr.style.display = "none"));

  const start = (currentPage - 1) * rowsPerPage;
  filteredRows.slice(start, start + rowsPerPage).forEach((tr) => (tr.style.display = ""));

  updatePaginationUI();
}

function updatePaginationUI() {
  const totalRows = filteredRows.length;
  const totalPages = Math.ceil(totalRows / rowsPerPage);
  const infoDiv = document.getElementById("paginationInfo");
  const controlsDiv = document.getElementById("paginationControls");

  if (totalRows === 0) {
    infoDiv.innerHTML = "SHOWING 0 OF 0 ENTRIES";
    controlsDiv.innerHTML = "";
    return;
  }

  const currentStart = (currentPage - 1) * rowsPerPage + 1;
  const currentEnd = Math.min(currentPage * rowsPerPage, totalRows);
  infoDiv.innerHTML = `SHOWING ${currentStart}-${currentEnd} OF ${totalRows} ENTRIES`;

  let html = `<button onclick="changePage(${currentPage - 1})" class="w-10 h-10 flex items-center justify-center bg-white border-4 border-black font-black text-sm shadow-[4px_4px_0_0_#000] hover:bg-gray-100 hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all ${currentPage === 1 ? "opacity-50 cursor-not-allowed pointer-events-none" : ""}">&lt;</button>`;

  for (let i = 1; i <= totalPages; i++) {
    const activeClass =
      i === currentPage
        ? "bg-black text-white shadow-[4px_4px_0_0_#000]"
        : "bg-white text-black shadow-[4px_4px_0_0_#000] hover:bg-gray-100 hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none";
    html += `<button onclick="changePage(${i})" class="w-10 h-10 flex items-center justify-center border-4 border-black font-black text-sm transition-all ${activeClass}">${i}</button>`;
  }

  html += `<button onclick="changePage(${currentPage + 1})" class="w-10 h-10 flex items-center justify-center bg-white border-4 border-black font-black text-sm shadow-[4px_4px_0_0_#000] hover:bg-gray-100 hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all ${currentPage === totalPages ? "opacity-50 cursor-not-allowed pointer-events-none" : ""}">&gt;</button>`;

  controlsDiv.innerHTML = html;
}

function changePage(page) {
  currentPage = page;
  displayPage();
}

function resetFilter() {
  document.getElementById("categoryFilter").value = "ALL";
  document.getElementById("filterCategoryText").innerText = "ALL CATEGORIES";
  document.getElementById("searchInput").value = "";
  filterTable();
}

document.addEventListener("DOMContentLoaded", filterTable);
