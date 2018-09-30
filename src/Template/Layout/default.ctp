<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

	<?= $this->Html->css('foundation.min') ?>
    <?= $this->Html->css('base') ?>
	<?= $this->Html->css('foundation-icons') ?>
	<?= $this->Html->css('style') ?>

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
    <?= $this->Html->script('vendor/jquery.js') ?>
    <?= $this->Html->script('vendor/what-input.js') ?>
    <?= $this->Html->script('vendor/foundation.js') ?>
    <?= $this->fetch('script') ?>
</body>
</html>
