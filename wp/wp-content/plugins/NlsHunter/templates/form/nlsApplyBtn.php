<?php

/**
 * @text
 * @class
 * @prepend
 * @append
 * @iconSize
 */
?>

<div class="nls-field button <?= isset($wrapperClass) ? $wrapperClass : '' ?>">
    <button type="submit" class="<?= isset($class) ? $class : '' ?>"><?= isset($text) ? $text : __('Submit', 'NlsHunter') ?></button>
    <div class="help-block text-small text-red-400 min-h-[21px]"></div>
</div>