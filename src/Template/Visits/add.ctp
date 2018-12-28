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
                    <h4>Megrendelés</h4>
                    <dl class="service" id="summary">
                        <dt class="b">Összesen: 0 Ft</dt>
                    </dl>

                    <?= $this->Form->button(
                        'Megrendelem',
                        ['id' => 'send', 'class' => 'button']
                    ) ?>

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
                        [
                            'label' => __('Full price') . ' ' . $service->full_price . ' Ft',
                            'placeholder' => __('person'),
                            'data-minutes' => $service->minutes,
                            'data-price-full' => $service->full_price,
                            'data-service' => $service->service
                        ]
                    ) ?>
                    <?= $this->Form->control(
                        'services.'.$service->id.'._joinData.discount_price_members',
                        [
                            'label' => __('Discount price') . ' ' . $service->discount_price . ' Ft',
                            'placeholder' => __('person'),
                            'data-minutes' => $service->minutes,
                            'data-price-discount' => $service->discount_price,
                            'data-service' => $service->service
                        ]
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
                                    data-id="<?= $service->id ?>"
                                    data-minutes="<?= $service->minutes ?>"
                                    data-type-id="<?= $service->type ?>"
                                    data-price-full="<?= $service->full_price ?>"
                                    data-price-discount="<?= $service->discount_price ?>"
                                    data-service="<?= $service->service ?>">
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
                                data-type-id="<?= $service->type ?>"
                                data-minutes="<?= $service->minutes ?>"
                                data-price-full="<?= $service->full_price ?>"
                                data-price-discount="<?= $service->discount_price ?>"
                                data-service="<?= $service->service ?>">
                                Kérem
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <h2>Szolgáltatások</h2>
            <div class="row">
            <?php foreach ($services[4] as $i => $service): ?>
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
                                data-type-id="<?= $service->type ?>"
                                data-minutes="<?= $service->minutes ?>"
                                data-price-full="<?= $service->full_price ?>"
                                data-price-discount="<?= $service->discount_price ?>"
                                data-service="<?= $service->service ?>">
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
