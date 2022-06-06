<article class="w-full job-wrapper drop-shadow-md bg-white my-4 rounded-b-md">
  <header class=" bg-[#eee] bg-opacity-90 p-4">
    <div class="flex justify-between">
      <h3 class="text-xl md:text-2xl font-bold"><?= $job->JobTitle ?></h3>
      <?= $job->JobCode ?>
    </div>
    <dl class="flex gap-2">
      <dt><strong><?= __('Job Type', 'NlsHunter') ?>:</strong></dt>
      <dd class="ml-2"><?= $job->EmploymentType ?></dd>
      <dt><strong><?= __('Job Category', 'NlsHunter') ?>:</strong></dt>
      <dd class="ml-2"><?= 'תחום' ?></dd>
      <dt><strong><?= __('Job Location', 'NlsHunter') ?>:</strong></dt>
      <dd class="ml-2"><?= $job->RegionId ?></dd>
    </dl>
  </header>
  <div class="px-4 pt-4">
    <div class="flex justify-between">
      <h3 class="font-bold mb-3"><?= __('Job Description', 'NlsHunter') ?></h3>
      <?= render('jobs/jobShare', []) ?>
    </div>
    <article>
      <?= html_entity_decode($job->Description, ENT_QUOTES) ?>
    </article>
  </div>
  <footer class="flex justify-center md:justify-end p-4">
    <form action="<?= $applyCvUrl ?>">
      <input type="hidden" name="job-code" value="<?= $job->JobCode ?>">
      <button type="submit" class="font-bold rounded-md bg-btn-m py-2 px-8 text-white"><?= __('Submit CV', 'NlsHunter') ?></button>
    </form>
  </footer>
</article>