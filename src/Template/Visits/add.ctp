<?php $this->assign('title', __('Book visit')); ?>
<?= $this->Html->css('jquery-ui', ['block' => true]) ?>
<?= $this->Html->css('jquery-ui-timepicker-addon.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery.browser.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/datepicker-hu', ['block' => true]) ?>
<?= $this->Html->script('vendor/jquery-ui-timepicker-addon.min', ['block' => true]) ?>
<?= $this->Html->script('vendor/notify.min', ['block' => true]) ?>
<?= $this->Html->script('visitors.add', ['block' => true]) ?>

<div class="small-12 columns">
    <?= $this->Form->create($visit, ['id' => 'order']) ?>
    <div id="open">
        <div class="row">
            <div class="column small-12">
                <?php $service = $services[1][0]; ?>
                <div class="input-group">
                    <i class="fi-calendar small-2"> </i>
                    <?= $this->Form->control(
                        'date',
                        [
                            'id' => 'datepicker', 'type' => 'text',
                            'label' => __('Date of visit'),
                            'placeholder' => __('Date of visit') ,
                            'autocomplete' => 'off'
                        ]
                    ) ?>
                </div>

                <div class="input-group">
                    <i class="fi-male small-2 column text-center"> </i>
                    <?= $this->Form->control(
                        'services.'.$service->id.'._joinData.full_price_members',
                        [
                            'label' =>
                            [
                                'text' => '<i class="fi-male" title="' . __('Full price') . '">'
                                . $this->Number->format($service->full_price) . ' Ft/fő</i>',
                                'class' => 'column',
                                'escape' => false
                            ],
                            'min' => 0,
                            'placeholder' => __('Full price') . ' (' . __('person') . ')',
                            'required' => false,
                            'templates' => ['inputContainer' => '{{content}}'],
                            'data-minutes' => $service->minutes,
                            'data-price-full' => $service->full_price,
                            'data-service' => $service->service
                        ]
                    ) ?>
                </div>

                <div class="input-group">
                    <i class="fi-universal-access small-2 column text-center"> </i>
                    <?= $this->Form->control(
                        'services.'.$service->id.'._joinData.discount_price_members',
                        [
                            'label' =>
                            [
                                'text' => '<i class="fi-universal-access" title="' . __('Discount price') . '">'
                                . $this->Number->format($service->discount_price) . ' Ft/fő</i>',
                                'class' => 'column',
                                'escape' => false
                            ],
                            'min' => 0,
                            'placeholder' => __('Discount price') . ' (' . __('person') . ')',
                            'required' => false,
                            'templates' => ['inputContainer' => '{{content}}'],
                            'data-minutes' => $service->minutes,
                            'data-price-discount' => $service->discount_price,
                            'data-service' => $service->service
                        ]
                    ) ?>
                </div>

                <?= $this->Form->hidden(
                    'services.'.$service->id.'.id',
                    ['value' => $service->id, 'class' => 'service-id']
                ) ?>
            </div>
        </div>

        <div class="row">
            <div class="column small-12">
                <div class="row align-center">
                    <?= $this->Html->image($service->id . '.jpg', ['class' => 'service-image']) ?>
                </div>
                <p><?= $service->description ?></p>
                <p><i class="fi-clock"> <?= $service->minutes . ' ' . __('min') ?></i></p>
            </div>
        </div>
    </div>

    <div id="step-1">
        <div class="row">
            <div class="column small-12">
                <div class="row align-center align-middle">
                    <h2><i class="fi-megaphone"></i> <?= __('Services') ?></h2>
                </div>
            </div>

            <?php foreach ($services[2] as $i => $service): ?>
                <div class="column small-6">
                    <div class="service">
                        <h3><?= $service->service ?></h3>
                        <div class="service-data" data-id="<?= $service->id ?>" data-type-id="<?= $service->type ?>">
                            <?= $this->Form->hidden(
                                'services.'.$service->id.'.id',
                                ['value' => $service->id, 'class' => 'service-id']
                            ) ?>
                            <?= $this->Html->image($service->id . '.jpg') ?>
                            <div class="info">
                                <p class="description">
                                    <?= $service->description ?>
                                </p>
                                <i class="column fi-clock"> <?= $service->minutes . ' ' . __('min') ?></i>
                                <p data-id="<?= $service->id ?>" class="row text-center align-middle">
                                    <i class="column fi-male" title="<?= __('Full price') ?>">
                                        <?= $this->Number->format($service->full_price) . ' Ft' ?>
                                    </i>
                                    <i class="column fi-universal-access" title="<?= __('Discount price') ?>">
                                        <?= $this->Number->format($service->discount_price) . ' Ft' ?>
                                    </i>
                                </p>
                                <button type="button" class="button fi-check" data-id="<?= $service->id ?>"
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

    <div id="step-2">
        <div class="row">
            <div class="column small-12">
                <div class="row align-center align-middle">
                    <h2><i class="fi-paw"></i> <?= __('Special programs') ?></h2>
                </div>
            </div>

            <?php foreach ($services[3] as $i => $service): ?>
                <div class="column small-6">
                    <div class="service">
                        <h3><?= $service->service ?></h3>
                        <div class="service-data" data-id="<?= $service->id ?>" data-type-id="<?= $service->type ?>">
                            <?= $this->Form->hidden(
                                'services.'.$service->id.'.id',
                                ['value' => $service->id, 'class' => 'service-id']
                            ) ?>
                            <?= $this->Html->image($service->id . '.jpg') ?>
                            <div class="info">
                                <p class="description">
                                    <?= $service->description ?>
                                </p>
                                <i class="column fi-clock"> <?= $service->minutes . ' ' . __('min') ?></i>
                                <p data-id="<?= $service->id ?>" class="row text-center align-middle">
                                    <i class="column fi-male" title="<?= __('Full price') ?>">
                                        <?= $this->Number->format($service->full_price) . ' Ft' ?>
                                    </i>
                                    <i class="column fi-universal-access" title="<?= __('Discount price') ?>">
                                        <?= $this->Number->format($service->discount_price) . ' Ft' ?>
                                    </i>
                                </p>
                                <button type="button" class="button fi-check" data-id="<?= $service->id ?>"
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

    <div id="step-3">
        <div class="row">
            <div class="column small-12">
                <div class="row align-center align-middle">
                    <h2><i class="fi-ticket"></i> <?= __('Food') ?></h2>
                </div>
            </div>

            <?php foreach ($services[4] as $i => $service): ?>
                <div class="column small-6">
                    <div class="service">
                        <h3><?= $service->service ?></h3>
                        <div class="service-data" data-id="<?= $service->id ?>" data-type-id="<?= $service->type ?>">
                            <?= $this->Form->hidden(
                                'services.'.$service->id.'.id',
                                ['value' => $service->id, 'class' => 'service-id']
                            ) ?>
                            <?= $this->Html->image($service->id . '.jpg') ?>
                            <div class="info">
                                <p class="description">
                                    <?= $service->description ?>
                                </p>
                                <i class="column fi-clock"> <?= $service->minutes . ' ' . __('min') ?></i>
                                <p data-id="<?= $service->id ?>" class="row text-center align-middle">
                                    <i class="column fi-male" title="<?= __('Full price') ?>">
                                        <?= $this->Number->format($service->full_price) . ' Ft' ?>
                                    </i>
                                    <i class="column fi-universal-access" title="<?= __('Discount price') ?>">
                                        <?= $this->Number->format($service->discount_price) . ' Ft' ?>
                                    </i>
                                </p>
                                <button type="button" class="button fi-check" data-id="<?= $service->id ?>"
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

    <div id="step-4">
        <div class="row">
            <div class="column small-12">
                <div class="row align-center align-middle">
                    <h2><?= __('Total') ?></h2>
                </div>

                <div class="row">
                    <ul>
                        <li><i class="fi-calendar"></i><span id="vTotalDate">0</span></li>
                        <li><i class="fi-male"></i><span id="vTotalFullPerson">0</span></li>
                        <li><i class="fi-universal-access"></i><span id="vTotalDiscountPerson">0</span></li>
                        <li><i class="fi-clock"></i><span id="vTotalMinutes">0</span> perc</li>
                        <li><i class="fi-megaphone"></i><span id="vTotalService1">-</span></li>
                        <li><i class="fi-paw"></i><span id="vTotalService2">-</span></li>
                        <li><i class="fi-ticket"></i><span id="vTotalService3">-</span></li>
                        <li><i class="fi-shopping-cart"></i><span id="vTotalAmount">0</span> Ft</li>
                    </ul>
                </div>

                <div class="input-group">
                    <?= $this->Form->control(
                        'name',
                        [
                            'id' => 'name', 'type' => 'text',
                            'label' => __('Name'),
                            'placeholder' => __('Name') ,
                            'autocomplete' => 'off'
                        ]
                    ) ?>
                </div>

                <div class="input-group">
                    <?= $this->Form->control(
                        'phone',
                        [
                            'id' => 'phone', 'type' => 'text',
                            'label' => __('Phone'),
                            'placeholder' => __('Phone') ,
                            'autocomplete' => 'off'
                        ]
                    ) ?>
                </div>

                <div class="input-group">
                    <?= $this->Form->control(
                        'email',
                        [
                            'id' => 'email', 'type' => 'text',
                            'label' => __('Email'),
                            'placeholder' => __('Email') ,
                            'autocomplete' => 'off'
                        ]
                    ) ?>
                </div>

                <div class="input-group">
                    <?= $this->Form->button(
                        __('Order'),
                        [
                            'class' => 'button success cart extra',
                            'title' => __('Clik to order')
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>

</div>
