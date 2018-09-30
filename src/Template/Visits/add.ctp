<?= $this->Html->css('jquery-ui.css') ?>
<?= $this->Html->css('jquery-ui-timepicker-addon.min.css') ?>
<?= $this->Html->script('vendor/jquery-ui.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/datepicker-hu', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui-timepicker-addon.min', ['block' => true]) ?>
<?= $this->Html->script('list-services', ['block' => true]) ?>
<div class="visits form large-12 columns content">
    <?= $this->Form->create($visit) ?>
    <fieldset>
        <legend><?= __('Add Visit') ?></legend>
        <?php
            echo $this->Form->control('club_id', ['options' => $clubs]);
            echo $this->Form->label('date',__('Date'));
        ?>
        <input type="text" name="date" id="datepicker">
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
                                'placeholder' => __('person')]
                    ) ?>
                    <?= $this->Form->control(
                            'services.'.$service->id.'._joinData.discount_price_members',
                            ['label' => __('Discount price') . ' ' . $service->full_price . ' Ft',
                                'placeholder' => __('person')]
                    ) ?>
                </div>
            </li>
            <?php if (($i % 4) == 3) : ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </ul>
    </fieldset>
    <?= $this->Form->button(__('Submit'),['id' => 'submit', 'class' => 'button small']) ?>
    <?= $this->Form->end() ?>
</div>
