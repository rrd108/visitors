<?= $this->Html->css('jquery-ui') ?>
<?= $this->Html->css('jquery-ui-timepicker-addon.min') ?>
<?= $this->Html->script('vendor/jquery.browser.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/datepicker-hu', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui-timepicker-addon.min', ['block' => true]) ?>
<?= $this->Html->script('list-services', ['block' => true]) ?>
<div class="visits form large-12 columns content">
    <?= $this->Form->create($visit) ?>
    <fieldset>
        <legend><?= __('Add Visit') ?></legend>
        <?php
            if($clubs->count()) {
	            echo $this->Form->control('club_id', ['options' => $clubs]);
            } else {
                echo $this->Form->control('club.name',['label' => __('Club')]);
            }
            echo $this->Form->label('date',__('Date'));
        ?>
        <input type="text" name="date" id="datepicker" autocomplete="off">
        <ul id="services-list">
        <?php foreach ($services as $i => $service): ?>
            <?php if (($i % 3) == 0) : ?>
                <div class="row">
            <?php endif; ?>
            <li class="column large-4 small-12'?>">
                <h3><?= $service->service ?></h3>
                <div data-id="<?= $service->id ?>" class="service-data" data-type-id="<?= $service->type ?>">
                    <?= $this->Form->hidden('services.'.$service->id.'.id',
                        ['value' => $service->id, 'class' => 'service-id']
                    ) ?>
                    <?= $this->Html->image($service->id, ['class' => 'align-center']) ?>
                    <p><?= $service->description ?></p>
                    <span><?= $service->minutes . ' ' . __('minutes') ?></span>
                    <?php if($service->type == 1): ?>
                    <?= $this->Form->control(
                        'services.'.$service->id.'._joinData.full_price_members',
                            ['label' => __('Full price') . ' ' . $service->full_price . ' Ft',
                                'placeholder' => __('person')]
                    ) ?>
                    <?= $this->Form->control(
                            'services.'.$service->id.'._joinData.discount_price_members',
                            ['label' => __('Discount price') . ' ' . $service->full_price . ' Ft',
                                'placeholder' => __('person')]
                    ) ?>
                    <?php else: ?>
                        <br>
                        <span class="full-price" data-id="<?= $service->id ?>">
                            <?= __('Full price') . ' ' . $service->full_price . ' Ft' ?>
                        </span>
                        <br>
                        <span class="discount-price" data-id="<?= $service->id ?>">
                            <?= __('Discount price') . ' ' . $service->discount_price . ' Ft' ?>
                        </span>
                        <br>
                        <button type="button" class="button select-service" data-id="<?= $service->id ?>"
                        data-type-id="<?= $service->type ?>">
                            <?= __('Select') ?>
                        </button>
                    <?php endif; ?>
                </div>
            </li>
            <?php if (($i % 3) == 2) : ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['id' => 'send', 'class' => 'button small']) ?>
    <?= $this->Form->end() ?>
</div>
