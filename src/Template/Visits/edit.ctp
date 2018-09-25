<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visit $visit
 */
?>
<?= $this->Html->css('jquery-ui.css') ?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $visit->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $visit->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Visits'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clubs'), ['controller' => 'Clubs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Club'), ['controller' => 'Clubs', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="visits form large-9 medium-8 columns content">
    <?= $this->Form->create($visit) ?>
    <fieldset>
        <legend><?= __('Edit Visit') ?></legend>
        <?php
            echo $this->Form->control('club_id', ['options' => $clubs]);
            echo $this->Form->label(__('Date'));
        ?>
        <input type="text" name="date" id="datepicker">
        <table>
            <thead>
            <tr>
                <th><?= __('Service') ?></th>
                <th><?= __('Full Price Members') ?></th>
                <th><?=__('Discount Price Members')?></th>
                <th>Add more</th>
            </tr>
            </thead>
            <tbody id="services">
            </tbody>
        </table>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?= $this->Html->script('vendor/jquery-ui.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/datepicker-hu', ['block' => true]) ?>
<?= $this->Html->script('list-services', ['block' => true]) ?>
