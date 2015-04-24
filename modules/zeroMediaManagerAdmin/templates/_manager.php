<?php use_javascript('/zeroMediaManagerPlugin/js/riot.js'); ?>
<?php use_javascript('/zeroMediaManagerPlugin/js/compiler.js'); ?>
<?php use_javascript('/zeroMediaManagerPlugin/js/riotcontrol.js'); ?>
<?php use_javascript('/zeroMediaManagerPlugin/js/dropzone.js'); ?>
<?php use_javascript('/zeroMediaManagerPlugin/js/mediamanager.js', 'last'); ?>
<?php use_stylesheet('/zeroMediaManagerPlugin/css/mediaManager.css'); ?>

<manager></manager>

<script src="/zeroMediaManagerPlugin/js/tags/mediaManager.tag" type="riot/tag"></script>
<input type="hidden" id="mediaManagerRemoteUrl" value="<?php echo url_for('@mediaManagerAdmin_remote', true); ?>" />
<input type="hidden" id="mediaManagerUploadUrl" value="<?php echo url_for('@mediaManagerAdmin_upload', true); ?>" />