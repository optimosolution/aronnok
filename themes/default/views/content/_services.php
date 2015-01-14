<div class="span6">
    <h3><?php echo $data->title; ?></h3>
    <?php echo Content::get_images($data->id); ?>
    <p><?php echo mb_substr($data->introtext, 0, 200, 'UTF-8'); ?></p>
</div>	