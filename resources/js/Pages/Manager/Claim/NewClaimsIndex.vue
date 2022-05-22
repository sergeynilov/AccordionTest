<template>

    <div class="w-full md:w-4/5 mx-auto p-8">

        <h5 class="mt-2 mb-1 small fa-w-4" v-show="!newClaims.length">
            <i :class="getHeaderIcon('info')" class="action_icon icon_right_text_margin"></i>
            There are no new claims now.
        </h5>


        <div class="bg-gray-200 bg-opacity-25" v-show="newClaims.length">

            <h5 class="mt-2 mb-1 small fa-w-4">
                <i :class="getHeaderIcon('cms_item')" class="action_icon icon_right_text_margin"></i>
                {{ newClaims.length }} item{{ pluralize(newClaims.length, '', 's') }}
            </h5>

            <div class="my-0 mx-2 p-0 overflow-x-auto ">
                <table class="w-full editor_listing_table">
                    <tbody>

                    <tr v-for="(nextClaim, index) in newClaims" :key="index">
                        <td class="p-2">
                            <claim-details :claim="nextClaim" :key="'claim-details-' + nextClaim.id" ></claim-details>
                        </td>
                    </tr>
                    </tbody>
                </table>
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
import ClaimDetails from '@/Pages/Manager/Claim/ClaimDetails'

export default defineComponent({
    name: 'newClaimsPageIndexPage',
    props: {},

    components: {
        ClaimDetails
    },

    setup(props) {
        let newClaims = ref([])

        function loadNewClaimsData() {

            axios.get(route('manager.new_claims.load'))
                .then(({data}) => {
                    newClaims.value = data.data
                })
                .catch(e => {
                    console.error(e)
                })

        } // loadNewClaimsData() {


        function frontendOurAuthorBlockOnMounted() {
            loadNewClaimsData()

            window.emitter.on('ClaimWasAnsweredEvent', params => {
                let delete_index = -1
                for (let i = 0; i < newClaims.value.length; i++) {
                    if (newClaims.value[i].id === params.claim_id) {
                        delete_index= i
                        break;
                    }
                }
                if (newClaims.value.length === 1) {
                    newClaims.value = []
                } else {
                    newClaims.value.splice(delete_index, 1)
                }

            })

        } // function frontendOurAuthorBlockOnMounted() {

        onMounted(frontendOurAuthorBlockOnMounted)

        return {
            //  Page state
            newClaims,

            // Page actions
            loadNewClaimsData,

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
