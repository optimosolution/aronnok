<?php
/* @var $this LocationController */
/* @var $data Location */
?>
<div class="row">
    <div class="span4">
        <?php echo Location::get_images($data->id); ?>
    </div>	 
    <div class="span8">
        <h3><?php echo $data->location; ?></h3>
        <p><?php echo $data->details; ?></p>
    </div>
</div>
<div class="row">
    <div class="span10">
    </div>	 
    <div class="span2">
        <?php echo CHtml::link('Resort!', array('location/resort', 'id' => $data->id), array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>
</div>
<hr />