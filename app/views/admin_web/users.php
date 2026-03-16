<div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end pb-4 gap-4" data-aos="fade-in">
  <div>
    <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter text-black mb-2">USER MANAGEMENT</h1>
    <p class="text-sm font-bold text-gray-600 max-w-xl leading-relaxed">
      Atur dan pantau semua pengguna terdaftar di platform. Kelola hak akses, status akun, dan peran staf.
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
  <button class="bg-black text-white px-4 py-2 border-4 border-black font-black text-xs flex items-center shadow-[4px_4px_0_0_#000] hover:bg-gray-800">
    All Roles <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
    </svg>
  </button>
  <button class="bg-white text-black px-4 py-2 border-4 border-black font-black text-xs flex items-center shadow-[4px_4px_0_0_#000] hover:bg-gray-100">
    Role: Buyer <span class="ml-2 text-gray-400">×</span>
  </button>
  <button class="bg-white text-black px-4 py-2 border-4 border-black font-black text-xs flex items-center shadow-[4px_4px_0_0_#000] hover:bg-gray-100">
    Status: Active <span class="ml-2 text-gray-400">×</span>
  </button>

  <div class="flex-1"></div>

  <button class="bg-white text-black px-6 py-2 border-4 border-black font-black text-xs flex items-center shadow-[4px_4px_0_0_#000] hover:bg-gray-100">
    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
    </svg>
    Filter
  </button>
</div>

<div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] overflow-x-auto mb-10" data-aos="fade-up" data-aos-delay="100">
  <table class="w-full text-left border-collapse min-w-[900px]">
    <thead>
      <tr class="bg-black text-white text-xs font-black uppercase tracking-widest">
        <th class="p-5 border-r-4 border-white">NAME</th>
        <th class="p-5 border-r-4 border-white">EMAIL</th>
        <th class="p-5 border-r-4 border-white">ROLE</th>
        <th class="p-5 border-r-4 border-white">STATUS</th>
        <th class="p-5 text-center">ACTIONS</th>
      </tr>
    </thead>
    <tbody class="text-sm font-bold text-black bg-white">

      <?php foreach ($data['users'] as $user):
        // Lingkaran Warna Avatar Acak ala Desain
        $avatarColors = ['bg-[#FF90E8]', 'bg-[#A6FAAE]', 'bg-[#B28DFF]', 'bg-[#90E0FF]', 'bg-[#FFE600]'];
        $randomColor = $avatarColors[$user['id'] % count($avatarColors)];

        // Badge Role
        $roleText = str_replace('_', ' ', $user['role']);
        $roleBadge = 'border-gray-400 text-gray-600 bg-gray-100'; // Default Buyer
        if ($user['role'] == 'admin_toko' || $user['role'] == 'admin_web') $roleBadge = 'border-[#2563EB] text-[#2563EB] bg-blue-50';
        if ($user['role'] == 'gudang') $roleBadge = 'border-[#E65100] text-[#E65100] bg-orange-50';
        if ($user['role'] == 'ekspedisi') $roleBadge = 'border-[#FF5757] text-[#FF5757] bg-red-50';
        if ($user['role'] == 'pemilik') $roleBadge = 'border-[#FFE600] text-black bg-yellow-50';
      ?>
        <tr class="border-b-4 border-black hover:bg-gray-50 transition-colors">
          <td class="p-4 border-r-4 border-black flex items-center">
            <div class="w-8 h-8 rounded-full border-2 border-black mr-3 <?= $randomColor ?> shrink-0"></div>
            <span class="font-black text-base"><?= htmlspecialchars($user['name']) ?></span>
          </td>
          <td class="p-4 border-r-4 border-black font-semibold text-gray-700">
            <?= htmlspecialchars($user['email']) ?>
          </td>
          <td class="p-4 border-r-4 border-black">
            <span class="border-2 px-2 py-1 text-[10px] font-black uppercase tracking-widest <?= $roleBadge ?>">
              <?= $roleText ?>
            </span>
          </td>
          <td class="p-4 border-r-4 border-black">
            <span class="text-[#00C853] font-black text-sm flex items-center">
              <span class="w-2 h-2 rounded-full bg-[#00C853] mr-2"></span> Active
            </span>
          </td>
          <td class="p-4 flex items-center justify-center space-x-2">

            <button onclick="openEditModal(<?= htmlspecialchars(json_encode($user)) ?>)" class="bg-white text-black p-2 border-2 border-black hover:bg-gray-200 transition-all shadow-[2px_2px_0_0_#000]" title="EDIT STAFF">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
              </svg>
            </button>

            <?php if (isset($_SESSION['user_id']) && $user['id'] != $_SESSION['user_id']): ?>
              <a href="<?= BASEURL; ?>/adminuser/deleteUser/<?= $user['id'] ?>" onclick="return confirm('Hapus staf ini?');" class="bg-white text-black p-2 border-2 border-black hover:bg-[#FF5757] hover:text-white transition-all shadow-[2px_2px_0_0_#000]" title="BLOCK / DELETE">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
              </a>
            <?php else: ?>
              <button class="bg-gray-200 text-gray-400 p-2 border-2 border-gray-400 cursor-not-allowed" title="TIDAK BISA MENGHAPUS DIRI SENDIRI">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
              </button>
            <?php endif; ?>

          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>


<div id="addStaffModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-2xl relative animate-fade-in-up">

    <button onclick="closeModal('addStaffModal')" class="absolute top-4 right-4 bg-white border-4 border-black w-8 h-8 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white transition-colors">
      X
    </button>

    <div class="p-8">
      <h2 class="text-3xl font-black uppercase mb-1">ADD NEW STAFF</h2>
      <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-6">EMPLOYEE REGISTRATION FORM</p>

      <form action="<?= BASEURL; ?>/adminuser/storeUser" method="POST" class="space-y-5">

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
          <button type="button" onclick="closeModal('addStaffModal')" class="flex-1 bg-white text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest hover:bg-gray-100 transition-colors">
            CANCEL
          </button>
          <button type="submit" class="flex-1 bg-[#2563EB] text-white px-4 py-3 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">
            SAVE STAFF
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="editStaffModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-4 transition-opacity">
  <div class="bg-white border-4 border-black shadow-[12px_12px_0_0_#000] w-full max-w-2xl relative animate-fade-in-up">

    <button onclick="closeModal('editStaffModal')" class="absolute top-4 right-4 bg-white border-4 border-black w-8 h-8 flex items-center justify-center font-black text-xl hover:bg-[#FF5757] hover:text-white transition-colors">
      X
    </button>

    <div class="p-8">
      <h2 class="text-3xl font-black uppercase mb-1">EDIT STAFF DATA</h2>
      <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-6">UPDATE EMPLOYEE CREDENTIALS</p>

      <form action="<?= BASEURL; ?>/adminuser/updateUser" method="POST" class="space-y-5">

        <input type="hidden" name="id" id="edit_id">

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
          <button type="button" onclick="closeModal('editStaffModal')" class="flex-1 bg-white text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest hover:bg-gray-100 transition-colors">
            CANCEL
          </button>
          <button type="submit" class="flex-1 bg-[#FFE600] text-black px-4 py-3 border-4 border-black font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:-translate-y-1 hover:shadow-[6px_6px_0_0_#000] transition-all">
            UPDATE STAFF
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in-up {
    animation: fadeInUp 0.3s ease-out forwards;
  }
</style>

<script>
  function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.getElementById(modalId).classList.add('flex');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.remove('flex');
    document.body.style.overflow = 'auto';
  }

  function openEditModal(userData) {
    document.getElementById('edit_id').value = userData.id;
    document.getElementById('edit_name').value = userData.name;
    document.getElementById('edit_email').value = userData.email;
    document.getElementById('edit_phone').value = userData.phone || '';
    document.getElementById('edit_role').value = userData.role;

    openModal('editStaffModal');
  }
</script>