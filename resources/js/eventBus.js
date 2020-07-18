import Vue from "vue";


export const UPDATE_PRODUCT_IMAGES = 'UPDATE_PRODUCT_IMAGES';
export const CATEGORY_SELECTED = 'CATEGORY_SELECTED';

const EventBus =  new Vue();

EventBus.$on(UPDATE_PRODUCT_IMAGES, () => {
    jQuery('.set-bg').each(function () {
        var bg = jQuery(this).data('setbg');
        jQuery(this).css('background-image', 'url(' + bg + ')');
    });
})

export default EventBus;
