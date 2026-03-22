<div class="mb-6" data-aos="fade-in">
  <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <div>
      <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black">ARTICLES MANAGEMENT</h1>
      <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
        Kelola artikel/blog dan informasi terkini
      </p>
    </div>

    <div class="flex gap-4">
      <button onclick="resetFilter()" class="bg-white text-black px-6 py-3 border-4 border-black font-black text-xs uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"></path>
        </svg>
        RESET
      </button>
      <button onclick="openModal('addArticleModal')" class="bg-[#2563EB] text-white px-6 py-3 border-4 border-black font-black text-xs uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all flex items-center">
        + NEW ARTICLE
      </button>
    </div>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">
  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative overflow-hidden">
    <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-500 mb-4">TOTAL ARTICLE</h3>
    <div class="text-6xl font-black tracking-tighter text-black"><?= str_pad((string)$data['stats']['total_articles'], 2, '0', STR_PAD_LEFT) ?></div>
    <svg class="absolute -right-4 -bottom-4 w-32 h-32 text-gray-100 opacity-50" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
    </svg>
  </div>

  <div class="bg-[#A6FAAE] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative overflow-hidden">
    <h3 class="text-[10px] font-black uppercase tracking-widest text-black mb-4">PUBLISHED ARTICLE</h3>
    <div class="text-6xl font-black tracking-tighter text-black"><?= str_pad((string)$data['stats']['published_live'], 2, '0', STR_PAD_LEFT) ?></div>
    <svg class="absolute -right-4 -bottom-4 w-32 h-32 text-black opacity-10" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
    </svg>
  </div>

  <div class="bg-[#FFE600] border-4 border-black shadow-[8px_8px_0_0_#000] p-6 relative overflow-hidden">
    <h3 class="text-[10px] font-black uppercase tracking-widest text-black mb-4">DRAFT ARTICLE</h3>
    <div class="text-6xl font-black tracking-tighter text-black"><?= str_pad((string)$data['stats']['draft_pending'], 2, '0', STR_PAD_LEFT) ?></div>
    <svg class="absolute -right-4 -bottom-4 w-32 h-32 text-black opacity-10" fill="currentColor" viewBox="0 0 20 20">
      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
    </svg>
  </div>
</div>

<div class="flex flex-col md:flex-row gap-4 mb-6 relative z-20" data-aos="fade-up" data-aos-delay="100">

  <div class="w-full md:w-64 relative" id="filterStatusDropdown">
    <input type="hidden" id="statusFilter" value="ALL">
    <button type="button" onclick="toggleFilterStatus()" class="w-full py-4 px-4 bg-white border-4 border-black font-black text-xs uppercase flex justify-between items-center shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] focus:outline-none transition-all cursor-pointer">
      <span id="filterStatusText" class="truncate">STATUS ALL</span>
      <svg class="w-4 h-4 text-black transition-transform shrink-0 ml-2" id="filterStatusIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>

    <div id="filterStatusMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col text-left">
      <div onclick="selectFilterStatus('ALL', 'STATUS ALL')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">STATUS ALL</div>
      <div onclick="selectFilterStatus('PUBLISHED', 'PUBLISHED')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">PUBLISHED</div>
      <div onclick="selectFilterStatus('DRAFT', 'DRAFT')" class="p-3 font-black text-xs uppercase hover:bg-[#FFE600] cursor-pointer">DRAFT</div>
    </div>
  </div>

  <div class="flex-1 bg-white border-4 border-black flex items-center px-4 shadow-[4px_4px_0_0_#000] focus-within:-translate-y-1 focus-within:shadow-[6px_6px_0_0_#000] transition-all">
    <svg class="w-5 h-5 text-black mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
    </svg>
    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="SEARCH ARTICLE TITLE OR AUTHOR..." class="w-full py-4 bg-transparent font-black text-xs uppercase outline-none placeholder-gray-400">
  </div>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-2 relative z-10" data-aos="fade-up" data-aos-delay="200">
  <table class="w-full text-left border-collapse min-w-[1000px]">
    <thead>
      <tr class="bg-black text-white text-[10px] font-black uppercase tracking-widest border-b-4 border-black">
        <th class="p-5 border-r-2 border-black w-24 text-center">MEDIA</th>
        <th class="p-5 border-r-2 border-black">ARTICLE TITLE</th>
        <th class="p-5 border-r-2 border-black">AUTHOR</th>
        <th class="p-5 border-r-2 border-black">DATE PUBLISHED</th>
        <th class="p-5 border-r-2 border-black text-center">STATUS</th>
        <th class="p-5 text-center w-32">OPS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black" id="tableBody">

      <?php if (empty($data['articles'])) : ?>
        <tr class="border-b-4 border-black bg-gray-50">
          <td colspan="6" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">NO ARTICLES FOUND IN DATABASE.</td>
        </tr>
      <?php else : ?>
        <?php foreach ($data['articles'] as $art):
          $img_src = !empty($art['image_url']) ? (str_starts_with($art['image_url'], 'http') ? $art['image_url'] : BASEURL . '/img/articles/' . $art['image_url']) : '';

          $isPublished = $art['status'] === 'published';
          $statusColor = $isPublished ? 'bg-[#A6FAAE]' : 'bg-[#F8F9FA]';
          $statusText = $isPublished ? 'PUBLISHED' : 'DRAFT';

          $authorSlug = '@' . strtoupper(str_replace(' ', '_', $art['author_name']));
        ?>
          <tr class="border-b-2 border-black hover:bg-[#F8F9FA] transition-colors article-row">

            <td class="p-4 border-r-2 border-black flex justify-center">
              <div class="w-14 h-10 border-2 border-black bg-gray-200 flex items-center justify-center shadow-[2px_2px_0_0_#000] overflow-hidden">
                <?php if ($img_src): ?>
                  <img src="<?= $img_src ?>" class="w-full h-full object-cover grayscale-[30%]">
                <?php else: ?>
                  <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                <?php endif; ?>
              </div>
            </td>

            <td class="p-4 border-r-2 border-black">
              <span class="font-black text-sm block uppercase leading-tight article-title-text"><?= htmlspecialchars($art['title']) ?>.EXE</span>
              <span class="text-[9px] font-bold text-gray-500 uppercase tracking-widest block mt-1 truncate max-w-[250px]"><?= htmlspecialchars($art['excerpt']) ?></span>
            </td>

            <td class="p-4 border-r-2 border-black article-author-text">
              <span class="font-mono text-xs font-black text-black"><?= $authorSlug ?></span>
            </td>

            <td class="p-4 border-r-2 border-black">
              <span class="font-mono text-[10px] text-gray-600 tracking-widest">
                <?= date('Y-m-d // H:i', strtotime($art['created_at'])) ?>
              </span>
            </td>

            <td class="p-4 border-r-2 border-black text-center article-status-text">
              <span class="inline-block border-2 border-black px-2 py-1 <?= $statusColor ?> text-black text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000]">
                <?= $statusText ?>
              </span>
            </td>

            <td class="p-4">
              <div class="flex items-center justify-center space-x-2">
                <button data-art='<?= htmlspecialchars(json_encode($art, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG), ENT_QUOTES, 'UTF-8') ?>' onclick="openEditModal(this)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FFE600] shadow-[2px_2px_0_0_#000] transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                  </svg>
                </button>
                <button onclick="deleteArticle(<?= $art['id']; ?>)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FF5757] hover:text-white shadow-[2px_2px_0_0_#000] transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                </button>
              </div>
            </td>

          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

      <tr id="noResultRow" class="border-b-4 border-black bg-gray-50 hidden">
        <td colspan="6" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">SYSTEM ERROR: DATA_NOT_FOUND.</td>
      </tr>
    </tbody>
  </table>
</div>

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4" id="paginationWrapper">
  <div class="text-[10px] font-black text-gray-500 uppercase tracking-widest" id="paginationInfo">PAGE_000_OF_000</div>
  <div class="flex items-center gap-2 text-black" id="paginationControls"></div>
</div>

<div id="addArticleModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity overflow-y-auto pt-20 pb-10">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-4xl relative my-auto">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#2563EB] text-white">
      <h2 class="text-2xl font-black uppercase tracking-widest">NEW_POST.EXE</h2>
      <button onclick="closeModal('addArticleModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form id="addForm" action="<?= BASEURL; ?>/adminarticle/store" method="POST" enctype="multipart/form-data" class="space-y-5">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">ARTICLE_TITLE</label>
            <input type="text" name="title" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">STATUS</label>
            <div class="relative" id="addStatusDropdown">
              <input type="hidden" name="status" id="add_hiddenStatus" value="published">
              <button type="button" onclick="toggleAddStatus()" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all cursor-pointer">
                <span id="addStatusText" class="text-black">PUBLISHED</span>
                <svg class="w-4 h-4 text-black transition-transform shrink-0" id="addStatusIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <div id="addStatusMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col">
                <div onclick="selectAddStatus('published', 'PUBLISHED')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">PUBLISHED</div>
                <div onclick="selectAddStatus('draft', 'DRAFT')" class="p-4 font-black uppercase hover:bg-[#FFE600] cursor-pointer">DRAFT</div>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">EXCERPT (SHORT DESCRIPTION)</label>
          <textarea name="excerpt" rows="2" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all resize-none"></textarea>
        </div>

        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">FULL_CONTENT (HTML SUPPORTED)</label>
          <textarea name="content" rows="8" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all resize-y"></textarea>
        </div>

        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">COVER_MEDIA (OPTIONAL)</label>
          <input type="file" name="image" accept="image/*" class="w-full p-3 bg-[#F8F9FA] border-4 border-dashed border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all cursor-pointer">
        </div>

        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('addArticleModal')" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">ABORT</button>
          <button type="submit" class="flex-1 bg-[#2563EB] text-white py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">EXECUTE_DEPLOY</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="editArticleModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity overflow-y-auto pt-20 pb-10">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-4xl relative my-auto">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#FFE600] text-black">
      <h2 class="text-2xl font-black uppercase tracking-widest">EDIT_ARTICLE.SYS</h2>
      <button onclick="closeModal('editArticleModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form id="editForm" action="<?= BASEURL; ?>/adminarticle/update" method="POST" enctype="multipart/form-data" class="space-y-5">
        <input type="hidden" name="id" id="edit_id">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">ARTICLE_TITLE</label>
            <input type="text" name="title" id="edit_title" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>

          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">STATUS</label>
            <div class="relative" id="editStatusDropdown">
              <input type="hidden" name="status" id="edit_hiddenStatus">
              <button type="button" onclick="toggleEditStatus()" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all cursor-pointer">
                <span id="editStatusText" class="text-black">PUBLISHED</span>
                <svg class="w-4 h-4 text-black transition-transform shrink-0" id="editStatusIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
              <div id="editStatusMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col">
                <div onclick="selectEditStatus('published', 'PUBLISHED')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">PUBLISHED</div>
                <div onclick="selectEditStatus('draft', 'DRAFT')" class="p-4 font-black uppercase hover:bg-[#FFE600] cursor-pointer">DRAFT</div>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">EXCERPT (SHORT DESCRIPTION)</label>
          <textarea name="excerpt" id="edit_excerpt" rows="2" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all resize-none"></textarea>
        </div>

        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">FULL_CONTENT (HTML SUPPORTED)</label>
          <textarea name="content" id="edit_content" rows="8" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all resize-y"></textarea>
        </div>

        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">UPDATE_MEDIA (OPTIONAL)</label>
          <input type="file" name="image" accept="image/*" class="w-full p-3 bg-[#F8F9FA] border-4 border-dashed border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] transition-all cursor-pointer">
        </div>

        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('editArticleModal')" class="flex-1 bg-white text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">ABORT</button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black py-4 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">UPDATE_DATA</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="confirmDeleteModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <div class="w-16 h-16 bg-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
      <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
      </svg>
    </div>
    <h2 class="text-2xl font-black uppercase text-white mb-2">WARNING!</h2>
    <p class="text-sm font-bold text-white mb-6">Hapus artikel transmisi ini secara permanen dari server?</p>
    <div class="flex gap-4">
      <button onclick="closeModal('confirmDeleteModal')" class="flex-1 bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">BATAL</button>
      <button onclick="executeDeleteArticle()" class="flex-1 bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">DELETE</button>
    </div>
  </div>
</div>

<div id="successModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#A6FAAE] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <h2 class="text-2xl font-black uppercase text-black mb-2">SUCCESS!</h2>
    <p id="successMessage" class="text-sm font-bold text-black mb-6">Operasi berhasil dilakukan.</p>
    <button onclick="reloadPage()" class="w-full bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">OK</button>
  </div>
</div>

<div id="errorModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <h2 class="text-2xl font-black uppercase text-white mb-2">ERROR!</h2>
    <p id="errorMessage" class="text-sm font-bold text-white mb-6">Terjadi kesalahan.</p>
    <button onclick="closeModal('errorModal')" class="w-full bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">TUTUP</button>
  </div>
</div>

<script>
  const HAS_REAL_DATA = <?= empty($data['articles']) ? 'false' : 'true'; ?>;
  const BASEURL = '<?= BASEURL; ?>';
</script>
<script src="<?= BASEURL; ?>/js/admin_articles.js?v=<?= time(); ?>"></script>