<div class="bg-[#1e293b] text-white text-[11px] py-2 hidden md:block">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
    <div class="flex items-center space-x-4 text-gray-300">
      <span class="flex items-center"><svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
        </svg> Makassar, Indonesia</span>
      <span>|</span>
      <span>Gratis Ongkir min. Rp 500.000</span>
    </div>
    <div class="flex space-x-6">
      <a href="#" class="hover:text-white transition">Tentang Kami</a>
      <a href="#" class="hover:text-white transition">Blog</a>
      <a href="#" class="hover:text-white transition">Bantuan</a>
    </div>
  </div>
</div>

<nav class="bg-white border-b border-gray-100 py-4 sticky top-0 z-50 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
    <a href="<?= BASEURL; ?>" class="flex items-center space-x-2">
      <div class="bg-[#ef4444] text-white font-bold text-xl w-10 h-10 flex items-center justify-center rounded-md">A</div>
      <div class="leading-none">
        <div class="font-bold text-gray-900 tracking-tight text-lg">ALASKA</div>
        <div class="text-[9px] text-gray-500 tracking-widest font-semibold uppercase">Electronics</div>
      </div>
    </a>

    <div class="flex-1 max-w-2xl mx-10 relative flex">
      <input type="text" placeholder="Cari produk elektronik..." class="w-full pl-4 pr-4 py-2.5 rounded-l-md border border-gray-300 focus:outline-none focus:border-[#ef4444] text-sm">
      <button class="bg-[#ef4444] hover:bg-red-600 transition px-5 rounded-r-md text-white flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </button>
    </div>

    <div class="flex items-center space-x-5">
      <div class="flex items-center space-x-4 text-gray-600">
        <button class="relative hover:text-[#ef4444] transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
          </svg>
          <span class="absolute -top-1.5 -right-1.5 bg-[#ef4444] text-white text-[9px] font-bold w-4 h-4 flex items-center justify-center rounded-full border border-white">3</span>
        </button>
        <button class="hover:text-[#ef4444] transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
          </svg>
        </button>
        <a href="<?= BASEURL; ?>/cart" class="hover:text-[#ef4444] transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
        </a>
      </div>
      <div class="h-6 w-px bg-gray-200"></div>
      <div class="flex items-center space-x-3">
        <a href="<?= BASEURL; ?>/auth" class="text-sm font-semibold text-gray-700 hover:text-[#ef4444] transition">Masuk</a>
        <a href="<?= BASEURL; ?>/auth/register" class="bg-[#ef4444] text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-red-600 transition shadow-sm">Daftar</a>
      </div>
    </div>
  </div>
</nav>

<div class="bg-white border-b border-gray-100 hidden md:block">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <ul class="flex space-x-8 text-sm font-medium text-gray-600 py-3">
      <li><a href="#" class="hover:text-[#ef4444] transition">Smartphone</a></li>
      <li><a href="#" class="hover:text-[#ef4444] transition">Laptop</a></li>
      <li><a href="#" class="hover:text-[#ef4444] transition">TV & Monitor</a></li>
      <li><a href="#" class="hover:text-[#ef4444] transition">Audio</a></li>
      <li><a href="#" class="hover:text-[#ef4444] transition">Kamera</a></li>
      <li><a href="#" class="hover:text-[#ef4444] transition">Gaming</a></li>
      <li><a href="#" class="hover:text-[#ef4444] transition">Peralatan Rumah</a></li>
      <li><a href="#" class="hover:text-[#ef4444] transition">Aksesoris</a></li>
    </ul>
  </div>
</div>