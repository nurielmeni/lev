<input type="hidden" name="job-code" value="<?= $jobCode ?>">

<!-- FULL NAME -->
<?= render('form/nlsInputField', [
    'wrapperClass' => 'mb-2',
    'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-1.5 text-primary md:text-xl w-full',
    'label' => __('Full Name', 'NlsHunter'),
    'name' => 'fullname',
    'validators' => ['required'],
    'autofocus' => true
]) ?>

<!-- Id -->
<?= render('form/nlsInputField', [
    'wrapperClass' => 'mb-2',
    'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-1.5 text-primary md:text-xl w-full',
    'label' => __('Id Number', 'NlsHunter'),
    'name' => 'id',
    'validators' => ['required', 'ISRID'],
    'autofocus' => false
]) ?>

<!-- email -->
<?= render('form/nlsInputField', [
    'wrapperClass' => 'mb-2',
    'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-1.5 text-primary md:text-xl w-full',
    'label' => __('Email', 'NlsHunter'),
    'name' => 'email',
    'validators' => ['required', 'email'],
    'autofocus' => false
]) ?>

<!-- Linked In -->
<?= render('form/nlsInputField', [
    'wrapperClass' => 'mb-2',
    'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-1.5 text-primary md:text-xl w-full',
    'label' => __('Linkedin Profile', 'NlsHunter'),
    'name' => 'linkedin',
    'validators' => false,
    'autofocus' => false
]) ?>

<!-- STUDY YEAR -->
<?= render('form/nlsSelectField', [
    'wrapperClass' => 'sumo text-xl col-span-2 sm:col-span-1',
    'class' => 'rounded-md shadow-md border-0 px-3 py-1.5 text-primary md:text-xl',
    'name' => 'study-year',
    'label' => __('Study Year', 'NlsHunter'),
    'placeHolder' => __('Select', 'NlsHunter'),
    'labelClass' => 'text-base',
    'options' => $studyYearOptions,
    'required' => true,
    'multiple' => false,
]) ?>