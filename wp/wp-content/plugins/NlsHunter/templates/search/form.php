<form class="search py-8 p1 md:p-4 mx-auto" action="<?= $searchResultsUrl ?>">
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

        <!-- Employment Type -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl col-span-2 sm:col-span-1',
            'class' => 'rounded-md shadow-md border-0 px-3 py-2 text-primary md:text-2xl',
            'name' => 'employment-type',
            'placeHolder' => __('EmploymentType', 'NlsHunter'),
            'options' => $employmentType,
            'clearAllButton' => true, // For single select
            'multiple' => false,
            'value' => key_exists('employment-type', $searchParams) ? $searchParams['employment-type'] : [],
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

        <!-- EMPLOYMENT FORM -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl col-span-2 sm:col-span-1',
            'class' => 'rounded-md shadow-md px-3 py-2 text-primary md:text-2xl',
            'name' => 'employment-form',
            'placeHolder' => __('Employment Form', 'NlsHunter'),
            'options' => $employmentForm,
            'clearAllButton' => true, // For single select
            'multiple' => false,
            'value' => key_exists('employment-form', $searchParams) ? $searchParams['employment-form'] : [],
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
            'class' => 'rounded-md shadow-md px-3 py-2  w-full bg-gradient-to-b from-btn-s via-btn-m to-btn-e text-white font-bold text-xl md:text-2xl',
            'text' => __('Search', 'NlsHunter')
        ]); ?>
    </div>
</form>