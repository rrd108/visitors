<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServicesDay $servicesDay
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Services Day'), ['action' => 'edit', $servicesDay->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Services Day'), ['action' => 'delete', $servicesDay->id], ['confirm' => __('Are you sure you want to delete # {0}?', $servicesDay->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Services Days'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Services Day'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="servicesDays view large-9 medium-8 columns content">
    <h3><?= h($servicesDay->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($servicesDay->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($servicesDay->date) ?></td>
        </tr>
    </table>
</div>
