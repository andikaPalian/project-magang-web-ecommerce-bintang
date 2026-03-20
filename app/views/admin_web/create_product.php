<form action="<?= BASEURL; ?>/adminproduct/storeProduct" method="POST" enctype="multipart/form-data" id="productForm">

  <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b-4 border-black pb-6 mb-8 gap-4">
    <div>
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black">ADD NEW PRODUCT</h1>
    </div>
    <div class="flex gap-4 w-full md:w-auto">
      <a href="<?= BASEURL; ?>/adminproduct" class="flex-1 md:flex-none text-center bg-white text-black px-8 py-3 border-4 border-black font-black text-sm uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">
        DISCARD
      </a>
      <button type="submit" class="flex-1 md:flex-none bg-[#2563EB] text-white px-8 py-3 border-4 border-black font-black text-sm uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">
        SAVE PRODUCT
      </button>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">

    <div class="lg:col-span-7 space-y-8">
      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 lg:p-8 h-full">
        <h2 class="text-xl font-black uppercase tracking-widest mb-6 flex items-center">
          DATA PRODUK
        </h2>

        <div class="space-y-5">
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">NAMA PRODUK</label>
            <input type="text" name="name" required placeholder="MASUKKAN NAMA PRODUK" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all placeholder-gray-400">
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="space-y-2">
              <label class="text-[10px] font-black uppercase tracking-widest">HARGA (IDR)</label>
              <div class="relative flex">
                <span class="inline-flex items-center px-4 border-y-4 border-l-4 border-black bg-white font-black text-sm">Rp</span>
                <input type="number" name="price" required placeholder="0" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
              </div>
            </div>
            <div class="space-y-2">
              <label class="text-[10px] font-black uppercase tracking-widest">HARGA DISKON (OPTIONAL)</label>
              <div class="relative flex">
                <span class="inline-flex items-center px-4 border-y-4 border-l-4 border-black bg-white font-black text-sm">Rp</span>
                <input type="number" name="discount_price" placeholder="0" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="space-y-2">
              <label class="text-[10px] font-black uppercase tracking-widest">KATEGORI PRODUK</label>
              <div class="relative" id="customCategoryDropdown">
                <input type="hidden" name="category_id" id="hiddenCategoryInput" required>

                <button type="button" onclick="toggleCategoryDropdown()" id="categoryDropdownBtn" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all cursor-pointer text-left">
                  <span id="categorySelectedText" class="text-gray-400">-- SELECT CATEGORY --</span>
                  <svg class="w-4 h-4 text-black transition-transform" id="categoryIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </button>

                <div id="categoryMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col max-h-60 overflow-y-auto">
                  <?php foreach ($data['categories'] as $cat) : ?>
                    <div onclick="selectCategory('<?= $cat['id'] ?>', '<?= addslashes(htmlspecialchars($cat['name'])) ?>')" class="p-4 font-black uppercase border-b-2 border-black last:border-b-0 hover:bg-[#FFE600] cursor-pointer transition-colors text-black">
                      <?= htmlspecialchars($cat['name']) ?>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <div class="space-y-2">
              <label class="text-[10px] font-black uppercase tracking-widest">BERAT (GRAMS)</label>
              <div class="relative flex">
                <input type="number" name="weight_grams" required placeholder="0" class="w-full p-4 bg-[#F8F9FA] border-y-4 border-l-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
                <span class="inline-flex items-center px-4 border-4 border-black bg-white font-black text-sm">gr</span>
              </div>
            </div>
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">STATUS PRODUK</label>
            <div class="relative" id="customStatusDropdown">
              <input type="hidden" name="is_active" id="hiddenStatusInput" value="1" required>

              <button type="button" onclick="toggleStatusDropdown()" id="statusDropdownBtn" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all cursor-pointer text-left">
                <span id="statusSelectedText" class="text-black">PUBLISHED</span>
                <svg class="w-4 h-4 text-black transition-transform" id="statusIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>

              <div id="statusMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col max-h-40 overflow-y-auto">
                <div onclick="selectStatus('1', 'ACTIVE / PUBLISHED')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">
                  PUBLISHED
                </div>
                <div onclick="selectStatus('0', 'DRAFT / HIDDEN')" class="p-4 font-black uppercase hover:bg-[#FFE600] cursor-pointer transition-colors text-black">
                  DRAFT
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="lg:col-span-5 space-y-8">

      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 lg:p-8">
        <h2 class="text-xl font-black uppercase tracking-widest mb-6 flex items-center">
          FOTO PRODUK
        </h2>

        <div class="border-4 border-dashed border-black bg-[#F8F9FA] p-8 text-center hover:bg-[#FFE600] transition-colors relative cursor-pointer group focus-within:bg-white focus-within:shadow-[4px_4px_0_0_#2563EB] focus-within:-translate-y-1">
          <input type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/webp" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
          <svg class="w-16 h-16 mx-auto mb-4 text-black group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z" />
          </svg>
          <h4 class="font-black uppercase text-sm mb-1">DRAG_AND_DROP_IMAGE</h4>
          <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest group-hover:text-black">MAX_FILE_SIZE: 5MB // JPG, PNG, WEBP</p>
        </div>
      </div>

      <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 lg:p-8">
        <h2 class="text-xl font-black uppercase tracking-widest mb-6 flex items-center">
          SPESIFIKASI PRODUK
        </h2>

        <div id="specsContainer" class="space-y-4 mb-4">
          <div class="flex gap-2 spec-row">
            <input type="text" name="spec_name[]" placeholder="NAMA (Cth: RAM)" class="w-1/2 p-3 bg-[#F8F9FA] border-2 border-black font-bold text-xs uppercase focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
            <input type="text" name="spec_value[]" placeholder="NILAI (Cth: 16GB)" class="w-1/2 p-3 bg-[#F8F9FA] border-2 border-black font-bold text-xs focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
            <button type="button" onclick="removeSpecRow(this)" class="bg-[#FF5757] text-white px-3 border-2 border-black font-black hover:bg-black transition-colors">X</button>
          </div>
        </div>

        <button type="button" onclick="appendSpecRow()" class="w-full bg-white text-black py-3 border-4 border-black font-black text-xs uppercase tracking-widest hover:bg-[#A6FAAE] hover:-translate-y-1 shadow-[4px_4px_0_0_#000] active:translate-y-0 transition-all flex justify-center items-center">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
          </svg>
          TAMBAH SPESIFIKASI BARU
        </button>
      </div>
    </div>

  </div>

  <div class="w-full pb-10">
    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 lg:p-8">
      <h2 class="text-xl font-black uppercase tracking-widest mb-6 flex items-center">
        DESKRIPSI PRODUK
      </h2>

      <div class="border-4 border-black">
        <div class="bg-black text-white p-3 flex gap-4">
          <button type="button" class="font-black hover:text-[#FFE600] transition-colors">B</button>
          <button type="button" class="font-black italic hover:text-[#FFE600] transition-colors">I</button>
          <button type="button" class="font-black hover:text-[#FFE600] transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg></button>
          <button type="button" class="font-black hover:text-[#FFE600] transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
            </svg></button>
        </div>
        <textarea name="description" rows="10" required placeholder="Tuliskan deskripsi produk dengan lengkap di sini..." class="w-full p-6 bg-[#F8F9FA] font-bold text-base focus:outline-none focus:bg-white focus:shadow-inner transition-all resize-y"></textarea>
      </div>
    </div>
  </div>

</form>

<script>
  function toggleCategoryDropdown() {
    const menu = document.getElementById('categoryMenu');
    const icon = document.getElementById('categoryIcon');

    if (menu.classList.contains('hidden')) {
      menu.classList.remove('hidden');
      menu.classList.add('flex');
      icon.style.transform = 'rotate(180deg)';
    } else {
      menu.classList.add('hidden');
      menu.classList.remove('flex');
      icon.style.transform = 'rotate(0deg)';
    }
  }

  function selectCategory(id, name) {
    document.getElementById('hiddenCategoryInput').value = id;
    const textSpan = document.getElementById('categorySelectedText');
    textSpan.innerText = name;
    textSpan.classList.remove('text-gray-400');
    textSpan.classList.add('text-black');
    toggleCategoryDropdown();
  }

  function toggleStatusDropdown() {
    const menu = document.getElementById('statusMenu');
    const icon = document.getElementById('statusIcon');

    if (menu.classList.contains('hidden')) {
      menu.classList.remove('hidden');
      menu.classList.add('flex');
      icon.style.transform = 'rotate(180deg)';
    } else {
      menu.classList.add('hidden');
      menu.classList.remove('flex');
      icon.style.transform = 'rotate(0deg)';
    }
  }

  function selectStatus(value, name) {
    document.getElementById('hiddenStatusInput').value = value;
    document.getElementById('statusSelectedText').innerText = name;
    toggleStatusDropdown();
  }

  document.addEventListener('click', function(event) {
    const catDropdown = document.getElementById('customCategoryDropdown');
    const catMenu = document.getElementById('categoryMenu');
    const catIcon = document.getElementById('categoryIcon');

    if (catDropdown && !catDropdown.contains(event.target)) {
      catMenu.classList.add('hidden');
      catMenu.classList.remove('flex');
      catIcon.style.transform = 'rotate(0deg)';
    }

    const statDropdown = document.getElementById('customStatusDropdown');
    const statMenu = document.getElementById('statusMenu');
    const statIcon = document.getElementById('statusIcon');

    if (statDropdown && !statDropdown.contains(event.target)) {
      statMenu.classList.add('hidden');
      statMenu.classList.remove('flex');
      statIcon.style.transform = 'rotate(0deg)';
    }
  });

  function appendSpecRow() {
    const container = document.getElementById('specsContainer');
    const row = document.createElement('div');
    row.className = 'flex gap-2 spec-row';

    row.innerHTML = `
      <input type="text" name="spec_name[]" placeholder="NAMA SPESIFIKASI" class="w-1/2 p-3 bg-[#F8F9FA] border-2 border-black font-bold text-xs uppercase focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
      <input type="text" name="spec_value[]" placeholder="NILAI" class="w-1/2 p-3 bg-[#F8F9FA] border-2 border-black font-bold text-xs focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
      <button type="button" onclick="removeSpecRow(this)" class="bg-[#FF5757] text-white px-3 border-2 border-black font-black hover:bg-black transition-colors">X</button>
    `;
    container.appendChild(row);
  }

  function removeSpecRow(button) {
    const row = button.parentElement;
    if (document.querySelectorAll('.spec-row').length > 1) {
      row.remove();
    } else {
      row.querySelector('input[name="spec_name[]"]').value = "";
      row.querySelector('input[name="spec_value[]"]').value = "";
    }
  }
</script>