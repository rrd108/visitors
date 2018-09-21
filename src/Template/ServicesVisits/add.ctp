<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ServicesVisit $servicesVisit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Services Visits'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Visits'), ['controller' => 'Visits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Visit'), ['controller' => 'Visits', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="servicesVisits form large-9 medium-8 columns content">
    <?= $this->Form->create($servicesVisit) ?>
    <fieldset>
        <legend><?= __('Add Services Visit') ?></legend>
        <?php
            echo $this->Form->control('service_id', ['options' => $services]);
            echo $this->Form->control('visit_id', ['options' => $visits]);
            echo $this->Form->control('full_price_members');
            echo $this->Form->control('discount_price_members');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
