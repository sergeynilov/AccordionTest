<template>

    <div class="w-full md:w-4/5 mx-auto p-8">

        <h5 class="mt-2 mb-1 small fa-w-4">
            <i :class="getHeaderIcon('cms_item')" class="action_icon icon_right_text_margin"></i>
            {{ activeCmsItems.length }} item{{ pluralize(activeCmsItems.length, '', 's') }}
        </h5>

        <div class="accordion" id="accordionExample">

            <div class="accordion-item bg-white border border-gray-200"  v-for="(nextOurActiveCmsItem, index) in activeCmsItems" :key="index">
                <h2 class="accordion-header mb-0" :id="'heading_' + nextOurActiveCmsItem.id">
                    <button class="accordion-button relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left bg-white border-0 rounded-none transition focus:outline-none " :class="{ 'collapsed' : index > 0}" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse_' + nextOurActiveCmsItem.id" aria-expanded="true"
                            :aria-controls="'collapse_' + nextOurActiveCmsItem.id">
                        {{ nextOurActiveCmsItem.title }}
                    </button>
                </h2>
                <div :id="'collapse_' + nextOurActiveCmsItem.id" class="accordion-collapse collapse" :class="{ 'show' : index === 0}" :aria-labelledby="'heading_' + nextOurActiveCmsItem.id"
                     data-bs-parent="#accordionExample">
                    <div class="accordion-body py-4 px-5">
                        <img class="sm:float-none md:float-left img_preview_wrapper p-1 m-2 xs:max-w-xs	sm:max-w-xs	md:max-w-sm lg:max-w-md " v-if="nextOurActiveCmsItem.cmsItemImageProps"
                             :src="nextOurActiveCmsItem.cmsItemImageProps.url" :title="nextOurActiveCmsItem.title">
                        <p class="w-full frontend_content_text m-3 text_wrapper" v-html="sanitizeHtml(nextOurActiveCmsItem.text)"></p>
                    </div>
                </div>
            </div>

        </div>

    </div>


</template>


<script>
import {ref, onMounted} from "vue";
import * as sanitizeHtml from 'sanitize-html';
import {defineComponent} from 'vue'
import {
    getHeaderIcon,
    pluralize,
    pluralize3,
    momentDatetime,
} from '@/commonFuncs'

import {settingsJsMomentDatetimeFormat} from '@/app.settings.js'

export default defineComponent({
    name: 'AccordionPageIndexPage',
    props: {},

    components: {
        // FrontendLayout,
    },

    setup(props) {
        let activeCmsItems = ref([])

        function loadActiveCmsItemsData() {

            axios.get(route('admin.accordion.load_active_cms_items'))
                .then(({data}) => {
                    activeCmsItems.value = data.data
                })
                .catch(e => {
                    console.error(e)
                })

        } // loadActiveCmsItemsData() {


        function frontendOurAuthorBlockOnMounted() {
            loadActiveCmsItemsData()
        } // function frontendOurAuthorBlockOnMounted() {

        onMounted(frontendOurAuthorBlockOnMounted)

        return {
            //  Page state
            activeCmsItems,

            // Page actions
            loadActiveCmsItemsData,

            // Settings vars
            settingsJsMomentDatetimeFormat,

            // Common methods
            pluralize,
            pluralize3,
            momentDatetime,
            getHeaderIcon,
            sanitizeHtml,
        }
    }, // setup() {

})
</script>

<style>

.img_preview_wrapper {
    @apply border-2 border-gray-400 rounded-lg md:max-w-md xl:max-w-xl h-auto;
}

</style>
