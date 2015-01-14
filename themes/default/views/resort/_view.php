<?php
/* @var $this ResortController */
/* @var $data Resort */
?>
<div class="span6">
    <div class="row" style="margin-bottom: 10px;">
        <div class="span2">
            <?php echo Resort::get_images($data->id); ?>       
        </div>	 
        <div class="span4">
            <div class="rerort_name"><?php echo $data->resort; ?></div>
            <p><span class="text-success"><strong>Location:</strong> <?php echo CHtml::link(Location::getLocation($data->location), array('location/view', 'id' => $data->location), array('target' => '_blank')); ?></span></p>
            <?php echo CHtml::link('Details', array('resort/view', 'id' => $data->id), array('class' => 'btn btn-primary btn-sm', 'target' => '_blank')); ?>
            <?php echo CHtml::link('Book Now!', array('reservation/index', 'location' => $data->location, 'resort' => $data->id), array('class' => 'btn btn-default btn-sm', 'target' => '_blank')); ?>
        </div>
    </div>
</div>