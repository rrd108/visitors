<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServicesDay $servicesDay
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $servicesDay->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $servicesDay->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Services Days'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="servicesDays form large-9 medium-8 columns content">
    <?= $this->Form->create($servicesDay) ?>
    <fieldset>
        <legend><?= __('Edit Services Day') ?></legend>
        <?php
            echo $this->Form->control('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
