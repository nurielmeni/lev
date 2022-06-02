<article class="job-wrapper">
  <header class="bg-[#eee] bg-opacity-90">
    <dl>
      <dt><strong><?= __('Job Type', 'NlsHunter') ?></strong></dt>
      <dd><?= $job->EmploymentType ?></dd>
      <dt><strong><?= __('Job Category', 'NlsHunter') ?></strong></dt>
      <dd><?= '$job->JobProfessionalFields' ?></dd>
      <dt><strong><?= __('Job Location', 'NlsHunter') ?></strong></dt>
      <dd><?= $job->RegionId ?></dd>
    </dl>
  </header>
  <h3><?= $job->JobTitle ?></h3>
  <div><?= html_entity_decode($job->Description, ENT_QUOTES) ?></div>
  <footer></footer>
</article>