<section class="search alignfull relative py-8 w-full mt-0">
    <?php if (key_exists('bg_image', $atts) && $atts['bg_image'] === "1") : ?>
        <img width="1920" height="504" class="absolute z-10 top-0 left-0 bottom-0 m-0 p-0 w-full h-full object-cover" alt="" src="<?= NLS__PLUGIN_URL ?>/public/images/search@3x.jpg" data-object-fit="cover" srcset="<?= NLS__PLUGIN_URL ?>/public/images/search@3x.jpg 1920w, <?= NLS__PLUGIN_URL ?>/public/images/search.jpg 300w, <?= NLS__PLUGIN_URL ?>/public/images/search@2x.jpg 1024w, <?= NLS__PLUGIN_URL ?>/public/images/search.jpg 768w, <?= NLS__PLUGIN_URL ?>/public/images/search@2x.jpg 1536w" sizes="(max-width: 1920px) 100vw, 1920px">
    <?php endif; ?>

    <div class="container w-full <?= key_exists('overlay_color', $atts) ? 'bg-[' . $atts['overlay_color'] . ']' : 'bg-[#fff]'  ?> bg-opacity-90 mx-auto hadow-md relative z-20">
        <?= render('search/form', [
            'categoryOptions' => $categoryOptions,
            'scopeOptions' =>  $scopeOptions,
            'locationOptions' => $locationOptions,
            'employmentType' =>  $employmentType,
            'searchResultsUrl' => $searchResultsUrl,
            'searchParams' => $searchParams,
            'atts' => $atts
        ])
        ?>
    </div>
</section>