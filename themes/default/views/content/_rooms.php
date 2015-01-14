<div class="span4">
    <h3><?php echo $data->title; ?></h3>
    <?php echo Content::get_images($data->id); ?>
    <ul class="thumbnails hotel-options no_margin_left">
        <li class="no_margin_left"><a class="btn btn-large btn-info" href="book-start.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/icons/Wireless.png" alt="" width="24" height="24"  /></a></li>
        <li><a class="btn btn-large btn-info" href="book-start.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/icons/Restaurant-black.png" alt="" width="24"/></a></li>
        <li><a class="btn btn-large btn-info" href="book-start.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/icons/Tv-black.png" alt="" width="24"/></a></li>
        <li><a class="btn btn-large btn-info" href="book-start.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/icons/Shower.png" alt="" width="24"/></a></li>
        <li><a class="btn btn-large btn-info" href="book-start.html"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/icons/Indoor-Swimming.png" alt="" width="24"/></a></li>
    </ul>
    <p><?php echo mb_substr($data->introtext, 0, 200, 'UTF-8'); ?></p>
    <div class="row center">
        <?php echo CHtml::link('Book Now!', array('book/index'), array('class' => 'btn btn-primary btn-large check-availability')); ?>
    </div>
</div>