tinymce.init({
  selector: "#add_content, #edit_content",
  plugins: "lists link code table",
  toolbar:
    "undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | code",
  menubar: false,
  promotion: false,
  branding: false,
  height: 350,
  setup: function (editor) {
    editor.on("change", function () {
      tinymce.triggerSave();
    });
  },
});

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
  const artData = JSON.parse(btnElement.getAttribute("data-art"));
  document.getElementById("edit_id").value = artData.id;
  document.getElementById("edit_title").value = artData.title;
  document.getElementById("edit_excerpt").value = artData.excerpt;

  document.getElementById("edit_content").value = artData.content;

  if (typeof tinymce !== "undefined" && tinymce.get("edit_content")) {
    tinymce.get("edit_content").setContent(artData.content);
  }

  const status = artData.status;
  document.getElementById("edit_hiddenStatus").value = status;
  document.getElementById("editStatusText").innerText = status.toUpperCase();

  openModal("editArticleModal");
}

function toggleGenericDropdown(menuId, iconId) {
  const menu = document.getElementById(menuId);
  const icon = document.getElementById(iconId);
  menu.classList.toggle("hidden");
  menu.classList.toggle("flex");
  icon.style.transform = menu.classList.contains("hidden") ? "rotate(0deg)" : "rotate(180deg)";
}

function toggleAddStatus() {
  toggleGenericDropdown("addStatusMenu", "addStatusIcon");
}
function selectAddStatus(val, name) {
  document.getElementById("add_hiddenStatus").value = val;
  document.getElementById("addStatusText").innerText = name;
  toggleAddStatus();
}

function toggleEditStatus() {
  toggleGenericDropdown("editStatusMenu", "editStatusIcon");
}
function selectEditStatus(val, name) {
  document.getElementById("edit_hiddenStatus").value = val;
  document.getElementById("editStatusText").innerText = name;
  toggleEditStatus();
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
    { wrapper: "addStatusDropdown", menu: "addStatusMenu", icon: "addStatusIcon" },
    { wrapper: "editStatusDropdown", menu: "editStatusMenu", icon: "editStatusIcon" },
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
    if (typeof tinymce !== "undefined") tinymce.triggerSave();

    closeModal("addArticleModal");
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
    if (typeof tinymce !== "undefined") tinymce.triggerSave();

    closeModal("editArticleModal");
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

let articleIdToDelete = null;

function deleteArticle(id) {
  articleIdToDelete = id;
  openModal("confirmDeleteModal");
}

function executeDeleteArticle() {
  closeModal("confirmDeleteModal");
  fetch(`${BASEURL}/adminarticle/delete/${articleIdToDelete}`, {
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
  const statusFilter = document.getElementById("statusFilter").value.toUpperCase();
  filteredRows = [];

  document.querySelectorAll("table tbody tr.article-row").forEach((tr) => {
    const tdTitle = tr.getElementsByTagName("td")[1];
    const tdAuthor = tr.getElementsByTagName("td")[2];
    const tdStatus = tr.getElementsByTagName("td")[4];

    if (tdTitle && tdAuthor && tdStatus) {
      const titleVal = tdTitle.textContent.toUpperCase();
      const authorVal = tdAuthor.textContent.toUpperCase();
      const statusVal = tdStatus.textContent.trim().toUpperCase();

      const matchSearch = titleVal.includes(searchFilter) || authorVal.includes(searchFilter);
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

function resetFilter() {
  document.getElementById("statusFilter").value = "ALL";
  document.getElementById("filterStatusText").innerText = "STATUS_ALL";
  document.getElementById("searchInput").value = "";
  filterTable();
}

document.addEventListener("DOMContentLoaded", filterTable);
