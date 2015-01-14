<div class="row">
    <div class="span3">
        <?php echo Content::get_images($data->id); ?>
    </div>	 
    <div class="span9">
        <h3><?php echo $data->title; ?></h3>
        <p><?php echo $data->introtext; ?></p>
        <div class="row center">
            <?php echo CHtml::link('Book Now!', array('book/create'), array('class' => 'btn btn-primary btn-large check-availability')); ?>
        </div>
    </div>
</div>
<hr />