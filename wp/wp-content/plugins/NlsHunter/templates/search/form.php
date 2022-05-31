<?php
$jobOptions = ['id' => 1, 'text' => 'one'];
?>
<form class="search py-8 mx-auto" action="search-results">
    <h2 class="mb-7"><?= __('serach your next job', 'NlsHunter') ?></h2>
    <div class="grid grid-cols-4 grid-rows-2 gap-4">

        <!-- CATEGORY -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl',
            'class' => 'rounded-md shadow-md px-3 py-2 text-primary',
            'name' => 'category',
            'placeHolder' => __('Category', 'NlsHunter'),
            'options' => $categoryOptions,
            'clearAllButton' => true, // For single select
            'multiple' => true,
            'clearAllButtonClass' => 'hidden bg-primary text-white py-1 px-2 mx-1 border border-primary rounded-xl', // For single select
        ]) ?>

        <!-- SCOPE -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl',
            'class' => 'rounded-md shadow-md px-3 py-2 text-primary',
            'name' => 'scope',
            'placeHolder' => __('Scope', 'NlsHunter'),
            'options' => $scopeOptions,
            'clearAllButton' => true, // For single select
            'multiple' => true,
            'clearAllButtonClass' => 'hidden bg-primary text-white py-1 px-2 mx-1 border border-primary rounded-xl', // For single select
        ]) ?>

        <!-- LOCATION -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl',
            'class' => 'rounded-md shadow-md px-3 py-2 text-primary',
            'name' => 'region',
            'placeHolder' => __('Region', 'NlsHunter'),
            'options' => $locationOptions,
            'clearAllButton' => true, // For single select
            'multiple' => true,
            'clearAllButtonClass' => 'hidden bg-primary text-white py-1 px-2 mx-1 border border-primary rounded-xl', // For single select
        ]) ?>

        <!-- HYBRID -->
        <?= render('form/nlsSelectField', [
            'wrapperClass' => 'sumo text-xl',
            'class' => 'rounded-md shadow-md border-0 px-3 py-2 text-primary',
            'name' => 'hybrid',
            'placeHolder' => __('Hybrid', 'NlsHunter'),
            'options' => $hybridOptions,
            'clearAllButton' => true, // For single select
            'multiple' => true,
            'clearAllButtonClass' => 'hidden bg-primary text-white py-1 px-2 mx-1 border border-primary rounded-xl', // For single select
        ]) ?>

        <!-- KEYWORD -->
        <?= render('form/nlsInputField', [
            'wrapperClass' => 'col-span-3 text-xl',
            'class' => 'rounded-md shadow-md border-none placeholder-text px-3 py-2 text-primary w-full',
            'placeHolder' => __('Search by keyword', 'NlsHunter'),
            'name' => 'keyword',
            'autofocus' => false
        ]) ?>

        <!-- APPLY BUTTON -->
        <?= render('form/nlsApplyBtn', [
            'class' => 'rounded-md shadow-md px-3 py-2  w-full bg-gradient-to-b from-btn-s via-btn-m to-btn-e text-white font-bold text-xl',
            'text' => __('Search', 'NlsHunter')
        ]); ?>
    </div>
</form>