<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visit $visit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Visit'), ['action' => 'edit', $visit->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Visit'), ['action' => 'delete', $visit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $visit->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Visits'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Visit'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clubs'), ['controller' => 'Clubs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Club'), ['controller' => 'Clubs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="visits view large-9 medium-8 columns content">

    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Club') ?></th>
            <td><?= $visit->has('club') ? $this->Html->link($visit->club->name, ['controller' => 'Clubs', 'action' => 'view', $visit->club->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($visit->date->format('Y-m-d H:i:s')) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($visit->created->format('Y-m-d H:i:s')) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($visit->modified->format('Y-m-d H:i:s')) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Payed') ?></th>
            <td><?= $visit->payed ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Services') ?></h4>
        <?php if (!empty($visit->services_visits)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Service') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Minutes') ?></th>
                <th scope="col"><?= __('Full Price') ?></th>
                <th scope="col"><?= __('Full Price Members') ?></th>
                <th scope="col"><?= __('Discount Price') ?></th>
                <th scope="col"><?= __('Discount Price Members') ?></th>
            </tr>
            <?php $full_price = 0 ?>
            <?php foreach ($visit->services_visits as $servicesVisit): ?>
            <tr>
                <td><?= h($servicesVisit->service->service) ?></td>
                <td><?= h($servicesVisit->service->description) ?></td>
                <td><?= h($servicesVisit->service->minutes) ?></td>
                <td><?= h($servicesVisit->service->full_price) ?></td>
                <td><?= h($servicesVisit->full_price_members) ?></td>
                <td><?= h($servicesVisit->service->discount_price) ?></td>
                <td><?= h($servicesVisit->discount_price_members) ?></td>
            </tr>
            <?php $full_price+= $servicesVisit->service->full_price * $servicesVisit->full_price_members
                + $servicesVisit->service->discount_price * $servicesVisit->discount_price_members;
            ?>
            <?php endforeach; ?>
        </table>
            <b><?= __('Sum: ').$full_price.' Ft'?></b>
        <?php endif; ?>
    </div>
</div>
