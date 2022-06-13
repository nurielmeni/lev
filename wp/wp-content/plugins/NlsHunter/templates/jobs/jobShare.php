<div class="share-wrapper relative w-11">
  <nav class="absolute flex flex-col z-20 bg-white gap-2 px-2 mt-2.5">
    <button class="share-trigger" aria-labelledby="share-label">
      <span id="share-label" hidden><?= __('Share Job', 'NlsHunter') ?></span>
      <i class="fa-solid fa-share-nodes fa-2xl"></i>
    </button>
    <a href="<?= $shareUrl['whatsapp'] ?>" target="_blank" class="share-item" aria-labelledby="share-label" style="display: none;">
      <span id="share-label" hidden><?= __('Share Job', 'NlsHunter') ?></span>
      <i class="fa-brands fa-whatsapp fa-xl rounded-full bg-green-600 text-white text-center pt-4 w-8 h-8"></i>
    </a>
    <a href="<?= $shareUrl['facebook'] ?>" target="_blank" class="share-item" aria-labelledby="share-label" style="display: none;">
      <span id="share-label" hidden><?= __('Share Job', 'NlsHunter') ?></span>
      <i class="fa-brands fa-facebook-f fa-xl rounded-full bg-sky-700 text-white text-center pt-4 w-8 h-8"></i>
    </a>
    <a href="<?= $shareUrl['linkedin'] ?>" target="_blank" class="share-item" aria-labelledby="share-label" style="display: none;">
      <span id="share-label" hidden><?= __('Share Job', 'NlsHunter') ?></span>
      <i class="fa-brands fa-linkedin-in fa-xl rounded-full bg-blue-500 text-white text-center pt-4 w-8 h-8"></i>
    </a>
  </nav>
</div>