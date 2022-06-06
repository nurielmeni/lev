<form action="" class="p-6 md:p-20 bg-gray">
    <input type="hidden" name="job-code" value="<?= $jobCode ?>">

    <!-- FULL NAME -->
    <?= render('form/nlsInputField', [
        'wrapperClass' => 'mb-5',
        'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-2 text-primary md:text-xl w-full',
        'label' => __('Full Name', 'NlsHunter'),
        'name' => 'fullname',
        'validators' => ['required'],
        'autofocus' => true
    ]) ?>

    <!-- Id -->
    <?= render('form/nlsInputField', [
        'wrapperClass' => 'mb-5',
        'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-2 text-primary md:text-xl w-full',
        'label' => __('Id Number', 'NlsHunter'),
        'name' => 'id',
        'validators' => ['required', 'ISRID'],
        'autofocus' => false
    ]) ?>

    <!-- email -->
    <?= render('form/nlsInputField', [
        'wrapperClass' => 'mb-5',
        'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-2 text-primary md:text-xl w-full',
        'label' => __('Email', 'NlsHunter'),
        'name' => 'email',
        'validators' => ['required', 'email'],
        'autofocus' => false
    ]) ?>

    <!-- Linked In -->
    <?= render('form/nlsInputField', [
        'wrapperClass' => 'mb-5',
        'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-2 text-primary md:text-xl w-full',
        'label' => __('Linkedin Profile', 'NlsHunter'),
        'name' => 'linkedin',
        'validators' => false,
        'autofocus' => false
    ]) ?>
</form>