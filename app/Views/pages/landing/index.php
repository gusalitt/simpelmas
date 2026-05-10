<?php view()::extend('layouts.landing'); ?>

<?php view()::push('content'); ?>
<!-- Home -->
<?php view()::include('pages.landing.sections.home'); ?>

<!-- Stats -->
<?php view()::include('pages.landing.sections.stats', compact('stats')); ?>

<!-- How It Works -->
<?php view()::include('pages.landing.sections.how_it_works'); ?>

<!-- Solution -->
<?php view()::include('pages.landing.sections.solution'); ?>

<!-- Feedback -->
<?php 
// view()::include('pages.landing.sections.feedback');
?>

<!-- FAQ -->
<?php view()::include('pages.landing.sections.faq'); ?>

<!-- CTA -->
<?php view()::include('pages.landing.sections.cta'); ?>
<?php view()::endPush('content'); ?>