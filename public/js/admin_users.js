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

function openEditModal(userData) {
  document.getElementById("edit_id").value = userData.id;
  document.getElementById("edit_name").value = userData.name;
  document.getElementById("edit_email").value = userData.email;
  document.getElementById("edit_phone").value = userData.phone || "";
  document.getElementById("edit_role").value = userData.role;
  document.getElementById("edit_address").value = userData.address || "-";
  openModal("editStaffModal");
}

let currentPage = 1;
const rowsPerPage = 5;
let filteredRows = [];

function filterTable() {
  const roleFilter = document.getElementById("roleFilter").value.toUpperCase();
  const searchFilter = document.getElementById("searchInput").value.toUpperCase();

  const trs = Array.from(document.querySelectorAll("table tbody tr.user-row"));
  filteredRows = [];

  trs.forEach((tr) => {
    const tdName = tr.getElementsByTagName("td")[0];
    const tdEmail = tr.getElementsByTagName("td")[1];
    const tdRole = tr.getElementsByTagName("td")[2];

    if (tdName && tdEmail && tdRole) {
      const nameValue = tdName.textContent || tdName.innerText;
      const emailValue = tdEmail.textContent || tdEmail.innerText;
      const roleValue = tdRole.textContent || tdRole.innerText;

      const matchRole = roleFilter === "ALL" || roleValue.toUpperCase().includes(roleFilter);
      const matchSearch =
        nameValue.toUpperCase().includes(searchFilter) ||
        emailValue.toUpperCase().includes(searchFilter);

      if (matchRole && matchSearch) {
        filteredRows.push(tr);
      } else {
        tr.style.display = "none";
      }
    }
  });

  const noResultRow = document.getElementById("noResultRow");

  // Menggunakan variabel global HAS_REAL_DATA dari file View
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
    infoDiv.innerHTML = "SHOWING 0 OF 0 REGISTERED USERS";
    controlsDiv.innerHTML = "";
    return;
  }

  const currentStart = (currentPage - 1) * rowsPerPage + 1;
  const currentEnd = Math.min(currentPage * rowsPerPage, totalRows);
  infoDiv.innerHTML = `SHOWING ${currentStart}-${currentEnd} OF ${totalRows} REGISTERED USERS`;

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
  document.getElementById("roleFilter").value = "ALL";
  document.getElementById("searchInput").value = "";
  filterTable();
}

document.addEventListener("DOMContentLoaded", () => {
  filterTable();
});
