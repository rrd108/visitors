<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visit $visit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
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
        <legend><?= __('Add Visit') ?></legend>
        <?php
            echo $this->Form->control('club_id', ['options' => $clubs]);
            echo $this->Form->label('date',__('Date'));
            echo $this->Form->date('date',[
	            'minYear' => 2018,
	            'empty' => [
		            'year' => false,
		            'month' => false,
                    'day' => false
	            ],
            ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
