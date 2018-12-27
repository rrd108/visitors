<?= $this->Html->css('jquery-ui') ?>
<?= $this->Html->css('jquery-ui-timepicker-addon.min') ?>
<?= $this->Html->script('vendor/jquery.browser.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/datepicker-hu', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui-timepicker-addon.min', ['block' => true]) ?>
<?= $this->Html->script('visitors.add', ['block' => true]) ?>

<div class="visits form large-12 columns content">
    <?= $this->Form->create($visit) ?>
    <div class="row">
        <div class="column large-3 small-12">
            <?php $service = $services[1][0]; ?>
            <h2><?= $service->service ?></h2>
            <div class="service-main">
                <div class="service-data">
                    <?php
                    if($clubs->count()) {
                        echo $this->Form->control('club_id', ['options' => $clubs]);
                    } else {
                        echo $this->Form->control('club.name',['label' => __('Club')]);
                    }
                    ?>
                    <?= $this->Form->control('date', ['id' => 'datepicker', 'type' => 'text', 'autocomplete' => 'off']) ?>

                    <?= $this->Form->hidden('services.'.$service->id.'.id',
                        ['value' => $service->id, 'class' => 'service-id']
                    ) ?>
                    <?= $this->Html->image($service->id, ['class' => 'align-center']) ?>
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

                    <p>A programok és az étkezés menüből választhat egyet-egyet.</p>

                    <h4>Megrendelés</h4>
                    <ul class="service">
                        <li>Teljes áru vendég: 5 fő * 2 590 Ft = 14 600 Ft</li>
                        <li>Teljes áru vendég: 5 fő * 2 590 Ft = 14 600 Ft</li>
                    </ul>

                    <?= $this->Form->button(
                        'Megrendelem',
                        ['id' => 'send', 'class' => 'button']
                    ) ?>
                </div>
            </div>
        </div>
        <div class="column large-6 bg small-12">
            <h2>Különleges programok</h2>
            <div class="row">
            <?php foreach ($services[2] as $i => $service): ?>
                <div class="column large-6 small-12">
                    <div class="service">
                        <h3><?= $service->service ?></h3>
                        <div class="service-data" data-id="<?= $service->id ?>" data-type-id="<?= $service->type ?>">
                            <?= $this->Form->hidden('services.'.$service->id.'.id',
                                ['value' => $service->id, 'class' => 'service-id']
                            ) ?>
                            <?= $this->Html->image($service->id, ['class' => 'align-center']) ?>
                            <div class="info">
                                <p><?= $service->description ?></p>
                                <p><?= $service->minutes . ' ' . __('minutes') ?></p>
                                <span class="full-price" data-id="<?= $service->id ?>">
                                    <?= __('Full price') . ' ' . $service->full_price . ' Ft' ?>
                                </span>
                                <br>
                                <span class="discount-price" data-id="<?= $service->id ?>">
                                    <?= __('Discount price') . ' ' . $service->discount_price . ' Ft' ?>
                                </span>
                                <br>
                                <button type="button" class="button select-service fi-check"
                                        data-id="<?= $service->id ?>" data-type-id="<?= $service->type ?>">
                                    Kérem
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
        <div class="column large-3 small-12">
            <h2>Étkezés</h2>
            <div class="row">
            <?php foreach ($services[3] as $i => $service): ?>
                <div class="column small-12">
                    <div class="service">
                        <h3><?= $service->service ?></h3>
                        <div class="service-data" data-id="<?= $service->id ?>" data-type-id="<?= $service->type ?>">
                            <?= $this->Form->hidden('services.'.$service->id.'.id',
                                ['value' => $service->id, 'class' => 'service-id']
                            ) ?>
                            <?= $this->Html->image($service->id, ['class' => 'align-center']) ?>
                            <p><?= $service->description ?></p>
                            <span><?= $service->minutes . ' ' . __('minutes') ?></span>
                            <span class="full-price" data-id="<?= $service->id ?>">
                                <?= __('Full price') . ' ' . $service->full_price . ' Ft' ?>
                            </span>
                            <br>
                            <span class="discount-price" data-id="<?= $service->id ?>">
                                <?= __('Discount price') . ' ' . $service->discount_price . ' Ft' ?>
                            </span>
                            <br>
                            <button type="button" class="button select-service fi-check" data-id="<?= $service->id ?>"
                                    data-type-id="<?= $service->type ?>">
                                Kérem
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
