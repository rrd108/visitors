<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Visit $visit
 */
?>
<?= $this->Html->css('jquery-ui.css') ?>
<?= $this->Html->script('vendor/jquery-ui.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/datepicker-hu', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui-timepicker-addon.min', ['block' => true]) ?>
<?= $this->Html->script('list-services', ['block' => true]) ?>
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
            echo $this->Form->control(__('Club'),['value' => $club->name, 'disabled']);
            echo $this->Form->label(__('Date'));
        ?>
        <input type="text" name="date" id="datepicker" value="<?= $visit->date->format("Y-m-d H:i:s") ?>">
        <table class="unstriped stack" id="addvisit">
            <thead>
            <tr>
                <th><?= __('Service') ?></th>
                <th><?= __('Full Price Members') ?></th>
                <th><?=__('Discount Price Members')?></th>
            </tr>
            </thead>
            <tbody id="services">
	        <?php foreach ($services as $service): ?>
                <tr>
			        <?= $this->Form->hidden('services.'.$service->id.'.id',['value' => $service->id]) ?>
                    <td><?= $service->service ?></td>
                    <td>
				        <?= $this->Form->control(
					        'services.'.$service->id.'._joinData.full_price_members',
					        [
					                'label' => false, 'default' => 0,
                                    'value' => ($service->servicesVisit != null) ?
                                        $service->servicesVisit->full_price_members : 0
                            ]
				        ) ?>
                    </td>
                    <td>
				        <?= $this->Form->control(
					        'services.'.$service->id.'._joinData.discount_price_members',
					        [
					                'label' => false, 'default' => 0,
					                'value' => ($service->servicesVisit != null) ?
						                $service->servicesVisit->discount_price_members : 0
                            ]
				        ) ?>
                    </td>
                </tr>
	        <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
    <?= $this->Form->button(__('Submit'),["class" => "button small","id"=>"submit"]) ?>
    <?= $this->Form->end() ?>
</div>
