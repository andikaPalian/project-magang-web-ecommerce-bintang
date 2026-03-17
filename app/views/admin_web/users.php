<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end pb-4 gap-4" data-aos="fade-in">
  <div>
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black mb-2">USER MANAGEMENT</h1>
    <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed">
      Atur dan pantau semua users terdaftar di platform. Kelola hak akses, status akun, dan peran staf.
    </p>
  </div>

  <button onclick="openModal('addStaffModal')" class="bg-[#2563EB] text-white px-6 py-3 border-4 border-black font-black text-sm uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] active:translate-y-0 active:shadow-none transition-all flex items-center shrink-0">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
      <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
    </svg>
    ADD NEW STAFF
  </button>
</div>

<div class="flex flex-wrap gap-4 mb-6" data-aos="fade-up">
  <div class="relative inline-block">
    <select id="roleFilter" onchange="filterTable()" class="appearance-none bg-black text-white px-4 py-3 pr-10 border-4 border-black font-black text-xs uppercase shadow-[4px_4px_0_0_#000] hover:bg-gray-800 cursor-pointer outline-none transition-all">
      <option value="ALL">ALL ROLES</option>
      <option value="PEMBELI">PEMBELI / BUYER</option>
      <option value="ADMIN TOKO">ADMIN TOKO</option>
      <option value="GUDANG">GUDANG</option>
      <option value="EKSPEDISI">EKSPEDISI</option>
      <option value="ADMIN WEB">ADMIN WEB</option>
      <option value="PEMILIK">PEMILIK</option>
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-white">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
      </svg>
    </div>
  </div>

  <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="SEARCH NAME OR EMAIL..." class="bg-white text-black px-4 py-3 border-4 border-black font-black text-xs uppercase shadow-[4px_4px_0_0_#000] focus:outline-none focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 transition-all w-72">

  <div class="flex-1"></div>

  <button onclick="resetFilter()" class="bg-white text-black px-6 py-3 border-4 border-black font-black text-xs flex items-center shadow-[4px_4px_0_0_#000] hover:bg-[#FF5757] hover:text-white transition-all">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
    </svg>
    RESET
  </button>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-6" data-aos="fade-up" data-aos-delay="100">
  <table class="w-full text-left border-collapse min-w-[900px]">
    <thead>
      <tr class="bg-black text-white text-[10px] font-black uppercase tracking-widest">
        <th class="p-5 border-r-2 border-black">USER DETAILS</th>
        <th class="p-5 border-r-2 border-black">EMAIL ADDRESS</th>
        <th class="p-5 border-r-2 border-black">SYSTEM ROLE</th>
        <th class="p-5 border-r-2 border-black">STATUS</th>
        <th class="p-5 text-center">ACTIONS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black bg-white" id="tableBody">

      <?php if (empty($data['users'])) : ?>
        <tr class="border-b-4 border-black bg-gray-50">
          <td colspan="5" class="p-16 text-center text-gray-500 font-black uppercase tracking-widest">
            <div class="flex flex-col items-center justify-center">
              <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
              </svg>
              BELUM ADA DATA USER TERDAFTAR.
            </div>
          </td>
        </tr>
      <?php else : ?>

        <?php foreach ($data['users'] as $user):
          $avatarColors = ['bg-[#FF90E8]', 'bg-[#A6FAAE]', 'bg-[#B28DFF]', 'bg-[#90E0FF]', 'bg-[#FFE600]'];
          $randomColor = $avatarColors[$user['id'] % count($avatarColors)];

          $uid = 'USR-' . str_pad((string)$user['id'], 4, '0', STR_PAD_LEFT);

          $roleText = str_replace('_', ' ', $user['role']);
          $roleBadge = 'border-gray-400 text-gray-600 bg-white';
          if ($user['role'] == 'admin_toko' || $user['role'] == 'admin_web') $roleBadge = 'border-[#2563EB] text-[#2563EB] bg-white';
          if ($user['role'] == 'gudang') $roleBadge = 'border-[#F97316] text-[#F97316] bg-white';
          if ($user['role'] == 'ekspedisi') $roleBadge = 'border-[#EAB308] text-[#EAB308] bg-white';
          if ($user['role'] == 'pemilik') $roleBadge = 'border-[#8B5CF6] text-[#8B5CF6] bg-white';
        ?>
          <tr class="border-b-2 border-black hover:bg-gray-50 transition-colors user-row">

            <td class="p-4 border-r-2 border-black">
              <div class="flex items-center">
                <div class="w-10 h-10 border-2 border-black mr-4 <?= $randomColor ?> shadow-[3px_3px_0_0_#000] shrink-0"></div>
                <div>
                  <span class="font-black text-sm block leading-tight"><?= htmlspecialchars($user['name']) ?></span>
                  <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest block mt-0.5">UID: <?= $uid ?></span>
                </div>
              </div>
            </td>

            <td class="p-4 border-r-2 border-black font-bold text-[#334155]">
              <?= htmlspecialchars($user['email']) ?>
            </td>

            <td class="p-4 border-r-2 border-black">
              <span class="border-2 px-3 py-1.5 text-[9px] font-black uppercase tracking-widest <?= $roleBadge ?>">
                <?= $roleText ?>
              </span>
            </td>

            <td class="p-4 border-r-2 border-black">
              <span class="text-[#00C853] font-black text-xs flex items-center uppercase tracking-widest">
                <span class="w-2.5 h-2.5 rounded-full bg-[#00C853] border border-black mr-2 shadow-[1px_1px_0_0_#000]"></span> ACTIVE
              </span>
            </td>

            <td class="p-4 flex items-center justify-center space-x-3">
              <button onclick="openEditModal(<?= htmlspecialchars(json_encode($user)) ?>)" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="EDIT STAFF">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
              </button>

              <?php if (isset($_SESSION['user_id']) && $user['id'] != $_SESSION['user_id']): ?>
                <a href="<?= BASEURL; ?>/adminuser/deleteUser/<?= $user['id'] ?>" onclick="return confirm('Hapus staf ini?');" class="w-8 h-8 flex items-center justify-center bg-white text-black border-2 border-black hover:-translate-y-0.5 hover:bg-[#FF5757] hover:text-white hover:shadow-[4px_4px_0_0_#000] shadow-[2px_2px_0_0_#000] active:translate-y-0 active:shadow-none transition-all" title="BLOCK / DELETE">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                  </svg>
                </a>
              <?php else: ?>
                <button class="w-8 h-8 flex items-center justify-center bg-gray-200 text-gray-400 border-2 border-gray-400 cursor-not-allowed shadow-[2px_2px_0_0_gray]" title="TIDAK BISA MENGHAPUS DIRI SENDIRI">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                  </svg>
                </button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>

      <tr id="noResultRow" class="border-b-4 border-black bg-gray-50 hidden">
        <td colspan="5" class="p-16 text-center text-[#FF5757] font-black uppercase tracking-widest">
          <div class="flex flex-col items-center justify-center">
            <svg class="w-16 h-16 mb-4 text-[#FF5757]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            USER TIDAK DITEMUKAN.
          </div>
        </td>
      </tr>

    </tbody>
  </table>
</div>

<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4" id="paginationWrapper" data-aos="fade-up" data-aos-delay="200">
  <div class="text-xs font-black text-gray-500 uppercase tracking-widest" id="paginationInfo">
    SHOWING 0 OF 0 REGISTERED USERS
  </div>
  <div class="flex items-center gap-2" id="paginationControls">
  </div>
</div>

<div id="addStaffModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-2xl relative" data-aos="zoom-in" data-aos-duration="300">

    <button onclick="closeModal('addStaffModal')" class="absolute top-4 right-4 bg-white border-4 border-black w-8 h-8 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white transition-colors">
      X
    </button>

    <div class="p-8">
      <h2 class="text-3xl font-black uppercase mb-1">ADD NEW USER</h2>
      <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-6">EMPLOYEE REGISTRATION FORM</p>

      <form action="<?= BASEURL; ?>/adminuser/storeUser" method="POST" class="space-y-5">
        <input type="hidden" name="address" value="-">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">FULL NAME</label>
            <input type="text" name="name" required placeholder="John Doe" class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">EMAIL ADDRESS</label>
            <input type="email" name="email" required placeholder="john@example.com" class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">PASSWORD</label>
            <input type="password" name="password" required placeholder="***" class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">PHONE NUMBER</label>
            <input type="text" name="phone" required placeholder="0812..." class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
          </div>
        </div>

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">STAFF ROLE</label>
          <div class="relative">
            <select name="role" required class="w-full p-3 bg-white border-2 border-black text-black font-bold appearance-none cursor-pointer focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#2563EB] transition-all">
              <option value="" disabled selected>-- Select Role --</option>
              <option value="pembeli">Buyer</option>
              <option value="admin_toko">Admin Shop</option>
              <option value="gudang">Warehouse Manager</option>
              <option value="ekspedisi">Delivery / Expedition</option>
              <option value="admin_web">System Admin</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
              <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
          </div>
        </div>

        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('addStaffModal')" class="flex-1 bg-white text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest hover:bg-gray-100 transition-colors">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#2563EB] text-white px-4 py-3 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">SAVE STAFF</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="editStaffModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-2xl relative" data-aos="zoom-in" data-aos-duration="300">

    <button onclick="closeModal('editStaffModal')" class="absolute top-4 right-4 bg-white border-4 border-black w-8 h-8 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white transition-colors">
      X
    </button>

    <div class="p-8">
      <h2 class="text-3xl font-black uppercase mb-1">EDIT STAFF DATA</h2>
      <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-6">UPDATE EMPLOYEE CREDENTIALS</p>

      <form action="<?= BASEURL; ?>/adminuser/updateUser" method="POST" class="space-y-5">
        <input type="hidden" name="id" id="edit_id">
        <input type="hidden" name="address" id="edit_address">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">FULL NAME</label>
            <input type="text" name="name" id="edit_name" required class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">EMAIL ADDRESS</label>
            <input type="email" name="email" id="edit_email" required class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">NEW PASSWORD</label>
            <input type="password" name="password" placeholder="Leave blank to keep old..." class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
          </div>
          <div class="space-y-1">
            <label class="text-[10px] font-black uppercase tracking-widest">PHONE NUMBER</label>
            <input type="text" name="phone" id="edit_phone" required class="w-full p-3 bg-white border-2 border-black text-black font-bold focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
          </div>
        </div>

        <div class="space-y-1">
          <label class="text-[10px] font-black uppercase tracking-widest">STAFF ROLE</label>
          <div class="relative">
            <select name="role" id="edit_role" required class="w-full p-3 bg-white border-2 border-black text-black font-bold appearance-none cursor-pointer focus:outline-none focus:border-4 focus:shadow-[4px_4px_0_0_#FFE600] transition-all">
              <option value="pembeli">Buyer</option>
              <option value="admin_toko">Admin Shop</option>
              <option value="gudang">Warehouse Manager</option>
              <option value="ekspedisi">Delivery / Expedition</option>
              <option value="admin_web">System Admin</option>
              <option value="pemilik">Owner</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-black">
              <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
              </svg>
            </div>
          </div>
        </div>

        <div class="flex gap-4 pt-4 mt-6 border-t-4 border-black">
          <button type="button" onclick="closeModal('editStaffModal')" class="flex-1 bg-white text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest hover:bg-gray-100 transition-colors">CANCEL</button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">UPDATE STAFF</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const HAS_REAL_DATA = <?= empty($data['users']) ? 'false' : 'true'; ?>;
</script>

<script src="<?= BASEURL; ?>/js/admin_users.js"></script>