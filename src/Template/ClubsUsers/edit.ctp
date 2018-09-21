<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClubsUser $clubsUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $clubsUser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $clubsUser->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Clubs Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clubs'), ['controller' => 'Clubs', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Club'), ['controller' => 'Clubs', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="clubsUsers form large-9 medium-8 columns content">
    <?= $this->Form->create($clubsUser) ?>
    <fieldset>
        <legend><?= __('Edit Clubs User') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('club_id', ['options' => $clubs]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
