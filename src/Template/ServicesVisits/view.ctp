<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServicesVisit $servicesVisit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Services Visit'), ['action' => 'edit', $servicesVisit->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Services Visit'), ['action' => 'delete', $servicesVisit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $servicesVisit->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Services Visits'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Services Visit'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Visits'), ['controller' => 'Visits', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Visit'), ['controller' => 'Visits', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="servicesVisits view large-9 medium-8 columns content">
    <h3><?= h($servicesVisit->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Service') ?></th>
            <td><?= $servicesVisit->has('service') ? $this->Html->link($servicesVisit->service->id, ['controller' => 'Services', 'action' => 'view', $servicesVisit->service->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Visit') ?></th>
            <td><?= $servicesVisit->has('visit') ? $this->Html->link($servicesVisit->visit->id, ['controller' => 'Visits', 'action' => 'view', $servicesVisit->visit->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($servicesVisit->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Full Price Members') ?></th>
            <td><?= $this->Number->format($servicesVisit->full_price_members) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Discount Price Members') ?></th>
            <td><?= $this->Number->format($servicesVisit->discount_price_members) ?></td>
        </tr>
    </table>
</div>
