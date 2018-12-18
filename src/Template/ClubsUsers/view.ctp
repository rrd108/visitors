<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ClubsUser $clubsUser
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Clubs User'), ['action' => 'edit', $clubsUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Clubs User'), ['action' => 'delete', $clubsUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $clubsUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clubs Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Clubs User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clubs'), ['controller' => 'Clubs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Club'), ['controller' => 'Clubs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clubsUsers view large-9 medium-8 columns content">
    <h3><?= h($clubsUser->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $clubsUser->has('user') ? $this->Html->link($clubsUser->user->id, ['controller' => 'Users', 'action' => 'view', $clubsUser->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Club') ?></th>
            <td><?= $clubsUser->has('club') ? $this->Html->link($clubsUser->club->name, ['controller' => 'Clubs', 'action' => 'view', $clubsUser->club->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($clubsUser->id) ?></td>
        </tr>
    </table>
</div>
