<div class="alignfull">
    <section class="hot-jobs container m-auto w-full shadow-md">
        <h2 class="w-full text-white text-2xl font-bold py-4 px-4 bg-gradient-to-r from-header-s via-header-m via-header-m1 to-header-e"><?= __('Hot Jobs', 'NlsHunter') ?></h2>
        <div class="flex justify-center lg:justify-between flex-wrap px-4 lg:px-12 xl:px-20 py-12">
            <?php foreach ($hotJobs as $hotJob) : ?>
                <?= render('hotJobs/hotJob', [
                    'applyUrl' => $applyUrl,
                    'jobTitle' => $hotJob->JobTitle,
                    'jobCode' => $hotJob->JobCode,
                    'contentClass' => 'border-b border-slate-300 w-4/5 pt-6',
                    'titleClass' => 'w-full flex justify-center items-center text-center text-primary text-xl',
                    'wrapperClass' => 'flex flex-col items-center min-w-280 w-11/12 lg:w-[280px] xl:w-96 shadow-md shadow-slate-800 p-4 md:p-6 my-4',
                    'buttonClass' => 'w-full flex justify-center items-center font-bold rounded-md bg-btn-m py-2 text-white'
                ]) ?>
            <?php endforeach; ?>
        </div>
        <footer class="flex justify-center items-center">
            <a href="<?= $searchResultsUrl ?>" class="font-bold rounded-md py-2 px-4 bg-primary text-white text-xl md:text-2xl mb-8">
                <?= __('All Jobs', 'NlsHunter') ?>
            </a>
        </footer>
    </section>
</div>