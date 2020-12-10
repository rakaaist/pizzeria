<section class="poop-wall">
    <?php foreach ($data['pixels'] as $pixel): ?>
        <span class="pixel"
              style="<?php print pixel_attr($pixel) ?>">
    </span>
    <?php endforeach; ?>
</section>