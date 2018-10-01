<?= $this->Html->css('jquery-ui.css') ?>
<?= $this->Html->css('jquery-ui-timepicker-addon.min') ?>
<?= $this->Html->script('vendor/jquery-ui.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/datepicker-hu', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui-timepicker-addon.min', ['block' => true]) ?>
<?= $this->Html->script('list-services', ['block' => true]) ?>
<div class="visits form large-12 columns content">
    <?= $this->Form->create($visit) ?>
    <fieldset>
        <legend><?= __('Edit Visit') ?></legend>
        <?php
            echo $this->Form->control(__('Club'),['value' => $club->name, 'disabled']);
            echo $this->Form->label(__('Date'));
        ?>
        <input type="text" name="date" id="datepicker" value="<?= $visit->date->format("Y-m-d H:i:s") ?>">
        <ul id="services-list">
		    <?php foreach ($services as $i => $service): ?>
			    <?php if (($i % 4) == 0) : ?>
                    <div class="row">
			    <?php endif; ?>
                <li class="column large-3 small-12">
                    <h3><?= $service->service ?></h3>
                    <div>
					    <?= $this->Form->hidden('services.'.$service->id.'.id',['value' => $service->id]) ?>
                        <p><?= $service->description ?></p>
                        <span><?= $service->minutes . ' ' . __('minutes') ?></span>
					    <?= $this->Form->control(
						    'services.'.$service->id.'._joinData.full_price_members',
						    ['label' => __('Full price') . ' ' . $service->full_price . ' Ft',
						     'placeholder' => __('person'),
						     'value' => ($service->servicesVisit != null) ?
							     $service->servicesVisit->full_price_members : 0]
					    ) ?>
					    <?= $this->Form->control(
						    'services.'.$service->id.'._joinData.discount_price_members',
						    ['label' => __('Discount price') . ' ' . $service->full_price . ' Ft',
						     'placeholder' => __('person'),
						     'value' => ($service->servicesVisit != null) ?
							     $service->servicesVisit->discount_price_members : 0]
					    ) ?>
                    </div>
                </li>
			    <?php if (($i % 4) == 3) : ?>
                    </div>
			    <?php endif; ?>
		    <?php endforeach; ?>
        </ul>
    </fieldset>
    <?= $this->Form->button(__('Submit'),["class" => "button small","id"=>"submit"]) ?>
    <?= $this->Form->end() ?>
</div>
