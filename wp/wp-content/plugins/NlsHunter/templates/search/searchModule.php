<section class="search relative py-8 w-full alignfull mt-0">
    <img width="1920" height="504" class="absolute z-10 top-0 left-0 bottom-0 m-0 p-0 w-full h-full object-cover" alt="" src="<?= NLS__PLUGIN_URL ?>/public/images/search@3x.jpg" data-object-fit="cover" srcset="<?= NLS__PLUGIN_URL ?>/public/images/search@3x.jpg 1920w, <?= NLS__PLUGIN_URL ?>/public/images/search.jpg 300w, <?= NLS__PLUGIN_URL ?>/public/images/search@2x.jpg 1024w, <?= NLS__PLUGIN_URL ?>/public/images/search.jpg 768w, <?= NLS__PLUGIN_URL ?>/public/images/search@2x.jpg 1536w" sizes="(max-width: 1920px) 100vw, 1920px">
    <div class="container w-full bg-white bg-opacity-90 mx-auto shadow-md relative z-20">
        <?= render('search/form', [
            'categoryOptions' => $categoryOptions,
            'scopeOptions' =>  $scopeOptions,
            'locationOptions' => $locationOptions,
            'hybridOptions' =>  $hybridOptions
        ])
        ?>
    </div>
</section>