<!-- app/Resources/views/blog/index.html.php -->
<?php $view->extend('base.html.php') ?>

<?php $view['slots']->set('title', 'My cool blog posts') ?>

<?php $view['slots']->start('body') ?>
<?php foreach ($blog_entries as $entry): ?>
    <h2><?php echo $entry->getTitle() ?></h2>
    <p><?php echo $entry->getBody() ?></p>
<?php endforeach ?>
<?php $view['slots']->stop() ?>