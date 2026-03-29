<div class="mb-8" data-aos="fade-in">
  <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black">USER MANAGEMENT</h1>
  </div>
  <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed mt-2">
    Atur dan pantau semua users terdaftar di platform. Kelola hak akses, status akun, dan peran staf.
  </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8" data-aos="fade-up">
  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6">
    <h3 class="text-[10px] font-black uppercase tracking-widest text-black mb-4">TOTAL USERS</h3>
    <div class="flex items-baseline gap-3">
      <div class="text-5xl font-black tracking-tighter"><?= $data['stats']['total_users'] ?? 0 ?></div>
    </div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6">
    <h3 class="text-[10px] font-black uppercase tracking-widest text-black mb-4">ACTIVE STAFF</h3>
    <div class="flex items-baseline gap-3">
      <div class="text-5xl font-black tracking-tighter"><?= $data['stats']['active_staff'] ?? 0 ?></div>
    </div>
  </div>

  <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6">
    <h3 class="text-[10px] font-black uppercase tracking-widest text-black mb-4">NEW USERS THIS MONTH</h3>
    <div class="flex items-baseline gap-3">
      <div class="text-5xl font-black tracking-tighter text-[#2563EB]"><?= $data['stats']['new_users'] ?? 0 ?></div>
      <span class="text-black font-black text-sm tracking-widest">USERS</span>
    </div>
  </div>
</div>

<div class="flex flex-col xl:flex-row justify-between items-start gap-6 mb-6 relative z-20" data-aos="fade-up" data-aos-delay="100">
  <div class="w-full xl:flex-1 flex flex-col md:flex-row gap-4">
    <div class="w-full md:flex-1 bg-white border-4 border-black flex items-center px-4 shadow-[4px_4px_0_0_#000] focus-within:-translate-y-1 focus-within:shadow-[6px_6px_0_0_#000] transition-all">
      <svg class="w-5 h-5 text-black mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
      <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="SEARCH USER NAME" class="w-full py-3 bg-transparent font-black text-xs uppercase outline-none placeholder-gray-400">
    </div>

    <div class="w-full md:w-64 relative" id="filterRoleDropdown">
      <input type="hidden" id="roleFilter" value="ALL">
      <button type="button" onclick="toggleFilterRole()" class="w-full py-3 px-4 bg-white border-4 border-black font-black text-xs uppercase flex justify-between items-center shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] focus:outline-none transition-all cursor-pointer">
        <span id="filterRoleText" class="truncate">ALL ROLES</span>
        <svg class="w-4 h-4 text-black transition-transform shrink-0 ml-2" id="filterRoleIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>

      <div id="filterRoleMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col max-h-60 overflow-y-auto text-left">
        <div onclick="selectFilterRole('ALL', 'ALL ROLES')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">ALL ROLES</div>
        <div onclick="selectFilterRole('PEMBELI', 'PEMBELI')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">PEMBELI</div>
        <div onclick="selectFilterRole('ADMIN TOKO', 'ADMIN TOKO')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">ADMIN TOKO</div>
        <div onclick="selectFilterRole('GUDANG', 'GUDANG')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">GUDANG</div>
        <div onclick="selectFilterRole('EKSPEDISI', 'EKSPEDISI')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">EKSPEDISI</div>
        <div onclick="selectFilterRole('ADMIN WEB', 'ADMIN WEB')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">ADMIN WEB</div>
        <div onclick="selectFilterRole('PEMILIK', 'PEMILIK')" class="p-3 font-black text-xs uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer transition-colors text-black">PEMILIK</div>
      </div>
    </div>

    <button onclick="resetFilter()" class="w-full md:w-auto bg-white text-black px-6 py-3 border-4 border-black font-black text-xs uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:bg-[#FF5757] hover:text-white hover:shadow-[6px_6px_0_0_#000] transition-all flex items-center justify-center shrink-0">
      RESET
    </button>
  </div>

  <button onclick="openModal('addStaffModal')" class="w-full xl:w-auto bg-[#2563EB] text-white px-8 py-3 border-4 border-black font-black text-sm uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all flex items-center justify-center shrink-0">
    + ADD USER
  </button>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-6 relative z-10" data-aos="fade-up" data-aos-delay="200">
  <table class="w-full text-left border-collapse min-w-[1000px]">
    <thead>
      <tr class="bg-black text-white text-[10px] font-black uppercase tracking-widest">
        <th class="p-4 border-r-2 border-black w-24 text-center">AVATAR</th>
        <th class="p-4 border-r-2 border-black">USER_IDENTIFIER</th>
        <th class="p-4 border-r-2 border-black">ROLE</th>
        <th class="p-4 border-r-2 border-black">CREATED / EMAIL</th>
        <th class="p-4 border-r-2 border-black text-center">STATUS</th>
        <th class="p-4 text-center w-32">OPS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black bg-white" id="tableBody">

      <?php if (empty($data['users'])) : ?>
        <tr class="border-b-4 border-black bg-gray-50">
          <td colspan="6" class="p-16 text-center text-gray-500 font-black uppercase tracking-widest">
            NO USERS REGISTERED IN DATABASE.
          </td>
        </tr>
      <?php else : ?>
        <?php foreach ($data['users'] as $user):
          $avatarColors = ['bg-[#FF90E8]', 'bg-[#A6FAAE]', 'bg-[#B28DFF]', 'bg-[#90E0FF]', 'bg-[#FFE600]'];
          $randomColor = $avatarColors[$user['id'] % count($avatarColors)];
          $uid = 'UID: ' . rand(1000, 9999) . '-' . str_pad((string)$user['id'], 4, '0', STR_PAD_LEFT);

          $roleText = strtoupper(str_replace('_', ' ', $user['role']));
          $roleBadge = 'border-black text-black bg-white';
          if (in_array($user['role'], ['admin_web', 'pemilik'])) $roleBadge = 'border-black text-white bg-black';
          elseif (in_array($user['role'], ['admin_toko', 'gudang', 'ekspedisi'])) $roleBadge = 'border-black text-white bg-[#2563EB]';
        ?>
          <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors user-row">

            <td class="p-4 border-r-2 border-black flex justify-center">
              <div class="w-12 h-12 border-2 border-black flex items-center justify-center <?= $randomColor ?> shadow-[2px_2px_0_0_#000]">
                <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
            </td>

            <td class="p-4 border-r-2 border-black">
              <span class="font-black text-[#2563EB] text-sm block uppercase leading-tight line-clamp-1 user-name-text"><?= htmlspecialchars($user['name']) ?></span>
              <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest block mt-0.5"><?= $uid ?></span>
            </td>

            <td class="p-4 border-r-2 border-black user-role-text text-xs">
              <span class="inline-block border-2 px-2 py-0.5 text-[9px] font-black uppercase tracking-widest <?= $roleBadge ?>">
                <?= $roleText ?>
              </span>
            </td>

            <td class="p-4 border-r-2 border-black">
              <span class="font-black text-sm block uppercase leading-tight"><?= date('Y.m.d_H:i', strtotime($user['created_at'] ?? 'now')) ?></span>
              <span class="text-[9px] font-black text-gray-500 tracking-widest block mt-0.5 truncate max-w-[200px]" title="<?= htmlspecialchars($user['email']) ?>">IP: <?= htmlspecialchars($user['email']) ?></span>
            </td>

            <td class="p-4 border-r-2 border-black text-center">
              <span class="inline-block border-2 border-black px-2 py-1 text-[9px] font-black uppercase tracking-widest shadow-[2px_2px_0_0_#000] bg-[#A6FAAE] text-black">
                ACTIVE
              </span>
            </td>

            <td class="p-4 flex items-center justify-center space-x-2 h-full pt-5">
              <div class="flex items-center justify-center space-x-2">
                <button data-user='<?= htmlspecialchars(json_encode($user, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_TAG), ENT_QUOTES, 'UTF-8') ?>' onclick="openEditModal(this)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FFE600] hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="EDIT">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                  </svg>
                </button>

                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                  <button onclick="deleteUser(<?= $user['id']; ?>)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FF5757] hover:text-white hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="DELETE">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                  </button>
                <?php else: ?>
                  <button class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-400 border-2 border-gray-400 cursor-not-allowed shadow-[2px_2px_0_0_gray]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                  </button>
                <?php endif; ?>
              </div>
            </td>

          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

      <tr id="noResultRow" class="border-b-4 border-black bg-gray-50 hidden">
        <td colspan="6" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">
          USER NOT FOUND.
        </td>
      </tr>

    </tbody>
  </table>
</div>

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4" id="paginationWrapper">
  <div class="text-xs font-black text-gray-500 uppercase tracking-widest" id="paginationInfo">SHOWING 0 OF 0 ENTRIES</div>
  <div class="flex items-center gap-2" id="paginationControls"></div>
</div>

<div id="addStaffModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity overflow-y-auto pt-20 pb-10">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-3xl relative my-auto">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#2563EB] text-white">
      <div>
        <h2 class="text-2xl font-black uppercase tracking-widest">ADD USER</h2>
      </div>
      <button onclick="closeModal('addStaffModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form id="addForm" action="<?= BASEURL; ?>/adminuser/storeUser" method="POST" class="space-y-5">
        <input type="hidden" name="address" value="-">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">USERNAME</label>
            <input type="text" name="name" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
          </div>
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">EMAIL ADDRESS</label>
            <input type="email" name="email" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">PASSWORD</label>
            <input type="password" name="password" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
          </div>
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">PHONE NUMBER</label>
            <input type="text" name="phone" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
          </div>
        </div>

        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">ROLE</label>
          <div class="relative" id="addCustomRoleDropdown">
            <input type="hidden" name="role" id="add_hiddenRoleInput" required>
            <button type="button" onclick="toggleAddRole()" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all cursor-pointer text-left">
              <span id="addRoleSelectedText" class="text-gray-400">-- SELECT ROLE --</span>
              <svg class="w-4 h-4 text-black transition-transform shrink-0" id="addRoleIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div id="addRoleMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col max-h-40 overflow-y-auto">
              <div onclick="selectAddRole('pembeli', 'PEMBELI')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">PEMBELI</div>
              <div onclick="selectAddRole('admin_toko', 'ADMIN TOKO')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">ADMIN TOKO</div>
              <div onclick="selectAddRole('gudang', 'GUDANG')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">GUDANG</div>
              <div onclick="selectAddRole('ekspedisi', 'EKSPEDISI')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">EKSPEDISI</div>
              <div onclick="selectAddRole('admin_web', 'ADMIN WEB')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">ADMIN WEB</div>
              <div onclick="selectAddRole('pemilik', 'PEMILIK')" class="p-4 font-black uppercase hover:bg-[#FFE600] cursor-pointer">PEMILIK</div>
            </div>
          </div>
        </div>

        <div class="space-y-2 mt-5">
          <label class="text-[10px] font-black uppercase tracking-widest">PENEMPATAN LOKASI</label>
          <div class="relative">
            <select name="location_id" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-black text-xs uppercase focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all appearance-none cursor-pointer">
              <option value="">-- TANPA LOKASI (WEB / PEMILIK / PEMBELI) --</option>
              <?php foreach ($data['locations'] as $loc): ?>
                <option value="<?= $loc['id'] ?>">[<?= strtoupper($loc['type']) ?>] - <?= strtoupper($loc['name']) ?></option>
              <?php endforeach; ?>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
          <p class="text-[8px] font-bold text-gray-500">*Wajib dipilih untuk peran Admin Toko atau Gudang</p>
        </div>

        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('addStaffModal')" class="flex-1 bg-white border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all py-4">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#2563EB] text-white border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all py-4">ADD</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="editStaffModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity overflow-y-auto pt-20 pb-10">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-3xl relative my-auto">
    <div class="flex justify-between items-center p-6 border-b-4 border-black bg-[#FFE600] text-black">
      <div>
        <h2 class="text-2xl font-black uppercase tracking-widest">EDIT USER</h2>
      </div>
      <button onclick="closeModal('editStaffModal')" type="button" class="bg-white text-black border-4 border-black w-10 h-10 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white shadow-[4px_4px_0_0_#000] transition-all">X</button>
    </div>

    <div class="p-8">
      <form id="editForm" action="<?= BASEURL; ?>/adminuser/updateUser" method="POST" class="space-y-5">
        <input type="hidden" name="id" id="edit_id">
        <input type="hidden" name="address" id="edit_address">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">USERNAME</label>
            <input type="text" name="name" id="edit_name" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
          </div>
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">EMAIL ADDRESS</label>
            <input type="email" name="email" id="edit_email" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">NEW PASSWORD</label>
            <input type="password" name="password" placeholder="Biarkan kosong jika tidak diubah" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
          </div>
          <div class="space-y-2">
            <label class="text-[10px] font-black uppercase tracking-widest">PHONE NUMBER</label>
            <input type="text" name="phone" id="edit_phone" required class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all">
          </div>
        </div>

        <div class="space-y-2">
          <label class="text-[10px] font-black uppercase tracking-widest">ROLE</label>
          <div class="relative" id="editCustomRoleDropdown">
            <input type="hidden" name="role" id="edit_hiddenRoleInput" required>
            <button type="button" onclick="toggleEditRole()" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-bold uppercase flex justify-between items-center focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all cursor-pointer text-left">
              <span id="editRoleSelectedText" class="text-black">-- SELECT ROLE --</span>
              <svg class="w-4 h-4 text-black transition-transform shrink-0" id="editRoleIcon" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>
            <div id="editRoleMenu" class="absolute z-50 w-full mt-2 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] hidden flex-col max-h-40 overflow-y-auto">
              <div onclick="selectEditRole('pembeli', 'PEMBELI')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">PEMBELI</div>
              <div onclick="selectEditRole('admin_toko', 'ADMIN TOKO')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">ADMIN TOKO</div>
              <div onclick="selectEditRole('gudang', 'GUDANG')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">GUDANG</div>
              <div onclick="selectEditRole('ekspedisi', 'EKSPEDISI')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">EKSPEDISI</div>
              <div onclick="selectEditRole('admin_web', 'ADMIN WEB')" class="p-4 font-black uppercase border-b-2 border-black hover:bg-[#FFE600] cursor-pointer">ADMIN WEB</div>
              <div onclick="selectEditRole('pemilik', 'PEMILIK')" class="p-4 font-black uppercase hover:bg-[#FFE600] cursor-pointer">PEMILIK</div>
            </div>
          </div>
        </div>

        <div class="space-y-2 mt-5">
          <label class="text-[10px] font-black uppercase tracking-widest">PENEMPATAN LOKASI</label>
          <div class="relative">
            <select name="location_id" id="edit_location_id" class="w-full p-4 bg-[#F8F9FA] border-4 border-black font-black text-xs uppercase focus:outline-none focus:bg-white focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all appearance-none cursor-pointer">
              <option value="">-- TANPA LOKASI (WEB / PEMILIK / PEMBELI) --</option>
              <?php foreach ($data['locations'] as $loc): ?>
                <option value="<?= $loc['id'] ?>">[<?= strtoupper($loc['type']) ?>] - <?= strtoupper($loc['name']) ?></option>
              <?php endforeach; ?>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
          <p class="text-[8px] font-bold text-gray-500">*Wajib dipilih untuk peran Admin Toko atau Gudang</p>
        </div>

        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('editStaffModal')" class="flex-1 bg-white border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all py-4">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all py-4">UPDATE</button>
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
    <p class="text-sm font-bold text-white mb-6">Yakin ingin menghapus user ini?</p>
    <div class="flex gap-4">
      <button onclick="closeModal('confirmDeleteModal')" class="flex-1 bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">BATAL</button>
      <button onclick="executeDeleteUser()" class="flex-1 bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">HAPUS</button>
    </div>
  </div>
</div>

<div id="successModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#A6FAAE] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <div class="w-16 h-16 bg-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
      <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
      </svg>
    </div>
    <h2 class="text-2xl font-black uppercase text-black mb-2">SUCCESS!</h2>
    <p id="successMessage" class="text-sm font-bold text-black mb-6">Operasi berhasil dilakukan.</p>
    <button onclick="reloadPage()" class="w-full bg-white text-black py-3 border-4 border-black font-black uppercase shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-all">OK, LANJUTKAN</button>
  </div>
</div>

<div id="errorModal" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-[#FF5757] border-4 border-black shadow-[8px_8px_0_0_#000] w-full max-w-sm relative text-center p-8">
    <div class="w-16 h-16 bg-white border-4 border-black rounded-full flex items-center justify-center mx-auto mb-4 shadow-[4px_4px_0_0_#000]">
      <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </div>
    <h2 class="text-2xl font-black uppercase text-white mb-2">ERROR!</h2>
    <p id="errorMessage" class="text-sm font-bold text-white mb-6">Terjadi kesalahan.</p>
    <button onclick="closeModal('errorModal')" class="w-full bg-black text-white py-3 border-4 border-white font-black uppercase shadow-[4px_4px_0_0_#fff] hover:-translate-y-1 transition-all">TUTUP</button>
  </div>
</div>

<script>
  const HAS_REAL_DATA = <?= empty($data['users']) ? 'false' : 'true'; ?>;
  const BASEURL = '<?= BASEURL; ?>';
</script>
<script src="<?= BASEURL; ?>/js/admin_users.js?v=<?= time(); ?>"></script>