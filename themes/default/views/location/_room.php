<?php
/* @var $this LocationController */
/* @var $data Location */
?>
<div class="row">
    <div class="span4">
        <?php echo Room::get_images($data->id); ?>        
    </div>	 
    <div class="span8">
        <h3><?php echo $data->title; ?></h3>
        <p><span class="text-success"><strong>Location:</strong> <?php echo Location::getLocation($data->location); ?>, <strong>Resort:</strong> <?php echo Resort::getResort($data->resort); ?></span></p>
        <p><?php echo $data->details; ?></p>        
    </div>
</div>
<div class="row">
    <div class="span4"></div>
    <div class="span6">
        <strong class="text-error">TK.<?php echo $data->rent; ?>BDT</strong> <span class="text-info">per room / night</span>
    </div>	 
    <div class="span2">
        <?php echo CHtml::link('Book Now!', array('book/index', 'id' => $data->id), array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>
</div>
<hr />