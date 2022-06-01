<form class="search py-8 mx-auto" action="<?= $searchResultsUrl ?>">
    <?php if (key_exists('title', $atts) && !empty($atts['title'])) : ?>
        <h2 class="mb-7"><?= $atts['title'] ?></h2>
    <?php endif; ?>

    <div class="grid grid-cols-4 grid-rows-3 md:grid-rows-2 gap-4">

        <!-- CATEGORY -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl col-span-2 sm:col-span-1',
            'class' => 'rounded-md shadow-md px-3 py-2 text-primary md:text-2xl',
            'name' => 'category',
            'placeHolder' => __('Category', 'NlsHunter'),
            'options' => $categoryOptions,
            'clearAllButton' => true, // For single select
            'multiple' => true,
            'value' => key_exists('category', $searchParams) ? $searchParams['category'] : [],
            'clearAllButtonClass' => 'hidden bg-primary text-white py-1 px-2 mx-1 border border-primary rounded-xl', // For single select
        ]) ?>

        <!-- SCOPE -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl col-span-2 sm:col-span-1',
            'class' => 'rounded-md shadow-md px-3 py-2 text-primary md:text-2xl',
            'name' => 'scope',
            'placeHolder' => __('Scope', 'NlsHunter'),
            'options' => $scopeOptions,
            'clearAllButton' => true, // For single select
            'multiple' => true,
            'value' => key_exists('scope', $searchParams) ? $searchParams['scope'] : [],
            'clearAllButtonClass' => 'hidden bg-primary text-white py-1 px-2 mx-1 border border-primary rounded-xl', // For single select
        ]) ?>

        <!-- LOCATION -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl col-span-2 sm:col-span-1',
            'class' => 'rounded-md shadow-md px-3 py-2 text-primary md:text-2xl',
            'name' => 'region',
            'placeHolder' => __('Region', 'NlsHunter'),
            'options' => $locationOptions,
            'clearAllButton' => true, // For single select
            'multiple' => true,
            'value' => key_exists('region', $searchParams) ? $searchParams['region'] : [],
            'clearAllButtonClass' => 'hidden bg-primary text-white py-1 px-2 mx-1 border border-primary rounded-xl', // For single select
        ]) ?>

        <!-- HYBRID -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl col-span-2 sm:col-span-1',
            'class' => 'rounded-md shadow-md border-0 px-3 py-2 text-primary md:text-2xl',
            'name' => 'hybrid',
            'placeHolder' => __('Hybrid', 'NlsHunter'),
            'options' => $hybridOptions,
            'clearAllButton' => true, // For single select
            'multiple' => true,
            'value' => key_exists('hybrid', $searchParams) ? $searchParams['hybrid'] : [],
            'clearAllButtonClass' => 'hidden bg-primary text-white py-1 px-2 mx-1 border border-primary rounded-xl', // For single select
        ]) ?>

        <!-- KEYWORD -->
        <?= render('form/nlsInputField', [
            'wrapperClass' => 'col-span-3 text-xl',
            'class' => 'rounded-md shadow-md border-none placeholder-text px-3 py-2 text-primary md:text-2xl w-full',
            'placeHolder' => __('Search by keyword', 'NlsHunter'),
            'name' => 'keyword',
            'value' => key_exists('keyword', $searchParams) ? $searchParams['keyword'] : '',
            'autofocus' => false
        ]) ?>

        <!-- APPLY BUTTON -->
        <?= render('form/nlsApplyBtn', [
            'class' => 'rounded-md shadow-md px-3 py-2  w-full bg-gradient-to-b from-btn-s via-btn-m to-btn-e text-white font-bold md:text-2xl',
            'text' => __('Search', 'NlsHunter')
        ]); ?>
    </div>
</form>