<?php
/**
 * Component: Cookies
 */
/**
 * Field Structure
 * - cookies_view                                          (Select)
 * - cookies_alert_icon                                    (Image)
 * - cookies_alert_headline                                (Text)
 * - cookies_alert_description                             (WYSIWYG Editor)
 * - cookies_alert_agree_button_text                       (Text)
 * - cookies_alert_reject_button_text                      (Text)
 * - cookies_alert_save_button_text                        (Text)
 * - cookies_alert_manage_button_text                      (Text)
 * - cookies_alert_back_button_text                        (Text)
 * - cookies_manage_headline                               (Text)
 * - cookies_manage_necessary_technologies_headline        (Text)
 * - cookies_manage_necessary_technologies_description     (WYSIWYG Editor)
 * - cookies_manage_analytical_technologies_headline       (Text)
 * - cookies_manage_analytical_technologies_description    (WYSIWYG Editor)
 * - cookies_manage_targeting_technologies_headline        (Text)
 * - cookies_manage_targeting_technologies_description     (WYSIWYG Editor)
 * - cookies_manage_functionality_technologies_headline    (Text)
 * - cookies_manage_functionality_technologies_description (WYSIWYG Editor)
 * - cookies_manage_unclassified_technologies_headline     (Text)
 * - cookies_manage_unclassified_technologies_description  (WYSIWYG Editor)
 */
$fields                            = get_field('cookies', 'options');
$cookies_alert_icon                = $fields['cookies_alert_icon'];
$cookies_alert_headline            = $fields['cookies_alert_headline'];
$cookies_alert_description         = $fields['cookies_alert_description'];
$cookies_alert_agree_button_text   = $fields['cookies_alert_agree_button_text'];
$cookies_alert_reject_button_text  = $fields['cookies_alert_reject_button_text'];
$cookies_alert_save_button_text    = $fields['cookies_alert_save_button_text'];
$cookies_alert_manage_button_text  = $fields['cookies_alert_manage_button_text'];
$cookies_alert_back_button_text    = $fields['cookies_alert_back_button_text'];
$cookies_modal_headline            = $fields['cookies_manage_headline'];
$cookies_modal_description         = $fields['cookies_manage_description'];
$cookies_modal_point_1_headline    = $fields['cookies_manage_necessary_technologies_headline'];
$cookies_modal_point_1_description = $fields['cookies_manage_necessary_technologies_description'];
$cookies_modal_point_2_headline    = $fields['cookies_manage_analytical_technologies_headline'];
$cookies_modal_point_2_description = $fields['cookies_manage_analytical_technologies_description'];
$cookies_modal_point_3_headline    = $fields['cookies_manage_targeting_technologies_headline'];
$cookies_modal_point_3_description = $fields['cookies_manage_targeting_technologies_description'];
$cookies_modal_point_4_headline    = $fields['cookies_manage_functionality_technologies_headline'];
$cookies_modal_point_4_description = $fields['cookies_manage_functionality_technologies_description'];
$cookies_modal_point_5_headline    = $fields['cookies_manage_unclassified_technologies_headline'];
$cookies_modal_point_5_description = $fields['cookies_manage_unclassified_technologies_description'];

?>
<div class="cookie-banner app-component">
    <div class="cookie-banner__head">
        <?php
        /**
         * Headline
         */
        if (!empty($cookies_alert_headline)){ ?>
            <div class="cookie-banner__headline">
                <h3>
                    <?php echo $cookies_alert_headline; ?>
                </h3>
            </div>
        <?php }
        /**
         * Brand
         */
        if (!empty($cookies_alert_icon)){ ?>
            <div class="cookie-banner__brandmark">
                <?php
                /**
                 * Cover creator
                 */
                taxdome_components_has_cover($cookies_alert_icon, null, 82, 24, $cookies_alert_headline);
                ?>
            </div>
        <?php } ?>
        <button type="button"
                aria-label="Close"
                class="cookie-banner__close">
            <i class="icon icon-24 icon-close-blue"></i>
        </button>
    </div>
    <?php
    /**
     * Description
     */
    if (!empty($cookies_alert_description)){ ?>
        <div class="cookie-banner__content">
            <div class="cookie-banner__info">
                <div class="is-rich-editor">
                    <?php echo $cookies_alert_description; ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="cookie-banner__action">
        <?php
        /**
         * Allow all
         */
        if (!empty($cookies_alert_agree_button_text)){ ?>
            <div class="cookie-banner__button">
                <button type="button"
                        aria-label="<?php echo $cookies_alert_agree_button_text; ?>"
                        class="btn btn-primary cookie-banner__agree">
                    <?php echo $cookies_alert_agree_button_text; ?>
                </button>
            </div>
        <?php }
        /**
         * Reject all
         */
        if (!empty($cookies_alert_reject_button_text)){ ?>
            <div class="cookie-banner__button">
                <button type="button"
                        aria-label="<?php echo $cookies_alert_reject_button_text; ?>"
                        class="btn btn-secondary cookie-banner__reject taxdome__button-light">
                    <?php echo $cookies_alert_reject_button_text; ?>
                </button>
            </div>
        <?php }
        /**
         * Manage settings
         */
        if (!empty($cookies_alert_manage_button_text)){ ?>
            <div class="cookie-banner__button">
                <button type="button"
                        aria-label="<?php echo $cookies_alert_manage_button_text; ?>"
                        data-modal="cookieModal"
                        class="btn btn-secondary cookie-banner__manage taxdome__button-light">
                    <?php echo $cookies_alert_manage_button_text; ?>
                </button>
            </div>
        <?php } ?>
    </div>
</div>
<?php
/**
 * Cookie cancellation modal
 */
?>
<div class="modal taxdome-modal" id="cookieModal">
    <div class="taxdome-modal__overlay">
        <div class="taxdome-modal_block">
            <div class="taxdome-modal_headline">
                <?php
                /**
                 * Manage Headline
                 */
                if ($cookies_modal_headline) { ?>
                    <div class="taxdome-modal_title">
                        <h3><?php echo $cookies_modal_headline; ?></h3>
                    </div>
                <?php } ?>
                <button type="button"
                        aria-label="Close"
                        class="taxdome-modal__close"
                        data-modal-close>
                    <img src="<?php echo 'wp-content/themes/advisors/assets/images/close-blue.svg'; ?>">
                </button>
            </div>
            <div class="taxdome-modal__container">
                <?php
                /**
                 * Manage Description
                 */
                if ($cookies_modal_description) { ?>
                    <div class="taxdome-modal_description taxdome-modal_cookie-description">
                        <div class="is-rich-editor">
                            <?php echo $cookies_modal_description; ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="cookie-manage-content">
                    <div class="cookie-manage-label">
                        <div class="cookie-manage-label__field">
                            <div class="cookie-manage__field-chekbox">
                                <label class="is-checkbox cookies-modal__checkbox cookie-banner__input-necessary">
                                    <input class="checkbox__input" name="accept_necessary_technologies" data-cookie="accept_necessary_technologies" type="checkbox" disabled checked>
                                    <span class="checkbox__background">
                                        <span class="checkbox__dot"></span>
                                    </span>
                                </label>
                            </div>
                            <?php
                            /**
                             * Headline
                             */
                            if ($cookies_modal_point_1_headline) { ?>
                                <div class="cookie-manage__field-label">
                                    <h4>
                                        <?php echo $cookies_modal_point_1_headline; ?>
                                    </h4>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                        /**
                         * Description
                         */
                        if ($cookies_modal_point_1_description) { ?>
                            <div class="cookie-manage__field-description">
                                <div class="is-rich-editor">
                                    <?php echo $cookies_modal_point_1_description; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="cookie-manage-label">
                        <div class="cookie-manage-label__field">
                            <div class="cookie-manage__field-chekbox">
                                <label class="is-checkbox cookies-modal__checkbox cookie-banner__input-performance">
                                    <input class="checkbox__input" name="accept_performance_technologies" data-cookie="accept_performance_technologies" type="checkbox" checked>
                                    <span class="checkbox__background">
                                        <span class="checkbox__dot"></span>
                                    </span>
                                </label>
                            </div>
                            <?php
                            /**
                             * Headline
                             */
                            if ($cookies_modal_point_2_headline) { ?>
                                <div class="cookie-manage__field-label">
                                    <h4>
                                        <?php echo $cookies_modal_point_2_headline; ?>
                                    </h4>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                        /**
                         * Description
                         */
                        if ($cookies_modal_point_2_description) { ?>
                            <div class="cookie-manage__field-description">
                                <div class="is-rich-editor">
                                    <?php echo $cookies_modal_point_2_description; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="cookie-manage-label">
                        <div class="cookie-manage-label__field">
                            <div class="cookie-manage__field-chekbox">
                                <label class="is-checkbox cookies-modal__checkbox cookie-banner__input-targeting">
                                    <input class="checkbox__input" name="accept_performance_technologies" data-cookie="accept_targeting_technologies" type="checkbox" checked>
                                    <span class="checkbox__background">
                                        <span class="checkbox__dot"></span>
                                    </span>
                                </label>
                            </div>
                            <?php
                            /**
                             * Headline
                             */
                            if ($cookies_modal_point_3_headline) { ?>
                                <div class="cookie-manage__field-label">
                                    <h4>
                                        <?php echo $cookies_modal_point_3_headline; ?>
                                    </h4>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                        /**
                         * Description
                         */
                        if ($cookies_modal_point_3_description) { ?>
                            <div class="cookie-manage__field-description">
                                <div class="is-rich-editor">
                                    <?php echo $cookies_modal_point_3_description; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="cookie-manage-label">
                        <div class="cookie-manage-label__field">
                            <div class="cookie-manage__field-chekbox">
                                <label class="is-checkbox cookies-modal__checkbox cookie-banner__input-functionality">
                                    <input class="checkbox__input" name="accept_performance_technologies" data-cookie="accept_functionality_technologies" type="checkbox" checked>
                                    <span class="checkbox__background">
                                        <span class="checkbox__dot"></span>
                                    </span>
                                </label>
                            </div>
                            <?php
                            /**
                             * Headline
                             */
                            if ($cookies_modal_point_4_headline) { ?>
                                <div class="cookie-manage__field-label">
                                    <h4>
                                        <?php echo $cookies_modal_point_4_headline; ?>
                                    </h4>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                        /**
                         * Description
                         */
                        if ($cookies_modal_point_4_description) { ?>
                            <div class="cookie-manage__field-description">
                                <div class="is-rich-editor">
                                    <?php echo $cookies_modal_point_4_description; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="cookie-manage-label">
                        <div class="cookie-manage-label__field">
                            <div class="cookie-manage__field-chekbox">
                                <label class="is-checkbox cookies-modal__checkbox cookie-banner__input-unclassified">
                                    <input class="checkbox__input" name="accept_performance_technologies" data-cookie="accept_unclassified_technologies" type="checkbox" checked>
                                    <span class="checkbox__background">
                                        <span class="checkbox__dot"></span>
                                    </span>
                                </label>
                            </div>
                            <?php
                            /**
                             * Headline
                             */
                            if ($cookies_modal_point_5_headline) { ?>
                                <div class="cookie-manage__field-label">
                                    <h4>
                                        <?php echo $cookies_modal_point_5_headline; ?>
                                    </h4>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                        /**
                         * Description
                         */
                        if ($cookies_modal_point_5_description) { ?>
                            <div class="cookie-manage__field-description">
                                <div class="is-rich-editor">
                                    <?php echo $cookies_modal_point_5_description; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="cookie-banner__action cookie-manage-banner__action">
                    <?php
                    /**
                     * Save
                     */
                    if (!empty($cookies_alert_save_button_text)){ ?>
                        <div class="cookie-banner__button">
                            <button type="button"
                                    aria-label="<?php echo $cookies_alert_save_button_text; ?>"
                                    class="btn btn-primary cookie-banner__save-modal"
                                    data-modal-close>
                                <?php echo $cookies_alert_save_button_text; ?>
                            </button>
                        </div>
                    <?php }
                    /**
                     * Reject all
                     */
                    if (!empty($cookies_alert_reject_button_text)){ ?>
                        <div class="cookie-banner__button">
                            <button type="button"
                                    aria-label="<?php echo $cookies_alert_reject_button_text; ?>"
                                    class="btn btn-secondary cookie-banner__reject-modal"
                                    data-modal-close>
                                <?php echo $cookies_alert_reject_button_text; ?>
                            </button>
                        </div>
                    <?php }
                    /**
                     * Back
                     */
                    if (!empty($cookies_alert_back_button_text)){ ?>
                        <div class="cookie-banner__button cookie-banner__button-back">
                            <button type="button"
                                    aria-label="<?php echo $cookies_alert_back_button_text; ?>"
                                    class="btn btn-secondary cookie-banner__back-modal"
                                    data-modal-close>
                                <?php echo $cookies_alert_back_button_text; ?>
                            </button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
