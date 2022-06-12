<section class="serach-results alignfull flex flex-col items-center gap-6 md:gap-8">
  <div class="container w-full">
    <h2 class="text-white w-full text-2xl font-bold py-4 px-4 bg-gradient-to-r from-header-s via-header-m via-header-m1 to-header-e"><?= __('Search Results', 'NlsHunter') ?></h2>
    <?php if ($jobs && is_array($jobs) && key_exists('list', $jobs) && is_array($jobs['list']) && count($jobs['list']) > 0) : ?>
      <?php foreach ($jobs['list'] as $job) : ?>
        <?= render('jobs/job', [
          'model' => $model,
          'job' => $job,
          'applyCvUrl' => $applyCvUrl
        ]) ?>
      <?php endforeach; ?>
    <?php else : ?>
      <?= __('No jobs were found', 'NlsHunter') ?>
    <?php endif; ?>
  </div>
</section>