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
  const userData = JSON.parse(btnElement.getAttribute("data-user"));

  document.getElementById("edit_id").value = userData.id;
  document.getElementById("edit_name").value = userData.name;
  document.getElementById("edit_email").value = userData.email;
  document.getElementById("edit_phone").value = userData.phone || "";
  document.getElementById("edit_address").value = userData.address || "-";
  document.getElementById("edit_location_id").value = user.location_id || "";

  const roleValue = userData.role;
  let roleText = roleValue.replace("_", " ").toUpperCase();

  document.getElementById("edit_hiddenRoleInput").value = roleValue;
  document.getElementById("editRoleSelectedText").innerText = roleText;
  document.getElementById("editRoleSelectedText").classList.remove("text-gray-400");
  document.getElementById("editRoleSelectedText").classList.add("text-black");

  openModal("editStaffModal");
}

function toggleGenericDropdown(menuId, iconId) {
  const menu = document.getElementById(menuId);
  const icon = document.getElementById(iconId);
  menu.classList.toggle("hidden");
  menu.classList.toggle("flex");
  icon.style.transform = menu.classList.contains("hidden") ? "rotate(0deg)" : "rotate(180deg)";
}

function toggleAddRole() {
  toggleGenericDropdown("addRoleMenu", "addRoleIcon");
}
function selectAddRole(val, name) {
  document.getElementById("add_hiddenRoleInput").value = val;
  const txt = document.getElementById("addRoleSelectedText");
  txt.innerText = name;
  txt.classList.remove("text-gray-400");
  txt.classList.add("text-black");
  toggleAddRole();
}

function toggleEditRole() {
  toggleGenericDropdown("editRoleMenu", "editRoleIcon");
}
function selectEditRole(val, name) {
  document.getElementById("edit_hiddenRoleInput").value = val;
  document.getElementById("editRoleSelectedText").innerText = name;
  toggleEditRole();
}

function toggleFilterRole() {
  toggleGenericDropdown("filterRoleMenu", "filterRoleIcon");
}
function selectFilterRole(val, name) {
  document.getElementById("roleFilter").value = val;
  document.getElementById("filterRoleText").innerText = name;
  toggleFilterRole();
  filterTable();
}

document.addEventListener("click", (event) => {
  const dropdowns = [
    { wrapper: "addCustomRoleDropdown", menu: "addRoleMenu", icon: "addRoleIcon" },
    { wrapper: "editCustomRoleDropdown", menu: "editRoleMenu", icon: "editRoleIcon" },
    { wrapper: "filterRoleDropdown", menu: "filterRoleMenu", icon: "filterRoleIcon" },
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
    closeModal("addStaffModal");
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
      .catch(() => showAlert("error", "Gagal menghubungi server."));
  });
}

const editForm = document.getElementById("editForm");
if (editForm) {
  editForm.addEventListener("submit", function (e) {
    e.preventDefault();
    closeModal("editStaffModal");
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
      .catch(() => showAlert("error", "Gagal memperbarui data user."));
  });
}

let userIdToDelete = null;

function deleteUser(userId) {
  userIdToDelete = userId;
  openModal("confirmDeleteModal");
}

function executeDeleteUser() {
  closeModal("confirmDeleteModal");
  fetch(`${BASEURL}/adminuser/deleteUser/${userIdToDelete}`, {
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  })
    .then((res) => res.json())
    .then((data) => showAlert(data.status, data.message))
    .catch(() => showAlert("error", "Koneksi terputus. Gagal menghubungi server."));
}

let currentPage = 1;
const rowsPerPage = 5;
let filteredRows = [];

function filterTable() {
  const roleFilter = document.getElementById("roleFilter").value.toUpperCase();
  const searchFilter = document.getElementById("searchInput").value.toUpperCase();
  filteredRows = [];

  document.querySelectorAll("table tbody tr.user-row").forEach((tr) => {
    try {
      const tdName = tr.getElementsByTagName("td")[1];
      const tdRole = tr.getElementsByTagName("td")[2];

      if (tdName && tdRole) {
        const nameValue = tdName.querySelector(".user-name-text")
          ? tdName.querySelector(".user-name-text").textContent.toUpperCase()
          : tdName.textContent.toUpperCase();
        const roleValue = tdRole.textContent.trim().toUpperCase();

        const matchRole = roleFilter === "ALL" || roleValue.includes(roleFilter);
        const matchSearch = nameValue.includes(searchFilter);

        if (matchRole && matchSearch) {
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
  document.getElementById("roleFilter").value = "ALL";
  document.getElementById("filterRoleText").innerText = "ALL ROLES";
  document.getElementById("searchInput").value = "";
  filterTable();
}

document.addEventListener("DOMContentLoaded", filterTable);
