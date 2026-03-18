  <!DOCTYPE html>
  <html lang="id">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PROTOCOL | TI MART</title>
    <link href="<?= BASEURL; ?>/css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
      body {
        font-family: 'Space Grotesk', sans-serif;
      }

      .scrollbar-hide::-webkit-scrollbar {
        display: none;
      }

      .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
    </style>
  </head>

  <body class="bg-[#F8F9FA] text-black overflow-hidden">

    <div class="flex min-h-screen">

      <div class="w-full lg:w-1/2 flex flex-col relative h-screen overflow-y-auto scrollbar-hide z-10 border-r-4 border-black bg-white" data-aos="fade-right">

        <div class="absolute top-6 left-6 z-50">
          <a href="<?= BASEURL; ?>" class="inline-flex items-center text-xs font-black uppercase tracking-widest text-black bg-white border-4 border-black px-4 py-2 shadow-[4px_4px_0_0_#000] hover:bg-[#FFE600] hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[2px_2px_0_0_#000] active:shadow-none transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            KEMBALI KE BERANDA
          </a>
        </div>

        <div class="flex-1 flex flex-col justify-center w-full max-w-md mx-auto px-6 py-20 mt-10">

          <div class="mb-10 text-left border-l-4 border-[#2563EB] pl-4">
            <p class="text-[10px] font-black tracking-widest uppercase text-gray-500 mb-1 bg-[#E2E8F0] inline-block px-2">LOGIN</p>
            <h2 class="text-4xl sm:text-5xl font-black text-black uppercase tracking-tighter leading-none mb-2" style="-webkit-text-stroke: 1px black;">MASUK KE<br>AKUN.</h2>
            <p class="text-sm font-bold text-gray-700 uppercase tracking-wide mt-3">Selamat datang kembal di TI MART.</p>
          </div>

          <?php if (isset($data['error'])): ?>
            <div class="bg-[#FF5757] border-4 border-black text-white px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-start text-xs">
              <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
              </svg>
              <p><?= $data['error']; ?></p>
            </div>
          <?php endif; ?>

          <?php if (isset($data['success'])): ?>
            <div class="bg-[#A6FAAE] border-4 border-black text-black px-4 py-3 mb-6 shadow-[4px_4px_0_0_#000] font-black uppercase tracking-wider flex items-start text-xs">
              <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
              </svg>
              <p><?= $data['success']; ?></p>
            </div>
          <?php endif; ?>

          <form action="<?= BASEURL; ?>/auth/authenticate" method="POST" class="space-y-6">

            <div>
              <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-black mb-2">EMAIL</label>
              <input id="email" name="email" type="email" required
                class="block w-full px-4 py-4 bg-gray-50 border-4 border-black placeholder-gray-400 focus:bg-white focus:outline-none focus:shadow-[4px_4px_0_0_#2563EB] focus:-translate-y-1 focus:-translate-x-1 transition-all text-sm font-bold text-black uppercase"
                placeholder="EXAMPLE@gmail.com">
            </div>

            <div>
              <div class="flex justify-between items-end mb-2">
                <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-black">PASSWORD</label>
                <a href="#" class="text-[10px] font-black text-[#2563EB] uppercase hover:underline">LUPA PASSWORD?</a>
              </div>
              <input id="password" name="password" type="password" required
                class="block w-full px-4 py-4 bg-gray-50 border-4 border-black placeholder-gray-400 focus:bg-white focus:outline-none focus:shadow-[4px_4px_0_0_#FF5757] focus:-translate-y-1 focus:-translate-x-1 transition-all text-sm font-bold text-black tracking-widest"
                placeholder="••••••••">
            </div>

            <div class="flex items-center pt-2">
              <input id="remember-me" name="remember-me" type="checkbox" class="h-5 w-5 bg-white border-4 border-black appearance-none checked:bg-black checked:relative checked:after:content-['✔'] checked:after:absolute checked:after:text-white checked:after:text-xs checked:after:left-0.5 checked:after:top-[-2px] cursor-pointer rounded-none transition-all">
              <label for="remember-me" class="ml-3 block text-xs font-black uppercase tracking-widest text-gray-600 cursor-pointer mt-1">INGAT SAYA</label>
            </div>

            <button type="submit" class="w-full flex justify-center py-4 px-4 border-4 border-black text-sm font-black uppercase tracking-widest text-white bg-[#2563EB] shadow-[6px_6px_0_0_#000] hover:bg-blue-700 hover:translate-y-[2px] hover:translate-x-[2px] hover:shadow-[4px_4px_0_0_#000] active:translate-y-[6px] active:translate-x-[6px] active:shadow-none transition-all">
              MASUK
            </button>

          </form>

          <div class="mt-12 pt-6 border-t-4 border-black border-dashed text-center">
            <p class="text-xs font-bold text-gray-600 uppercase tracking-wider">
              BELUM PUNYA AKUN?
              <a href="<?= BASEURL; ?>/auth/register" class="font-black text-black bg-[#FFE600] px-2 py-1 ml-2 border-2 border-black hover:shadow-[2px_2px_0_0_#000] transition-all">DAFTAR SEKARANG</a>
            </p>
          </div>

        </div>
      </div>

      <div class="hidden lg:flex lg:w-1/2 bg-[#FFE600] relative h-screen sticky top-0 flex-col justify-between p-12 xl:p-16 overflow-hidden">

        <div class="absolute inset-0 z-0 border-l-4 border-black">
          <img class="h-full w-full object-cover mix-blend-multiply grayscale-[30%] opacity-80" src="https://images.unsplash.com/photo-1550009158-9ebf69173e03?auto=format&fit=crop&w=1200&q=80" alt="TI MART Gear">
          <div class="absolute inset-0 bg-[radial-gradient(#000_1px,transparent_1px)] [background-size:16px_16px] opacity-20"></div>
        </div>

        <div class="relative z-10 self-end" data-aos="fade-down" data-aos-delay="100">
          <span class="bg-black text-white px-4 py-2 text-xs font-black uppercase tracking-widest border-2 border-black shadow-[-4px_4px_0_0_rgba(255,255,255,1)]">LOGIN KE AKUN</span>
        </div>

        <div class="relative z-10 max-w-lg bg-white border-4 border-black p-8 shadow-[12px_12px_0_0_#000]" data-aos="fade-up" data-aos-delay="300">
          <h3 class="text-4xl xl:text-5xl font-black uppercase mb-4 leading-none tracking-tighter" style="-webkit-text-stroke: 1px black;">TERKNOLOGI TERKINI<br>DI UJUNG JARI ANDA.</h3>
          <p class="text-sm text-gray-800 font-bold uppercase tracking-widest leading-relaxed border-l-4 border-[#2563EB] pl-4">
            Jelajai ribuan produk elektronik original bergaransi resmi. Belanja cerdas, aman, dan nyaman hanya di TI MART.
          </p>
        </div>

      </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init({
        once: true,
        duration: 600,
        easing: 'ease-out-cubic'
      });
    </script>
  </body>

  </html>