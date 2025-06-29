<?php
$members = get_field('members');
if (!$members) {
    return;
}
$positions = array_unique(array_filter(wp_list_pluck($members, 'position')));
?>
<section class="stories">
    <div class="container">
        <?php if ($positions) : ?>
            <div class="stories__filter">
                <button class="stories__btn is-active" data-cat="all">All</button>
                <?php foreach ($positions as $p) : ?>
                    <button class="stories__btn" data-cat="<?php echo esc_attr(sanitize_title($p)); ?>">
                        <?php echo esc_html($p); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="stories__grid">
            <?php foreach ($members as $row) :
                $link = $row['name'];
                $photo = $row['photo'];
                $desc = $row['description'];
                $pos = $row['position'];
                $cat = sanitize_title($pos);
                ?>
                <a class="stories__item" href="<?php echo esc_url($link); ?>" rel="noopener"
                   data-cat="<?php echo esc_attr($cat); ?>">
                    <article class="stories__card">
                        <div class="stories__img">
                            <?php
                            if ($photo) {
                                echo wp_get_attachment_image($photo['ID'], 'medium', false, ['class' => 'stories__img-inner']);
                            }
                            ?>
                        </div>
                        <div class="stories__content">
                            <?php if ($desc) : ?>
                                <p class="stories__desc"><?php echo esc_html($desc); ?></p>
                            <?php endif; ?>
                            <?php if ($pos) : ?>
                                <span class="stories__cat"><?php echo esc_html($pos); ?></span>
                            <?php endif; ?>
                        </div>
                    </article>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    document.addEventListener('click', e => {
        const btn = e.target.closest('.stories__btn');
        if (!btn) return;

        const cat = btn.dataset.cat;
        btn.classList.add('is-active');
        btn.parentElement.querySelectorAll('.stories__btn').forEach(b => {
            if (b !== btn) b.classList.remove('is-active');
        });

        const grid = document.querySelector('.stories__grid');
        let visible = 0;

        grid.querySelectorAll('.stories__item').forEach(it => {
            if (cat === 'all' || it.dataset.cat === cat) {
                it.style.display = '';
                visible++;
            } else {
                it.style.display = 'none';
            }
        });

        grid.classList.toggle('is-single', visible === 1);
    });
</script>
