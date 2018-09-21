<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServicesVisit[]|\Cake\Collection\CollectionInterface $servicesVisits
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Services Visit'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Visits'), ['controller' => 'Visits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Visit'), ['controller' => 'Visits', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="servicesVisits index large-9 medium-8 columns content">
    <h3><?= __('Services Visits') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('service_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('visit_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('full_price_members') ?></th>
                <th scope="col"><?= $this->Paginator->sort('discount_price_members') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicesVisits as $servicesVisit): ?>
            <tr>
                <td><?= $this->Number->format($servicesVisit->id) ?></td>
                <td><?= $servicesVisit->has('service') ? $this->Html->link($servicesVisit->service->id, ['controller' => 'Services', 'action' => 'view', $servicesVisit->service->id]) : '' ?></td>
                <td><?= $servicesVisit->has('visit') ? $this->Html->link($servicesVisit->visit->id, ['controller' => 'Visits', 'action' => 'view', $servicesVisit->visit->id]) : '' ?></td>
                <td><?= $this->Number->format($servicesVisit->full_price_members) ?></td>
                <td><?= $this->Number->format($servicesVisit->discount_price_members) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $servicesVisit->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $servicesVisit->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $servicesVisit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $servicesVisit->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
