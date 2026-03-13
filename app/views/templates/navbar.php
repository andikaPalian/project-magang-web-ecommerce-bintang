<?php
$cart_count = 0;
$notif_count = 0;

if (isset($_SESSION['user_id'])) {
  $user_id = (int) $_SESSION['user_id'];

  require_once '../app/models/CartModel.php';
  require_once '../app/models/NotificationModel.php';

  $cartModel = new CartModel();
  $notifModel = new NotificationModel();

  $cart_count = $cartModel->getCartTotalItem($user_id);
  $notif_count = $notifModel->getUnreadCount($user_id);
}
?>

<nav class="bg-white border-b-4 border-black py-4 sticky top-0 z-50 font-sans">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-wrap justify-between items-center gap-4 lg:gap-0">

    <div class="flex items-center space-x-8">
      <a href="<?= BASEURL; ?>" class="flex items-center space-x-2 group">
        <div class="bg-black text-white flex items-center justify-center w-8 h-8 group-hover:bg-[#2563EB] transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path>
          </svg>
        </div>
        <span class="font-black text-black tracking-tighter text-lg uppercase group-hover:text-[#2563EB] transition-colors">TI MART</span>
      </a>

      <div class="hidden lg:flex space-x-6">
        <a href="<?= BASEURL; ?>/katalog" class="text-xs font-black text-black uppercase tracking-widest hover:text-[#2563EB] transition-colors">SHOP</a>
        <a href="#" class="text-xs font-black text-black uppercase tracking-widest hover:text-[#2563EB] transition-colors">BLOG</a>
        <a href="<?= BASEURL; ?>/aboutUs" class="text-xs font-black text-black uppercase tracking-widest hover:text-[#2563EB] transition-colors">ABOUT US</a>
      </div>
    </div>

    <div class="hidden md:flex flex-1 max-w-md mx-6">
      <div class="flex w-full bg-white border-2 border-black focus-within:shadow-[4px_4px_0_0_#000] focus-within:-translate-y-[2px] focus-within:-translate-x-[2px] transition-all">
        <div class="pl-3 flex items-center justify-center text-black">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input type="text" placeholder="SEARCH GEAR..." class="w-full px-3 py-2 font-black text-xs uppercase outline-none placeholder-gray-400 text-black">
      </div>
    </div>

    <div class="flex items-center space-x-3">

      <?php if (isset($_SESSION['user_id'])): ?>

        <a href="<?= BASEURL; ?>/notification" class="relative bg-white border-2 border-black w-10 h-10 flex items-center justify-center hover:bg-[#FFE600] hover:shadow-[4px_4px_0_0_#000] hover:-translate-y-[2px] hover:-translate-x-[2px] transition-all group" title="Notifications">
          <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
          </svg>

          <?php if ($notif_count > 0): ?>
            <span class="absolute -top-2 -right-2 bg-[#FF5757] text-white text-[10px] font-black w-5 h-5 flex items-center justify-center border-2 border-black shadow-[2px_2px_0_0_#000]">
              <?= $notif_count > 99 ? '99+' : $notif_count; ?>
            </span>
          <?php endif; ?>
        </a>

        <a href="<?= BASEURL; ?>/wishlist" class="relative bg-white border-2 border-black w-10 h-10 flex items-center justify-center hover:bg-[#FF90E8] hover:shadow-[4px_4px_0_0_#000] hover:-translate-y-[2px] hover:-translate-x-[2px] transition-all group" title="Wishlist">
          <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
        </a>

      <?php endif; ?>

      <a href="<?= BASEURL; ?>/cart" class="relative bg-white border-2 border-black w-10 h-10 flex items-center justify-center hover:bg-[#A6FAAE] hover:shadow-[4px_4px_0_0_#000] hover:-translate-y-[2px] hover:-translate-x-[2px] transition-all group" title="Cart">
        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <span id="nav-cart-badge" class="<?= ($cart_count <= 0) ? 'hidden' : 'flex' ?> absolute -top-2 -right-2 bg-[#2563EB] text-white text-[10px] font-black w-5 h-5 items-center justify-center border-2 border-black shadow-[2px_2px_0_0_#000]">
          <?= $cart_count; ?>
        </span>
      </a>

      <?php if (isset($_SESSION['user_id'])): ?>
        <div class="relative group ml-2">
          <button class="bg-white border-2 border-black px-3 py-2 h-10 flex items-center justify-center hover:bg-[#90E0FF] hover:shadow-[4px_4px_0_0_#000] hover:-translate-y-[2px] hover:-translate-x-[2px] transition-all cursor-pointer">
            <span class="text-[10px] font-black uppercase tracking-widest text-black line-clamp-1 max-w-[100px]">
              <?= $_SESSION['name'] ?? 'USER'; ?>
            </span>
          </button>
          <div class="absolute right-0 mt-2 w-48 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 flex flex-col">
            <div class="px-4 py-3 border-b-4 border-black bg-black text-white">
              <p class="text-[10px] font-black uppercase tracking-widest">STATUS: ONLINE</p>
            </div>

            <?php
            // Logika Dinamis: Jika pembeli -> Profil, Jika lainnya -> Dashboard
            $nav_link = '/profile';
            $nav_text = 'PROFIL SAYA';

            if (isset($_SESSION['role']) && $_SESSION['role'] !== 'pembeli') {
              $nav_link = '/' . $_SESSION['role'] . '/dashboard';
              $nav_text = 'DASHBOARD';
            }
            ?>
            <a href="<?= BASEURL . $nav_link; ?>" class="px-4 py-3 border-b-2 border-black text-xs font-black uppercase text-black hover:bg-[#90E0FF] transition-colors"><?= $nav_text; ?></a>

            <a href="<?= BASEURL; ?>/order" class="px-4 py-3 border-b-2 border-black text-xs font-black uppercase text-black hover:bg-[#90E0FF] transition-colors">ORDERS</a>
            <a href="<?= BASEURL; ?>/auth/logout" class="px-4 py-3 text-xs font-black uppercase text-white bg-[#FF5757] hover:bg-red-700 transition-colors">LOGOUT</a>
          </div>
        </div>
      <?php else: ?>
        <div class="flex items-center space-x-2 ml-2">
          <a href="<?= BASEURL; ?>/auth" class="bg-white border-2 border-black text-black px-4 py-2 h-10 flex items-center text-[10px] font-black uppercase tracking-widest hover:bg-[#FFE600] hover:shadow-[4px_4px_0_0_#000] hover:-translate-y-[2px] hover:-translate-x-[2px] transition-all">
            LOGIN
          </a>
          <a href="<?= BASEURL; ?>/auth/register" class="bg-[#2563EB] border-2 border-black text-white px-4 py-2 h-10 flex items-center text-[10px] font-black uppercase tracking-widest shadow-[4px_4px_0_0_#000] hover:bg-blue-700 hover:-translate-y-[2px] hover:-translate-x-[2px] hover:shadow-[6px_6px_0_0_#000] active:shadow-none transition-all">
            REGISTER
          </a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</nav>

<div class="bg-[#F8F9FA] border-b-4 border-black hidden md:block">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <ul class="flex space-x-2 text-xs font-black text-black py-3 uppercase tracking-widest overflow-x-auto overflow-y-hidden custom-scrollbar">
      <li><a href="#" class="inline-block px-3 py-1.5 border-2 border-transparent hover:border-black hover:bg-[#FFE600] hover:shadow-[2px_2px_0_0_#000] hover:-translate-y-[1px] transition-all">KEYBOARDS</a></li>
      <li><a href="#" class="inline-block px-3 py-1.5 border-2 border-transparent hover:border-black hover:bg-[#FFE600] hover:shadow-[2px_2px_0_0_#000] hover:-translate-y-[1px] transition-all">SWITCHES</a></li>
      <li><a href="#" class="inline-block px-3 py-1.5 border-2 border-transparent hover:border-black hover:bg-[#FFE600] hover:shadow-[2px_2px_0_0_#000] hover:-translate-y-[1px] transition-all">KEYCAPS</a></li>
      <li><a href="#" class="inline-block px-3 py-1.5 border-2 border-transparent hover:border-black hover:bg-[#FFE600] hover:shadow-[2px_2px_0_0_#000] hover:-translate-y-[1px] transition-all">DESK MATS</a></li>
      <li><a href="#" class="inline-block px-3 py-1.5 border-2 border-transparent hover:border-black hover:bg-[#FFE600] hover:shadow-[2px_2px_0_0_#000] hover:-translate-y-[1px] transition-all">AUDIO</a></li>
      <li><a href="#" class="inline-block px-3 py-1.5 border-2 border-transparent hover:border-black hover:bg-[#FFE600] hover:shadow-[2px_2px_0_0_#000] hover:-translate-y-[1px] transition-all">CABLES</a></li>
    </ul>
  </div>
</div>