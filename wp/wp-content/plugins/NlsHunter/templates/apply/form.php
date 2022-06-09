<input type="hidden" name="job-code" value="<?= $jobCode ?>">

<!-- FULL NAME -->
<?= render('form/nlsInputField', [
    'wrapperClass' => 'mb-2',
    'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-1.5 text-primary w-full',
    'label' => __('Full Name', 'NlsHunter'),
    'labelClass' => 'text-base',
    'name' => 'fullname',
    'validators' => ['required'],
    'autofocus' => true
]) ?>

<!-- Id -->
<?= render('form/nlsInputField', [
    'wrapperClass' => 'mb-2',
    'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-1.5 text-primary w-full',
    'label' => __('Id Number', 'NlsHunter'),
    'labelClass' => 'text-base',
    'name' => 'id',
    'validators' => ['required', 'ISRID'],
    'direction' => 'ltr'
]) ?>

<!-- email -->
<?= render('form/nlsInputField', [
    'wrapperClass' => 'mb-2',
    'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-1.5 text-primary w-full',
    'label' => __('Email', 'NlsHunter'),
    'labelClass' => 'text-base',
    'name' => 'email',
    'validators' => ['required', 'email'],
    'direction' => 'ltr'
]) ?>

<!-- Linked In -->
<?= render('form/nlsInputField', [
    'wrapperClass' => 'mb-2',
    'class' => 'rounded-md shadow-md border-none drop-shadow-md px-3 py-1.5 text-primary w-full',
    'label' => __('Linkedin Profile', 'NlsHunter'),
    'labelClass' => 'text-base',
    'name' => 'linkedin',
    'validators' => false,
    'direction' => 'ltr'
]) ?>

<!-- STUDY YEAR -->
<?= render('form/nlsSelectField', [
    'wrapperClass' => 'sumo text-xl col-span-2 sm:col-span-1',
    'class' => 'rounded-md shadow-md border-0 px-3 py-1.5 text-primary',
    'name' => 'study-year',
    'label' => __('Study Year', 'NlsHunter'),
    'labelClass' => 'text-base',
    'placeHolder' => __('Select', 'NlsHunter'),
    'options' => $studyYearOptions,
    'required' => true,
    'multiple' => false,
]) ?>

<!--  CV FILE -->
<?= render('form/nlsFileField', [
    'wrapperClass' => 'w-full mb-4 text-xl',
    'label' => __('Upload CV', 'NlsHunter'),
    'labelClass' => 'text-base',
    'name' => 'cv-file',
    'buttonText' => __('Select File', 'NlsHunter'),
    'accept' => '.txt, .pdf, .doc, .docx, .rtf',
    'buttonClass' => 'px-3 py-2 w-32 border border-btn-file bg-btn-file rounded-l-md text-white text-base shadow-md drop-shadow-md whitespace-nowrap',
    'textClass' => 'w-full py-1.5 px-3 rounded-r-md shadow-md drop-shadow-md',
    'pickerClass' => '',
    'mode' => 'button',
    'iconSrc' => plugins_url('NlsHunter/public/images/checkmark.png'),
    'iconClass' => 'h-6 hidden',
    'direction' => 'ltr',
    'validators' => []
]) ?>

<!--  CV FILE -->
<?= render('form/nlsFileField', [
    'wrapperClass' => 'w-full mb-4 text-xl',
    'label' => __('Another Document (Score sheet/Certificate)', 'NlsHunter'),
    'labelClass' => 'text-base',
    'name' => 'additional-file',
    'buttonText' => __('Select File', 'NlsHunter'),
    'accept' => '.txt, .pdf, .doc, .docx, .rtf',
    'buttonClass' => 'px-3 py-2 w-32 border border-btn-file bg-btn-file rounded-l-md text-white text-base shadow-md drop-shadow-md whitespace-nowrap',
    'textClass' => 'w-full py-1.5 px-3 rounded-r-md shadow-md drop-shadow-md',
    'pickerClass' => '',
    'mode' => 'button',
    'iconSrc' => plugins_url('NlsHunter/public/images/checkmark.png'),
    'iconClass' => 'h-6 hidden',
    'direction' => 'ltr',
    'validators' => []
]) ?>

<!--  Approval -->
<?= render('form/nlsCheckbox', [
    'wrapperClass' => 'w-full mb-4 text-xl',
    'label' => __('I approve the terms of use and policy.', 'NlsHunter'),
    'name' => 'approval',
    'class' => 'scale-150 mx-1',
    'validators' => ['checked']
]) ?>