<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

	<?= $this->Html->css(['foundation.min', 'foundation-icons', 'visitors']) ?>
    <?= $this->Html->script(['vendor/jquery.js', 'vendor/what-input.js', 'vendor/foundation.js']) ?>

    <?= $this->fetch('script') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <div class="top-bar-right right">
        <ul class="menu">
            <ul class="dropdown menu" data-dropdown-menu>
                <li><?= $this->User->welcome() ?></li>
                <li><?= $this->User->logout() ?></li>
            </ul>
        </ul>
    </div>
    <main class="container clearfix row">
        <?= $this->fetch('content') ?>
        <?= $this->Flash->render() ?>
    </main>
    <footer></footer>
</body>
</html>
