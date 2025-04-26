<?php
/**
 * Template Name: User Profiles
 */
get_header();
the_content();
global $wpdb;

$users_per_page = 12;
$paged          = (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset         = ($paged - 1) * $users_per_page;
$get_service    = !empty($_GET['service']) ? trim($_GET['service']) : null;
$get_location   = !empty($_GET['location']) ? trim($_GET['location']) : null;
$get_sort       = !empty($_GET['sort']) ? trim($_GET['sort']) : 'asc';

$meta_query = array('relation' => 'AND');
if ($get_service) {
    $meta_query[] = array(
        'key' => 'industry',
        'value' => $get_service,
        'compare' => 'LIKE'
    );
}
if ($get_location) {
    $meta_query[] = array(
        'relation' => 'OR',
        array(
            'key' => 'location_city',
            'value' => $get_location,
            'compare' => 'LIKE'
        ),
        array(
            'key' => 'location_country',
            'value' => $get_location,
            'compare' => 'LIKE'
        ),
        array(
            'key' => 'location_state',
            'value' => $get_location,
            'compare' => 'LIKE'
        ),
        array(
            'key' => 'location_zipcode',
            'value' => $get_location,
            'compare' => 'LIKE'
        )
    );
}



$args = array(
    'role__not_in' => array('administrator'),
    'number'       => -1,
    'meta_query'   => $meta_query,
);

$users_query = new WP_User_Query($args);
$all_users   = $users_query->get_results();

usort($all_users, function ($a, $b) use ($get_sort) {
    $certificate_a = get_field('certificate', 'user_' . $a->ID);
    $certificate_b = get_field('certificate', 'user_' . $b->ID);

    if ($certificate_a && !$certificate_b) {
        return -1;
    } elseif (!$certificate_a && $certificate_b) {
        return 1;
    }

    $result = strcasecmp($a->display_name, $b->display_name);

    return ($get_sort === 'desc') ? -$result : $result;
});

$app_instance = App::instance();
$all_users = array_filter($all_users, function($user) {
    return !get_user_meta($user->ID, 'deactivated', true);
});

$users_count = count($all_users);
$all_users = array_slice($all_users, $offset, $users_per_page);

if ($paged > ceil($users_count / $users_per_page) || $paged < 1) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    include get_template_directory() . '/404.php';
    exit;
}



$tags = $wpdb->get_results("SELECT DISTINCT meta_value FROM wp_usermeta WHERE meta_key = 'industry'", ARRAY_A);
?>

    <section class="profile">
        <div class="container">
            <div class="profile__top-back">
                <div class="breadcrumbs">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span class="current"> / <?php the_title(); ?></span>
                </div>
                <h1><?php the_title(); ?></h1>
                <div class="profile__top">
                    <?php
                    $search_title         = get_field('find_advisors');
                    $search_label_first   = get_field('search_by_service');
                    $search_label_second  = get_field('search_by_location');
                    $search_submit_button = get_field('submit_button');
                    $taxonomy_title       = get_field('taxonomy_title');
                    $placeholder_service  = get_field('placeholder_service');
                    $placeholder_location = get_field('placeholder_location');
                    ?>
                    <div class="profile__top-ajaxsearch">
                        <form action="/search_results" autocomplete="off" method="GET" class="search-form">
                            <div class="search-form__inner">
                                <input type="text" id="service" name="service" placeholder="<?php echo $placeholder_service; ?>" value="<?php echo $get_service; ?>">
                                <div id="service-block" class="search-form__block"></div>
                            </div>
                            <div class="search-form__inner">
                                <input type="text" id="location"  class="right-input" name="location" placeholder="<?php echo $placeholder_location; ?>" value="<?php echo $get_location; ?>">
                                <div id="location-block" class="search-form__block"></div>
                            </div>
                            <input type="submit" value="<?php echo $search_submit_button; ?>">
                        </form>
                    </div>
                    <div class="top-flex">
                        <?php
                        if (!empty($tags)) { ?>
                            <div class="profile__top-taxonomy">
                                <?php
                                if (!empty($taxonomy_title)) { ?>
                                    <h3><?php echo $taxonomy_title; ?></h3>
                                <?php } ?>
                                <div class="profile__top-taxonomy-tags">
                                    <?php foreach ($tags as $tag) { ?>
                                        <div class="sep">
                                            <a href="/search_results/?service=<?= $tag['meta_value']; ?>"
                                               tabindex="0"
                                               aria-label="<?= $tag['meta_value']; ?>">
                                                <?= $tag['meta_value']; ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <form id="sort-form" action="" method="get" class="sort-form">
                            <input type="hidden" name="service" value="<?php echo $get_service; ?>">
                            <input type="hidden" name="location" value="<?php echo $get_location; ?>">
                            <div class="results-counter">
                                <?php
                                $start_item = ($paged - 1) * $users_per_page + 1;
                                $end_item = $paged * $users_per_page;
                                $end_item = ($end_item > $users_count) ? $users_count : $end_item;
                                echo 'Showing ' . $start_item . ' - ' . $end_item . ' of ' . $users_count . ' Results';
                                ?>
                            </div>
                            <div class="profile__top-taxonomy sort">
                                <h3 class="sort">Sort by name</h3>
                                <div class="profile__top-taxonomy-tags">
                                    <div class="sep">
                                        <a href="<?php echo add_query_arg('sort', 'asc'); ?>" tabindex="0">A - Z</a>
                                    </div>
                                    <div class="sep">
                                        <a href="<?php echo add_query_arg('sort', 'desc'); ?>" tabindex="0">Z - A</a>
                                    </div>
                                </div>
                            </div>
                            <select name="sort" id="sort" onchange="this.form.submit()">
                                <option value="asc" <?php selected($get_sort, 'asc'); ?>>A - Z</option>
                                <option value="desc" <?php selected($get_sort, 'desc'); ?>>Z - A</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="profile__main">
                <div class="profile__flex">
                    <?php
                    $no_results = get_field('no_results');
                    $has_valid_users = false;
                    foreach ($all_users as $user) {
                        if (get_user_meta($user->ID, 'deactivated', true)) {
                            continue;
                        }
                        if (!$app_instance->is_subscription_valid($user->user_email)) {
                            continue;
                        }
                        $has_valid_users = true;

                        $user_id              = $user->ID;
                        $industry             = get_field('industry', 'user_' . $user_id);
                        $work_remotely        = get_field('work_remotely', 'user_' . $user_id);
                        $company_name         = get_field('company_name', 'user_' . $user_id);
                        $visit_website        = get_field('visit_website', 'user_' . $user_id);
                        $appointment          = get_field('appointment', 'user_' . $user_id);
                        $phone_number         = get_field('phone_number', 'user_' . $user_id);
                        $location             = get_field('location', 'user_' . $user_id);
                        $location_country     = get_field('location_country', 'user_' . $user_id);
                        $location_state       = get_field('location_state', 'user_' . $user_id);
                        $location_city        = get_field('location_city', 'user_' . $user_id);
                        $location_address     = get_field('location_address', 'user_' . $user_id);
                        $location_zipcode     = get_field('location_zipcode', 'user_' . $user_id);
                        $photo                = get_field('photo', 'user_' . $user_id);
                        $profile              = get_field('profile', 'user_' . $user_id);
                        $send                 = get_field('send', 'user_' . $user_id);
                        $certificate          = get_field('certificate', 'user_' . $user_id);
                        ?>
                        <div class="profile__single">
                            <?php
                            $profile_url = home_url('/single-users-profile/?user_id=') . $user_id;
                            $message_url = home_url('/contact-user/?user_id=') . $user_id;
                            $locations = [$location_country, $location_state, $location_city, $location_address, $location_zipcode];
                            ?>
                            <div class="profile__single-img">
                                <a href="<?php echo esc_url($profile_url); ?>"
                                   tabindex="0"
                                   aria-label="<?php echo esc_html($company_name); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="160" height="160" viewBox="0 0 327.846 318.144">
                                        <defs>
                                            <style>
                                                .a {
                                                    fill: none;
                                                    stroke-width: 15px;
                                                    stroke: rgba(255, 255, 255, 1);
                                                    object-fit: cover;
                                                    stroke-linejoin:round;
                                                }
                                            </style>
                                            <clipPath id="image">
                                                <path transform="translate(111.598) rotate(30)" d="M172.871,0a28.906,28.906,0,0,1,25.009,14.412L245.805,97.1a28.906,28.906,0,0,1,0,28.989L197.88,208.784A28.906,28.906,0,0,1,172.871,223.2H76.831a28.906,28.906,0,0,1-25.009-14.412L3.9,126.092A28.906,28.906,0,0,1,3.9,97.1L51.821,14.412A28.906,28.906,0,0,1,76.831,0Z"/>
                                            </clipPath>
                                        </defs>
                                        <image clip-path="url(#image)" height="96%" width="96%" xlink:href="<?php echo esc_url($photo['url']); ?>" preserveAspectRatio="xMidYMid meet" style="object-fit: cover;"></image>
                                        <path class="a" d="M172.871,0a28.906,28.906,0,0,1,25.009,14.412L245.805,97.1a28.906,28.906,0,0,1,0,28.989L197.88,208.784A28.906,28.906,0,0,1,172.871,223.2H76.831a28.906,28.906,0,0,1-25.009-14.412L3.9,126.092A28.906,28.906,0,0,1,3.9,97.1L51.821,14.412A28.906,28.906,0,0,1,76.831,0Z" transform="translate(111.598) rotate(30)"/>
                                    </svg>
                                </a>
                            </div>
                            <?php
                            if(!empty($certificate)) { ?>
                                <div class="profile__single-certificate"></div>
                            <?php } ?>
                            <div class="profile__single-content">
                                <h3>
                                    <a href="<?php echo esc_url($profile_url); ?>"
                                       tabindex="0"
                                       aria-label="<?php echo esc_html($company_name); ?>">
                                        <?php echo esc_html($company_name); ?>
                                    </a>
                                </h3>
                                <?php
                                if (!empty($work_remotely)) { ?>
                                    <div class="profile__single-content-work <?php echo esc_attr(str_replace([' ', '&'], ['_', ''], strtolower($work_remotely))); ?>">
                                        <div class="icon-container">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon-check"><path fill="currentColor" d="M473 80L191 362l-124-124c-9-9-24-9-33 0s-9 24 0 33l145 145c9 9 24 9 33 0l312-312c9-9 9-24 0-33s-24-9-33 0z"></path></svg>
                                        </div>
                                        <?php echo esc_html($work_remotely); ?>
                                    </div>
                                <?php }
                                if (!empty($locations)) { ?>
                                    <div class="profile__single-content-location">
                                        <?php if(!empty($location_country)) { echo $location_country; }
                                        if(!empty($location_state)) { echo ', ' . $location_state; }
                                        if(!empty($location_city)) { echo ', ' . $location_city; } ?>
                                    </div>
                                <?php } ?>
                                <div class="profile__single-content-more">
                                    <div class="view-profile taxdome__button-light">
                                        <a href="<?php echo esc_url($profile_url); ?>"
                                           tabindex="0"
                                           aria-label="<?php echo esc_html($profile); ?>">
                                            View profile
                                        </a>
                                    </div>
                                    <div class="send-message taxdome__button">
                                        <a class="btn btn-lg btn-primary"
                                           href="<?php echo esc_url($message_url); ?>"
                                           tabindex="0"
                                           aria-label="<?php echo esc_html($send); ?>">
                                            Send message
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!$has_valid_users) { ?>
                        <div class="profile__main-noresults"><?php echo $no_results; ?></div>
                    <?php } ?>

                    <div class="pagination">
                        <?php
                        $total_pages = ceil($users_count / $users_per_page);
                        $prev_disabled_class = ($paged == 1) ? 'disabled' : '';
                        $prev_href = ($paged > 1) ? get_pagenum_link($paged - 1) : '';
                        $prev_text = ($paged > 1) ? '&laquo; Back' : '<span class="' . $prev_disabled_class . '">&laquo; Back</span>';
                        echo '<span class="prev"><a href="' . esc_url($prev_href) . '">' . $prev_text . '</a></span>';

                        echo paginate_links(
                            array(
                                'total'     => $total_pages,
                                'current'   => $paged,
                                'prev_next' => false,
                                'mid_size'  => 3,
                            )
                        );

                        $next_disabled_class = ($paged == $total_pages) ? 'disabled' : '';
                        $next_href = ($paged < $total_pages) ? get_pagenum_link($paged + 1) : '';
                        $next_text = ($paged < $total_pages) ? 'Next &raquo;' : '<span class="' . $next_disabled_class . '">Next &raquo;</span>';
                        echo '<span class="next"><a href="' . esc_url($next_href) . '">' . $next_text . '</a></span>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var parentElement = document.querySelector('.profile__main');
        var parentHeight = parentElement.clientHeight;
        parentElement.classList.add('dynamic-height');
    </script>
<?php get_footer(); ?>
