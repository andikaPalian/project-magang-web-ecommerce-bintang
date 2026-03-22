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
  const catData = JSON.parse(btnElement.getAttribute("data-cat"));
  document.getElementById("edit_id").value = catData.id;
  document.getElementById("edit_name").value = catData.name;
  openModal("editCategoryModal");
}

const addForm = document.getElementById("addForm");
if (addForm) {
  addForm.addEventListener("submit", function (e) {
    e.preventDefault();
    closeModal("addCategoryModal");
    fetch(this.action, {
      method: "POST",
      headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
      body: new FormData(this),
    })
      .then((res) => res.json())
      .then((data) => showAlert(data.status, data.message))
      .catch(() => showAlert("error", "Gagal menghubungi server."));
  });
}

const editForm = document.getElementById("editForm");
if (editForm) {
  editForm.addEventListener("submit", function (e) {
    e.preventDefault();
    closeModal("editCategoryModal");
    fetch(this.action, {
      method: "POST",
      headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
      body: new FormData(this),
    })
      .then((res) => res.json())
      .then((data) => showAlert(data.status, data.message))
      .catch(() => showAlert("error", "Gagal memperbarui data."));
  });
}

let categoryIdToDelete = null;

function deleteCategory(id) {
  categoryIdToDelete = id;
  openModal("confirmDeleteModal");
}

function executeDeleteCategory() {
  closeModal("confirmDeleteModal");
  fetch(`${BASEURL}/admincategory/delete/${categoryIdToDelete}`, {
    headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
  })
    .then((res) => res.json())
    .then((data) => showAlert(data.status, data.message))
    .catch(() => showAlert("error", "Koneksi terputus. Gagal menghubungi server."));
}

let currentPage = 1;
const rowsPerPage = 5;
let filteredRows = [];

function filterTable() {
  const searchFilter = document.getElementById("searchInput").value.toUpperCase();
  filteredRows = [];

  document.querySelectorAll("table tbody tr.category-row").forEach((tr) => {
    const tdName = tr.getElementsByTagName("td")[1];
    const tdSlug = tr.getElementsByTagName("td")[2];

    if (tdName && tdSlug) {
      const nameVal = tdName.textContent.toUpperCase();
      const slugVal = tdSlug.textContent.toUpperCase();

      if (nameVal.includes(searchFilter) || slugVal.includes(searchFilter)) {
        filteredRows.push(tr);
      } else {
        tr.style.display = "none";
      }
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
    infoDiv.innerHTML = "SHOWING 0 OF 0 CATEGORIES";
    controlsDiv.innerHTML = "";
    return;
  }

  const currentStart = (currentPage - 1) * rowsPerPage + 1;
  const currentEnd = Math.min(currentPage * rowsPerPage, totalRows);
  infoDiv.innerHTML = `SHOWING ${currentStart}-${currentEnd} OF ${totalRows} CATEGORIES`;

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

document.addEventListener("DOMContentLoaded", filterTable);
