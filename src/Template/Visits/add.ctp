<?php $this->assign('title', __('Book visit')); ?>

<?= $this->Html->css('jquery-ui') ?>
<?= $this->Html->css('jquery-ui-timepicker-addon.min') ?>
<?= $this->Html->script('vendor/jquery.browser.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/datepicker-hu', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui-timepicker-addon.min', ['block' => true]) ?>
<?= $this->Html->script('visitors.add', ['block' => true]) ?>

<div class="visits form large-12 columns content">
    <?= $this->Form->create($visit, ['id' => 'order']) ?>
    <?= $this->Form->button(
        'Megrendelem',
        [
            'class' => 'button success',
            'title' => 'Kattints a megrendeléshez'
        ]
    ) ?>
    <div class="row">
        <div class="column large-3 small-12">
            <div class="row">
                <div id="cart" class="column small-12">
                    <h4>Látogatás összesítő</h4>
                    <dl class="column small-12" id="summary">
                        <dt class="b">Összesen: 0 Ft</dt>
                    </dl>
                </div>

                <div class="column small-12">
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
                            <?= $this->Form->control('date',
                                ['id' => 'datepicker', 'type' => 'text',
                                    'label' => __('Date of visit'),
                                    'autocomplete' => 'off']) ?>

                            <div class="input-group">
                            <?= $this->Form->control(
                                'services.'.$service->id.'._joinData.full_price_members',
                                [
                                    'label' =>
                                        [
                                            'text' => __('Full price') . ' '
                                                . $this->Number->format($service->full_price) . ' Ft/fő',
                                            'class' => 'column large-8'
                                        ],
                                    'placeholder' => __('person'),
                                    'required' => false,
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'data-minutes' => $service->minutes,
                                    'data-price-full' => $service->full_price,
                                    'data-service' => $service->service
                                ]
                            ) ?>
                            </div>
                            <div class="input-group">
                            <?= $this->Form->control(
                                'services.'.$service->id.'._joinData.discount_price_members',
                                [
                                    'label' =>
                                        [
                                            'text' => __('Discount price') . ' '
                                                . $this->Number->format($service->discount_price) . ' Ft/fő',
                                            'class' => 'column large-8'
                                        ],
                                    'placeholder' => __('person'),
                                    'required' => false,
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'data-minutes' => $service->minutes,
                                    'data-price-discount' => $service->discount_price,
                                    'data-service' => $service->service
                                ]
                            ) ?>
                            </div>

                            <?= $this->Form->hidden('services.'.$service->id.'.id',
                                ['value' => $service->id, 'class' => 'service-id']
                            ) ?>
                            <div class="row align-center">
                                <?= $this->Html->image($service->id) ?>
                            </div>
                            <p><?= $service->description ?></p>
                            <p><?= $service->minutes . ' ' . __('minutes') ?></p>
                        </div>
                    </div>
                </div>
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
                                <div class="row align-center">
                                    <?= $this->Html->image($service->id) ?>
                                </div>
                                <p><?= $service->description ?></p>
                                <p><?= $service->minutes . ' ' . __('minutes') ?></p>
                                <p data-id="<?= $service->id ?>">
                                    <?= __('Full price') . ' '
                                        . $this->Number->format($service->full_price) . ' Ft' ?>
                                    /
                                    <?= __('Discount price') . ' '
                                        . $this->Number->format($service->discount_price) . ' Ft' ?>
                                </p>
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
                            <div class="row align-center">
                                <?= $this->Html->image($service->id) ?>
                            </div>
                            <div class="info">
                                <p><?= $service->description ?></p>
                                <p><?= $service->minutes . ' ' . __('minutes') ?></p>
                                <p data-id="<?= $service->id ?>">
                                    <?= __('Full price') . ' '
                                        . $this->Number->format($service->full_price) . ' Ft' ?>
                                    /
                                    <?= __('Discount price') . ' '
                                        . $this->Number->format($service->discount_price) . ' Ft' ?>
                                </p>
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
                            <div class="row align-center">
                                <?= $this->Html->image($service->id) ?>
                            </div>
                            <p><?= $service->description ?></p>
                            <p><?= $service->minutes . ' ' . __('minutes') ?></p>
                            <p data-id="<?= $service->id ?>">
                                <?= __('Full price') . ' '
                                    . $this->Number->format($service->full_price) . ' Ft' ?>
                                /
                                <?= __('Discount price') . ' '
                                    . $this->Number->format($service->discount_price) . ' Ft' ?>
                            </p>
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
