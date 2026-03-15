</main>
</div>
</div>
<div id="global-toast" class="fixed top-5 right-5 z-[100] transform translate-x-full opacity-0 transition-all duration-300 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-4 flex items-center max-w-sm">
  <div class="bg-[#A6FAAE] border-2 border-black p-1.5 mr-4 shadow-[2px_2px_0_0_#000]">
    <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
    </svg>
  </div>
  <div>
    <h4 class="text-sm font-black text-black uppercase tracking-wider">SUCCESS</h4>
    <p id="global-toast-msg" class="text-xs font-bold text-gray-600 mt-0.5">Tindakan berhasil.</p>
  </div>
</div>

<div id="global-toast-error" class="fixed top-5 right-5 z-[100] transform translate-x-full opacity-0 transition-all duration-300 bg-white border-4 border-black shadow-[6px_6px_0_0_#000] p-4 flex items-center max-w-sm">
  <div class="bg-[#FF5757] border-2 border-black p-1.5 mr-4 shadow-[2px_2px_0_0_#000]">
    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
  </div>
  <div>
    <h4 class="text-sm font-black text-black uppercase tracking-wider">ERROR</h4>
    <p id="global-toast-error-msg" class="text-xs font-bold text-gray-600 mt-0.5">Tindakan gagal.</p>
  </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    once: true,
    offset: 50,
    duration: 500,
  });

  function showAdminToast(message, isError = false) {
    const toastId = isError ? 'global-toast-error' : 'global-toast';
    const msgId = isError ? 'global-toast-error-msg' : 'global-toast-msg';
    const toast = document.getElementById(toastId);

    document.getElementById(msgId).textContent = message;

    toast.classList.remove('translate-x-full', 'opacity-0');

    setTimeout(() => {
      toast.classList.add('translate-x-full', 'opacity-0');
    }, 3000);
  }
</script>

</body>

</html>