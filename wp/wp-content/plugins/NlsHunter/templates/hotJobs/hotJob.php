<article class="<?= isset($wrapperClass) ? $wrapperClass : '' ?>">
    <header>
        <h3 class="<?= isset($titleClass) ? $titleClass : '' ?>"><?= $jobTitle ?></h3>
    </header>
    <p class="mt-auto mb-0 <?= isset($contentClass) ? $contentClass : '' ?>"></p>
    <footer class="flex w-full">
        <a href="<?= esc_url($applyUrl . '?job-code=' . $jobCode) ?>" class="<?= isset($buttonClass) ? $buttonClass : '' ?>">
            <?= __('Submit CV', 'NlsHunter') ?>
        </a>
    </footer>
</article>