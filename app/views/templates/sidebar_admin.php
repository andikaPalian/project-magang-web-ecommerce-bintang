<?php
$role = $_SESSION['role'] ?? '';
$user_name = $_SESSION['name'] ?? 'ROOT_USER';

$current_uri = $_SERVER['REQUEST_URI'];

$activeClass = 'bg-[#2563EB] text-white border-4 border-black shadow-[4px_4px_0_0_#000] hover:-translate-y-1 transition-transform mr-1 mb-1';
$inactiveClass = 'text-black border-4 border-transparent hover:border-black hover:bg-gray-100 transition-all mr-1 mb-1';

$isDashboard  = strpos($current_uri, 'dashboard') !== false;
$isUsers      = strpos($current_uri, 'adminuser') !== false;
$isProducts   = strpos($current_uri, 'adminproduct') !== false;
$isCategories = strpos($current_uri, 'admincategory') !== false;
$isArticles   = strpos($current_uri, 'adminarticle') !== false;
$isVouchers   = strpos($current_uri, 'adminvoucher') !== false;
$isOrders     = strpos($current_uri, 'adminorder') !== false;
?>

<div class="flex h-screen w-full bg-[#F8F9FA] font-sans text-black overflow-hidden selection:bg-[#FFE600] selection:text-black">

  <aside class="w-64 bg-white border-r-4 border-black flex flex-col z-20 shrink-0 shadow-[4px_0_0_0_#000]">

    <div class="h-20 border-b-4 border-black flex items-center px-5 shrink-0">
      <div class="bg-[#2563EB] border-2 border-black w-10 h-10 flex items-center justify-center text-white font-black text-xl shadow-[3px_3px_0_0_#000] mr-3">
        >_
      </div>
      <div>
        <h1 class="font-black text-lg leading-tight uppercase tracking-tighter">TIMART</h1>
        <p class="text-[9px] font-black text-[#2563EB] uppercase tracking-widest">ADMIN DASHBOARD</p>
      </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 flex flex-col gap-1">

      <a href="<?= BASEURL; ?>/adminweb/dashboard" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isDashboard ? $activeClass : $inactiveClass; ?>">
        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
        </svg>
        DASHBOARD
      </a>

      <?php if (in_array($role, ['admin_web', 'pemilik'])): ?>
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b-2 border-gray-200 pb-1 mt-6 mb-2 px-1">WEB MANAGEMENT</p>

        <a href="<?= BASEURL; ?>/adminorder" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isOrders ? $activeClass : $inactiveClass; ?>">
          <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          ORDERS
        </a>

        <a href="<?= BASEURL; ?>/adminuser" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isUsers ? $activeClass : $inactiveClass; ?>">
          <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
          </svg>
          USERS
        </a>

        <a href="<?= BASEURL; ?>/adminproduct" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isProducts ? $activeClass : $inactiveClass; ?>">
          <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          PRODUCTS
        </a>

        <a href="<?= BASEURL; ?>/admincategory" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isCategories ? $activeClass : $inactiveClass; ?>">
          <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
          </svg>
          CATEGORIES
        </a>

        <a href="<?= BASEURL; ?>/adminarticle" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isArticles ? $activeClass : $inactiveClass; ?>">
          <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
          </svg>
          ARTICLES
        </a>

        <a href="<?= BASEURL; ?>/adminvoucher" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isVouchers ? $activeClass : $inactiveClass; ?>">
          <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
          </svg>
          VOUCHERS
        </a>
      <?php endif; ?>

      <?php if (in_array($role, ['gudang', 'admin_web', 'pemilik'])): ?>
        <?php
        $isFulfillment = strpos($current_uri, 'fulfillment') !== false;
        $isOutbound    = strpos($current_uri, 'outbound') !== false;
        ?>
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest border-b-2 border-gray-200 pb-1 mt-6 mb-2 px-1">GUDANG</p>

        <a href="<?= BASEURL; ?>/gudang/fulfillment" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isFulfillment ? $activeClass : $inactiveClass; ?>">
          <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          FULFILLMENT.EXE
        </a>

        <a href="<?= BASEURL; ?>/gudang/outbound" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isOutbound ? $activeClass : $inactiveClass; ?>">
          <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
          </svg>
          OUTBOUND.SYS
        </a>

        <a href="<?= BASEURL; ?>/adminproduct" class="flex items-center px-4 py-3 font-black uppercase text-xs tracking-widest <?= $isProducts ? $activeClass : $inactiveClass; ?>">
          <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
          </svg>
          WAREHOUSE_INV.DB
        </a>
      <?php endif; ?>

    </nav>

    <div class="mt-auto p-4 border-t-4 border-black bg-white">
      <div class="border-4 border-black p-3 flex items-center bg-[#F8F9FA]">
        <div class="w-8 h-8 bg-[#FFE600] border-2 border-black mr-3 shrink-0"></div>
        <div class="overflow-hidden">
          <p class="text-xs font-black uppercase line-clamp-1 truncate"><?= htmlspecialchars($user_name); ?></p>
          <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest line-clamp-1"><?= str_replace('_', ' ', htmlspecialchars($role)); ?></p>
        </div>
      </div>
    </div>
  </aside>

  <div class="flex-1 flex flex-col h-screen overflow-hidden bg-[#F8F9FA]">

    <header class="h-20 bg-white border-b-4 border-black flex items-center justify-between px-8 z-10 shrink-0">
      <div class="flex-1 max-w-md">
        <div class="flex w-full bg-white border-4 border-black shadow-[4px_4px_0_0_#000] transition-transform focus-within:-translate-y-1">
          <input type="text" placeholder="SEARCH" class="w-full px-4 py-2 font-black text-xs uppercase outline-none placeholder-gray-400 text-black">
          <div class="flex items-center justify-center px-3 border-l-4 border-black bg-gray-50">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="flex items-center space-x-4">
        <button class="w-10 h-10 bg-white border-4 border-black flex items-center justify-center hover:bg-[#FFE600] transition-colors shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
          </svg>
        </button>
        <button class="w-10 h-10 bg-white border-4 border-black flex items-center justify-center hover:bg-gray-200 transition-colors shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          </svg>
        </button>
        <a href="<?= BASEURL; ?>/auth/logout" class="bg-black text-white px-5 py-2.5 border-4 border-black font-black uppercase text-xs tracking-widest hover:bg-[#FF5757] hover:border-[#FF5757] transition-colors shadow-[4px_4px_0_0_#FF5757] active:translate-y-1 active:shadow-none">
          LOGOUT
        </a>
      </div>
    </header>

    <main class="flex-1 overflow-x-hidden overflow-y-auto p-8 relative">