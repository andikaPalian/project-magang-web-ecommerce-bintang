<?php
$article = $data['article'];
$img_src = !empty($article['image_url']) ? (str_starts_with($article['image_url'], 'http') ? $article['image_url'] : BASEURL . '/img/articles/' . $article['image_url']) : 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&w=1200&q=80';
$tanggal = date('d F Y', strtotime($article['created_at']));

$share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$encoded_url = urlencode($share_url);
$encoded_title = urlencode($article['title']);
?>

<div class="bg-[#F8F9FA] min-h-screen pb-20 font-sans text-black" data-aos="fade-in">

  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 md:pt-12">

    <a href="<?= BASEURL; ?>/article" class="inline-flex items-center text-xs font-black uppercase tracking-widest bg-white border-2 border-black px-4 py-2 shadow-[2px_2px_0_0_#000] hover:bg-[#FFE600] hover:-translate-y-1 hover:shadow-[4px_4px_0_0_#000] transition-all mb-8">
      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      KEMBALI KE ARTIKEL
    </a>

    <div class="mb-8">
      <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tight leading-[1.1] mb-6">
        <?= $article['title']; ?>
      </h1>

      <div class="flex flex-wrap items-center gap-4 text-xs font-black uppercase tracking-widest">
        <div class="bg-[#2563EB] text-white px-3 py-1.5 border-2 border-black shadow-[2px_2px_0_0_#000]">
          <?= $tanggal; ?>
        </div>
        <div class="bg-white text-black px-3 py-1.5 border-2 border-black shadow-[2px_2px_0_0_#000]">
          DITULIS OLEH: <span class="text-[#FF5757]"><?= $article['author_name']; ?></span>
        </div>
      </div>
    </div>

    <div class="w-full h-[300px] md:h-[500px] border-4 border-black shadow-[8px_8px_0_0_#000] mb-12 overflow-hidden bg-white">
      <img src="<?= $img_src; ?>" class="w-full h-full object-cover grayscale-[10%]" alt="<?= $article['title']; ?>">
    </div>

    <div class="bg-white border-4 border-black shadow-[8px_8px_0_0_#000] p-6 md:p-12">
      <p class="text-lg md:text-xl font-bold border-l-4 border-[#FF5757] pl-4 mb-8 text-gray-800 italic">
        <?= $article['excerpt']; ?>
      </p>

      <div class="prose prose-lg prose-black max-w-none font-medium leading-relaxed
        prose-headings:font-black prose-headings:uppercase prose-headings:tracking-tight
        prose-a:text-[#2563EB] prose-a:font-bold hover:prose-a:text-[#FF5757]
        prose-strong:font-black prose-strong:bg-[#FFE600] prose-strong:px-1
        prose-img:border-4 prose-img:border-black prose-img:shadow-[4px_4px_0_0_#000]">

        <?= $article['content']; ?>

      </div>
    </div>

    <div class="mt-8 flex justify-between items-center border-t-4 border-black pt-6">
      <h4 class="text-sm font-black uppercase">BAGIKAN ARTIKEL INI:</h4>
      <div class="flex space-x-3">

        <a href="https://twitter.com/intent/tweet?text=<?= $encoded_title ?>&url=<?= $encoded_url ?>" target="_blank" rel="noopener noreferrer"
          class="w-10 h-10 bg-white border-2 border-black flex items-center justify-center hover:bg-black hover:text-white transition-colors shadow-[2px_2px_0_0_#000] active:shadow-none active:translate-y-[2px] active:translate-x-[2px]" aria-label="Share to X">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 22.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.008 5.968H5.078z" />
          </svg>
        </a>

        <a href="https://api.whatsapp.com/send?text=<?= $encoded_title ?>%20-%20<?= $encoded_url ?>" target="_blank" rel="noopener noreferrer"
          class="w-10 h-10 bg-white border-2 border-black flex items-center justify-center hover:bg-[#25D366] hover:text-white transition-colors shadow-[2px_2px_0_0_#000] active:shadow-none active:translate-y-[2px] active:translate-x-[2px]" aria-label="Share to WhatsApp">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
          </svg>
        </a>

        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $encoded_url ?>" target="_blank" rel="noopener noreferrer"
          class="w-10 h-10 bg-white border-2 border-black flex items-center justify-center hover:bg-[#1877F2] hover:text-white transition-colors shadow-[2px_2px_0_0_#000] active:shadow-none active:translate-y-[2px] active:translate-x-[2px]" aria-label="Share to Facebook">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
          </svg>
        </a>

        <button onclick="shareToInstagram('<?= $share_url ?>')"
          class="w-10 h-10 bg-white border-2 border-black flex items-center justify-center hover:bg-[#E1306C] hover:text-white transition-colors shadow-[2px_2px_0_0_#000] active:shadow-none active:translate-y-[2px] active:translate-x-[2px] cursor-pointer" aria-label="Copy link for Instagram">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
          </svg>
        </button>

      </div>
    </div>

  </div>
</div>

<script>
  function shareToInstagram(url) {
    navigator.clipboard.writeText(url).then(() => {
      alert('LINK TERSALIN! \n\nLink artikel berhasil disalin. Silakan paste link tersebut di DM atau Instagram Story Anda!');
    }).catch(err => {
      console.error('Gagal menyalin text: ', err);
      const tempInput = document.createElement("input");
      tempInput.value = url;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand("copy");
      document.body.removeChild(tempInput);
      alert('LINK TERSALIN! \n\nLink artikel berhasil disalin. Silakan paste link tersebut di DM atau Instagram Story Anda!');
    });
  }
</script>