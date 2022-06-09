<div class="alignfull my-0 bg-bg-gray px-3 py-5 md:py-10">
    <section class="submit-wrapper w-full max-w-[764px] bg-white m-auto">
        <header class="w-full py-4 px-4 bg-gradient-to-r from-apply-s via-apply-m to-apply-e">
            <h2 class="text-white text-2xl font-bold"><?= __('Submit CV', 'NlsHunter') ?></h2>
        </header>
        <form action="" class="nls-apply-for-jobs p-6 md:p-20 bg-gray text-xl">
            <?= render('apply/form', [
                'jobCode' => $jobCode,
                'studyYearOptions' => $studyYearOptions
            ]) ?>

            <footer class="text-center pb-6 md:pb-12">
                <p class="font-bold text-md md:text-md md:text-right py-3">
                    <?= __('Only lev students and graduates can apply', 'NlsHunter') ?>
                </p>

                <!-- APPLY BUTTON -->
                <?= render('form/nlsApplyBtn', [
                    'class' => 'apply-job font-bold rounded-md bg-btn-m py-4 px-14 text-white m-auto md:text-2xl',
                    'text' => __('Send', 'NlsHunter')
                ]); ?>
            </footer>
        </form>
    </section>
</div>