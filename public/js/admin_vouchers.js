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
  const vData = JSON.parse(btnElement.getAttribute("data-voucher"));

  document.getElementById("edit_id").value = vData.id;
  document.getElementById("edit_code").value = vData.code;
  document.getElementById("edit_amount").value = vData.discount_amount;
  document.getElementById("edit_min").value = vData.min_purchase;
  document.getElementById("edit_expiry").value = vData.valid_until;
  document.getElementById("edit_active").checked = vData.is_active == 1;

  const typeVal = vData.discount_type;
  const typeText = typeVal === "percent" ? "PERCENTAGE (%)" : "FIXED (Rp)";
  document.getElementById("edit_hiddenType").value = typeVal;
  document.getElementById("editTypeText").innerText = typeText;

  openModal("editVoucherModal");
}

function toggleGenericDropdown(menuId, iconId) {
  const menu = document.getElementById(menuId);
  const icon = document.getElementById(iconId);
  menu.classList.toggle("hidden");
  menu.classList.toggle("flex");
  icon.style.transform = menu.classList.contains("hidden") ? "rotate(0deg)" : "rotate(180deg)";
}

function toggleAddType() {
  toggleGenericDropdown("addTypeMenu", "addTypeIcon");
}
function selectAddType(val, name) {
  document.getElementById("add_hiddenType").value = val;
  document.getElementById("addTypeText").innerText = name;
  toggleAddType();
}

function toggleEditType() {
  toggleGenericDropdown("editTypeMenu", "editTypeIcon");
}
function selectEditType(val, name) {
  document.getElementById("edit_hiddenType").value = val;
  document.getElementById("editTypeText").innerText = name;
  toggleEditType();
}

function toggleFilterStatus() {
  toggleGenericDropdown("filterStatusMenu", "filterStatusIcon");
}
function selectFilterStatus(val, name) {
  document.getElementById("statusFilter").value = val;
  document.getElementById("filterStatusText").innerText = name;
  toggleFilterStatus();
  filterTable();
}

document.addEventListener("click", (event) => {
  const dropdowns = [
    { wrapper: "addTypeDropdown", menu: "addTypeMenu", icon: "addTypeIcon" },
    { wrapper: "editTypeDropdown", menu: "editTypeMenu", icon: "editTypeIcon" },
    { wrapper: "filterStatusDropdown", menu: "filterStatusMenu", icon: "filterStatusIcon" },
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

const addForm = document.getElementById("addForm");
if (addForm) {
  addForm.addEventListener("submit", function (e) {
    e.preventDefault();
    closeModal("addVoucherModal");
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

    const formData = new FormData(this);
    if (!document.getElementById("edit_active").checked) {
      formData.set("is_active", "0");
    }

    closeModal("editVoucherModal");
    fetch(this.action, {
      method: "POST",
      headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => showAlert(data.status, data.message))
      .catch(() => showAlert("error", "Gagal memperbarui data."));
  });
}

let voucherIdToDelete = null;

function deleteVoucher(id) {
  voucherIdToDelete = id;
  openModal("confirmDeleteModal");
}

function executeDeleteVoucher() {
  closeModal("confirmDeleteModal");
  fetch(`${BASEURL}/adminvoucher/delete/${voucherIdToDelete}`, {
    headers: { Accept: "application/json", "X-Requested-With": "XMLHttpRequest" },
  })
    .then((res) => res.json())
    .then((data) => showAlert(data.status, data.message))
    .catch(() => showAlert("error", "Koneksi terputus."));
}

let currentPage = 1;
const rowsPerPage = 5;
let filteredRows = [];

function filterTable() {
  const searchFilter = document.getElementById("searchInput").value.toUpperCase();
  const statusFilter = document.getElementById("statusFilter").value.toUpperCase();
  filteredRows = [];

  document.querySelectorAll("table tbody tr.voucher-row").forEach((tr) => {
    const tdCode = tr.querySelector(".voucher-code-text");
    const tdStatus = tr.querySelector(".voucher-status-text");

    if (tdCode && tdStatus) {
      const codeVal = tdCode.textContent.toUpperCase();
      const statusVal = tdStatus.textContent.trim().toUpperCase();

      const matchSearch = codeVal.includes(searchFilter);
      const matchStatus = statusFilter === "ALL" || statusVal === statusFilter;

      if (matchSearch && matchStatus) {
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
    infoDiv.innerHTML = "PAGE_000_OF_000";
    controlsDiv.innerHTML = "";
    return;
  }

  const paddedCurrent = String(currentPage).padStart(3, "0");
  const paddedTotal = String(totalPages).padStart(3, "0");
  infoDiv.innerHTML = `PAGE_${paddedCurrent}_OF_${paddedTotal}`;

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
