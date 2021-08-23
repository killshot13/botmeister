<div class="wrap">
    <h2>Botmeister</h2>
    <form method="post" action="options.php">
        <?php @settings_fields('botmeister-group'); ?>
        <?php @do_settings_fields('botmeister-group'); ?>

        <?php do_settings_sections('botmeister'); ?>

        <?php @submit_button(); ?>
    </form>
</div>
