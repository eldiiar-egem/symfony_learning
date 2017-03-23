<?php $view->extend('base.html.php') ?>

<?php $view['slots']->start('stylesheets') ?>
    <link href="<?php echo $view['assets']->getUrl('css/contact.css') ?>" rel="stylesheet" />
<?php $view['slots']->stop() ?>