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
