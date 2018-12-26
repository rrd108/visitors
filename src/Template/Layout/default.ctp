<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css("https://fonts.googleapis.com/css?family=Quicksand") ?>
	<?= $this->Html->css(['foundation.min', 'foundation-icons', 'visitors']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <header><?= $this->element('header') ?></header>

    <?= $this->Flash->render() ?>
    <main class="container clearfix row">
        <?= $this->fetch('content') ?>
    </main>
    <footer></footer>
    <?= $this->Html->script(['vendor/jquery.js', 'vendor/what-input.js',
        'vendor/foundation.js', 'visitors']) ?>

    <?= $this->fetch('script') ?>
</body>
</html>
