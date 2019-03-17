<?php

$this->assign('title', __('Book visit')); ?>

<?= $this->Html->css('jquery-ui') ?>
<?= $this->Html->css('jquery-ui-timepicker-addon.min') ?>
<?= $this->Html->script('vendor/jquery.browser.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/datepicker-hu', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui-timepicker-addon.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/notify.min', ['block' => true]) ?>
<?= $this->Html->script('visitors.add', ['block' => true]) ?>

<div class="visits form large-12 columns content">
    <?= $this->Form->create($visit, ['id' => 'order']) ?>
    <?= $this->Form->button(
        __('Order'),
        [
            'class' => 'button success cart extra',
            'title' => __('Clik to order')
        ]
    ) ?>
    <div class="row">
        <div class="column main">
            <div class="row">
                <div class="column small-12 cart text-center extra">
                    <i class="fi-shopping-cart"></i>
                </div>
                <div id="cart" class="column small-12 cart">
                    <h4>
                        <?= __('Visit summary') ?>
                    </h4>
                    <dl class="column small-12" id="summary">
                        <dt class="b">
                            <?= __('Total') ?>: 0 Ft</dt>
                    </dl>
                </div>

                <div class="column small-12">
                    <?php $service = $services[1][0]; ?>
                    <h2>
                        <?= $service->service ?>
                    </h2>
                    <div class="service-main">
                        <div class="service-data info">
                            <?php
                            /* if($clubs->count()) {
                                echo $this->Form->control('club_id', ['options' => $clubs]);
                            } else {
                                echo $this->Form->control('club.name',['label' => __('Club')]);
                            } */
                            ?>
                            <div class="input-group">
                                <i class="fi-calendar"> </i>
                            <?= $this->Form->control('date',
                                ['id' => 'datepicker', 'type' => 'text',
                                    'label' => __('Date of visit'),
                                    'placeholder' => __('Látogatás dátuma') ,
                                    'autocomplete' => 'off']) ?>
                            </div>
                            <div class="input-group">
                                <i class="fi-male"> </i>
                                <?= $this->Form->control(
                                'services.'.$service->id.'._joinData.full_price_members',
                                [
                                    'label' =>
                                        [
                                            'text' => '<i class="fi-male" title="' . __('Full price') . '">'
                                                . $this->Number->format($service->full_price) . ' Ft/fő</i>',
                                            'class' => 'column large-8',
                                            'escape' => false
                                        ],
                                    'placeholder' => __('Felnőtt') . ' (' . __('fő') . ')',
                                    'required' => false,
                                    'templates' => ['inputContainer' => '{{content}}'],
                                    'data-minutes' => $service->minutes,
                                    'data-price-full' => $service->full_price,
                                    'data-service' => $service->service
                                ]
                            ) ?>
                            </div>
                            <div class="input-group">
                                <i class="fi-universal-access" style="font-size: 50px; position: relative; bottom:20px; right:5px;"> </i>
                                <?= $this->Form->control(
                                'services.'.$service->id.'._joinData.discount_price_members',
                                [
                                    'label' =>
                                        [
                                            'text' => '<i class="fi-universal-access" title="' . __('Discount price') . '">'
                                                . $this->Number->format($service->discount_price) . ' Ft/fő</i>',
                                            'class' => 'column large-8',
                                            'escape' => false
                                        ],
                                    'placeholder' => __('Diák, Nyugdíjas') . ' (' . __('fő') . ')',
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

                            <p>
                                <?= $service->minutes . ' ' . __('min') ?>
                            </p>
                            <div class="row align-center">
                                <?= $this->Html->image($service->id . '.jpg') ?>
                            </div>
                            <p>
                                <?= $service->description ?>
                            </p>
                            <button id="main-service" type="button" class="button warning">
                                <?= __('Continue') ?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="extra hide">
                <h2>
                    <?= __('Services') ?>
                </h2>
                <div class="row">
                    <?php foreach ($services[4] as $i => $service): ?>
                    <div class="column small-12">
                        <div class="service">
                            <h3>
                                <span class="row align-justify">
                                    <span class="column large-10">
                                        <?= $service->service ?></span>
                                    <span class="column large-2 min">
                                        <?= $service->minutes . ' ' . __('min') ?></span>
                                </span>
                            </h3>
                            <div class="service-data" data-id="<?= $service->id ?>" data-type-id="<?= $service->type ?>">
                                <?= $this->Form->hidden('services.'.$service->id.'.id',
                                        ['value' => $service->id, 'class' => 'service-id']
                                    ) ?>
                                <div class="row align-center">
                                    <?= $this->Html->image($service->id . '.jpg') ?>
                                </div>
                                <div class="info">
                                    <p>
                                        <?= $service->description ?>
                                    </p>
                                    <p data-id="<?= $service->id ?>" class="row text-center align-middle">
                                        <i class="column fi-male" title="<?= __('Full price') ?>">
                                            <?= $this->Number->format($service->full_price) . ' Ft' ?>
                                        </i>
                                        <i class="column fi-universal-access" title="<?= __('Discount price') ?>">
                                            <?= $this->Number->format($service->discount_price) . ' Ft' ?>
                                        </i>
                                    </p>
                                    <button type="button" class="button select-service fi-check" data-id="<?= $service->id ?>"
                                            data-type-id="<?= $service->type ?>" data-minutes="<?= $service->minutes ?>"
                                            data-price-full="<?= $service->full_price ?>" data-price-discount="<?= $service->discount_price ?>"
                                            data-service="<?= $service->service ?>">
                                        <?= __('Add to cart') ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="column large-6 bg small-12 extra hide">
            <h2>
                <?= __('Special programs') ?>
            </h2>
            <div class="row">
                <?php foreach ($services[2] as $i => $service): ?>
                <div class="column large-6 small-12">
                    <div class="service">
                        <h3>
                            <span class="row align-justify">
                                <span class="column large-10">
                                    <?= $service->service ?></span>
                                <span class="column large-2 min">
                                    <?= $service->minutes . ' ' . __('min') ?></span>
                            </span>
                        </h3>
                        <div class="service-data" data-id="<?= $service->id ?>" data-type-id="<?= $service->type ?>">
                            <?= $this->Form->hidden('services.'.$service->id.'.id',
                                ['value' => $service->id, 'class' => 'service-id']
                            ) ?>
                            <div class="row align-center">
                                <?= $this->Html->image($service->id . '.jpg') ?>
                            </div>
                            <div class="info">
                                <p>
                                    <?= $service->description ?>
                                </p>
                                <p data-id="<?= $service->id ?>" class="row text-center">
                                    <i class="column fi-male" title="<?= __('Full price') ?>">
                                        <?= $this->Number->format($service->full_price) . ' Ft' ?>
                                    </i>
                                    <i class="column fi-universal-access" title="<?= __('Discount price') ?>">
                                        <?= $this->Number->format($service->discount_price) . ' Ft' ?>
                                    </i>
                                </p>
                                <button type="button" class="button select-service fi-check" data-id="<?= $service->id ?>"
                                        data-minutes="<?= $service->minutes ?>" data-type-id="<?= $service->type ?>"
                                        data-price-full="<?= $service->full_price ?>" data-price-discount="<?= $service->discount_price ?>"
                                        data-service="<?= $service->service ?>">
                                    <?= __('Add to cart') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="column large-3 small-12 extra hide">
            <h2>
                <?= __('Food') ?>
            </h2>
            <div class="row">
                <?php foreach ($services[3] as $i => $service): ?>
                <div class="column small-12">
                    <div class="service">
                        <h3>
                            <span class="row align-justify">
                                <span class="column large-10">
                                    <?= $service->service ?></span>
                                <span class="column large-2 min">
                                    <?= $service->minutes . ' ' . __('min') ?></span>
                            </span>
                        </h3>
                        <div class="service-data" data-id="<?= $service->id ?>" data-type-id="<?= $service->type ?>">
                            <?= $this->Form->hidden('services.'.$service->id.'.id',
                                ['value' => $service->id, 'class' => 'service-id']
                            ) ?>
                            <div class="row align-center">
                                <?= $this->Html->image($service->id . '.jpg') ?>
                            </div>
                            <div class="info">
                                <p>
                                    <?= $service->description ?>
                                </p>
                                <p data-id="<?= $service->id ?>" class="row text-center">
                                    <i class="column fi-male" title="<?= __('Full price') ?>">
                                        <?= $this->Number->format($service->full_price) . ' Ft' ?>
                                    </i>
                                    <i class="column fi-universal-access" title="<?= __('Discount price') ?>">
                                        <?= $this->Number->format($service->discount_price) . ' Ft' ?>
                                    </i>
                                </p>
                                <button type="button" class="button select-service fi-check" data-id="<?= $service->id ?>"
                                        data-type-id="<?= $service->type ?>" data-minutes="<?= $service->minutes ?>"
                                        data-price-full="<?= $service->full_price ?>" data-price-discount="<?= $service->discount_price ?>"
                                        data-service="<?= $service->service ?>">
                                    <?= __('Add to cart') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>