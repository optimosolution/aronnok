<div class="row">
    <div class="span3">
        <?php echo Content::get_images($data->id); ?>
    </div>	 
    <div class="span9">
        <h3><?php echo $data->title; ?></h3>
        <p><?php echo mb_substr($data->introtext, 0, 500, 'UTF-8'); ?></p>
    </div>
</div>
<hr />