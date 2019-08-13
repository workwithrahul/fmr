<?php if (have_rows('know_where_to_go_and_park')): ?>
    <?php
    while (have_rows('know_where_to_go_and_park')) : the_row();
        $heading = get_sub_field('section_title');
        $image = get_sub_field('section_image');
        $button_text = get_sub_field('button_text');
        $button_link = get_sub_field('button_link');
        ?>
        <section class="direction-wrap space map-section">
            <div class="container">
                <?php
                if ($heading) {
                    echo "<div class='h2 text-center mb-5'>" . $heading . "</div>";
                }
                ?>
                <div class="row">
                    <div class="col-lg-9 pr-md-4"><?php if ($image) { ?>
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                        <?php } ?></div>
                    <div class="col-lg-3">
                        <?php if (have_rows('get_directions')): ?>
                            <ul class="location-listing">
                                <?php
                                while (have_rows('get_directions')) : the_row();
                                    $location = get_sub_field('location_details');
                                    ?>
                                    <li><?php echo $location; ?></li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif;
                        ?>
                    </div>
                </div>
                <?php
                if ($button_text) {
                    echo "<div class='btn-container text-center'><a href='" . $button_link . "' download><span>" . $button_text . "</span></a></div>";
                }
                ?>
            </div>
        </section>
    <?php endwhile; ?>
    <?php
 endif;
        






