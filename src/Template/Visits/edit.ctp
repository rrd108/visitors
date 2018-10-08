<?= $this->Html->css( 'jquery-ui.css' ) ?>
<?= $this->Html->css( 'jquery-ui-timepicker-addon.min' ) ?>
<?= $this->Html->script( 'vendor/jquery-ui.min', [ 'block' => true ] ) ?>
<?= $this->Html->script( 'vendor/datepicker-hu', [ 'block' => true ] ) ?>
<?= $this->Html->script( 'vendor/jquery-ui-timepicker-addon.min', [ 'block' => true ] ) ?>
<script>
    var selectedIds = {};
    <?php
        foreach ($services as $service){
            if($service->type != 1 && $service->servicesVisit != null) {
                echo "selectedIds[".$service->type."]=".$service->id,";\n";
            }
        }
    ?>
</script>
<?= $this->Html->script( 'list-services', [ 'block' => true ] ) ?>
<div class="visits form large-12 columns content">
	<?= $this->Form->create( $visit ) ?>
    <fieldset>
        <legend><?= __( 'Edit Visit' ) ?></legend>
		<?php
		echo $this->Form->control( __( 'Club' ), [ 'value' => $club->name, 'disabled' ] );
		echo $this->Form->label( __( 'Date' ) );
		?>
        <input type="text"
               name="date"
               id="datepicker"
               disabled="disabled"
               value="<?= h( $visit->date->format( "Y-m-d H:i:s" ) ) ?>">
        <ul id="services-list">
			<?php foreach ( $services as $i => $service ): ?>
				<?php if ( ( $i % 4 ) == 0 ) : ?>
                    <div class="row">
				<?php endif; ?>
                <li class="column large-3 small-12">
                    <h3><?= $service->service ?></h3>
                    <div data-id="<?= $service->id ?>" class="service-data" data-type-id="<?= $service->type ?>">
						<?= $this->Form->hidden( 'services.' . $service->id . '.id',
							[ 'value' => $service->id, 'class' => 'service-id' ]
						) ?>
                        <p><?= $service->description ?></p>
                        <span><?= $service->minutes . ' ' . __( 'minutes' ) ?></span>
						<?php if ( $service->type == 1 ): ?>
							<?= $this->Form->control(
								'services.' . $service->id . '._joinData.full_price_members',
								[
									'label'       => __( 'Full price' ) . ' ' . $service->full_price . ' Ft',
									'placeholder' => __( 'person' ),
									'value'       => ( $service->servicesVisit != null ) ?
										$service->servicesVisit->full_price_members : ''
								]
							) ?>
							<?= $this->Form->control(
								'services.' . $service->id . '._joinData.discount_price_members',
								[
									'label'       => __( 'Discount price' ) . ' ' . $service->full_price . ' Ft',
									'placeholder' => __( 'person' ),
									'value'       => ( $service->servicesVisit != null ) ?
										$service->servicesVisit->discount_price_members : ''
								]
							) ?>
						<?php else: ?>
                            <br>
                            <span class="full-price" data-id="<?= $service->id ?>">
                            <?= __( 'Full price' ) . ' ' . $service->full_price . ' Ft' ?>
                            <?php
                                if ( $service->servicesVisit != null ) :
                            ?>
                                <?= $this->Form->hidden('services.' . $service->id . '._joinData.full_price_members',[
                                        'value' => $service->servicesVisit->full_price_members,
                                        'class' => 'full-price-hidden'
                                ]) ?>
                            <?php endif; ?>
                        </span>
                            <br>
                            <span class="discount-price" data-id="<?= $service->id ?>">
                            <?= __( 'Discount price' ) . ' ' . $service->discount_price . ' Ft' ?>
                            <?php
                            if ( $service->servicesVisit != null ) :
	                            ?>
	                            <?= $this->Form->hidden('services.' . $service->id . '._joinData.discount_price_members',[
	                            'value' => $service->servicesVisit->discount_price_members,
	                            'class' => 'discount-price-hidden',
	                            'data-type-id' => $service->type
                            ]) ?>
                            <?php endif; ?>
                        </span>
                            <br>
                            <button type="button" class="button select-service <?= ($service->servicesVisit != null ) ?
										'selected' : '' ?>" data-id="<?= $service->id ?>"
                                    data-type-id="<?= $service->type ?>">
								<?= __( 'Select' ) ?>
                            </button>
						<?php endif; ?>
                    </div>
                </li>
				<?php if ( ( $i % 4 ) == 3 ) : ?>
                    </div>
				<?php endif; ?>
			<?php endforeach; ?>
        </ul>
    </fieldset>
	<?= $this->Form->button( __( 'Submit' ), [ "class" => "button small", "id" => "send" ] ) ?>
	<?= $this->Form->end() ?>
</div>
