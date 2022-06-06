<div class="alignfull my-0 bg-bg-gray px-3 py-5 md:py-10">
    <section class="submit-wrapper w-full max-w-[764px] bg-white m-auto">
        <header class="w-full py-4 px-4 bg-gradient-to-r from-apply-s via-apply-m to-apply-e">
            <h2 class="text-white text-2xl font-bold"><?= __('Submit CV', 'NlsHunter') ?></h2>
        </header>
        <form action="" class="p-6 md:p-20">
            <input type="hidden" name="job-code" value="<?= $jobCode ?>">
        </form>
        <footer class="text-center pb-6 md:pb-12">
            <p class="font-bold text-md md:text-lg">
                <?= __('Only lev students and graduates can apply', 'NlsHunter') ?>
            </p>
            <button class="font-bold rounded-md bg-btn-m py-2 px-10 text-white m-auto md:text-2xl"><?= __('Submit', 'NlsHunter') ?></button>
        </footer>
    </section>
</div>