<template>

    <div class="flex justify-center">
        <div class="block p-6 rounded-lg shadow-lg bg-white max-w-lg">
            <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2">{{ claim.title }}</h5>
            <h5 class="text-gray-900 text-sm leading-tight font-medium mb-2">
                By {{ claim.author.name }} on {{ claim.created_at_formatted }}
            </h5>
            <h5 class="text-gray-900 text-sm leading-tight font-medium mb-2">
                Claim is made for {{ claim.client_name }} with email {{ claim.client_email }}
            </h5>

            <div class="flex justify-start">
                <img class="sm:float-none md:float-left img_preview_wrapper p-1 m-2 xs:max-w-xs	sm:max-w-xs	md:max-w-sm lg:max-w-md " v-if="claim.claimImageProps"
                     :src="claim.claimImageProps.url" :title="claim.title">
                <p class="text-gray-700 text-base mb-4 mt-2" v-html="claim.text">
                </p>
            </div>

            <div class="flex justify-center">
                <div class="bg-white rounded-lg border border-gray-200 w-96 text-gray-900">
                    <JetSecondaryButton @click="removeClaim(claim.id)">
                        Delete
                    </JetSecondaryButton>
                    <JetButton @click="answerClaim(claim.id)" class="ml-4">
                        Mark as Answered
                    </JetButton>
                    <div v-show="is_data_loading" class="ml-2 form_processing"></div>
                </div>
            </div>

        </div>
    </div>

</template>


<script>

import {
    getHeaderIcon,
    getDictionaryLabel
} from '@/commonFuncs'
import {ref, onMounted} from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

import {
    settingsAppColors
} from '@/app.settings.js'

import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        claim: {
            type: Object,
            required: true,
        },
    },

    name: 'managerClaimDetails',
    components: {
        JetButton,
        JetSecondaryButton,
        JetInput,
        JetLabel,
        JetInputError,
        JetCheckbox,
    },
    setup(props) {
        let claim = props.claim
        let is_data_loading = ref(false)


        function removeClaim(claim_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to remove this claim!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, remove!'
            }).then((result) => {
                if (result.isConfirmed) {
                    is_data_loading.value = true
                    axios.delete(route('manager.new_claims.destroy', {claim_id: claim_id}))
                        .then(({data}) => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Claim was removed successfully'
                            })

                            window.emitter.emit('ClaimWasAnsweredEvent', { // Reload parent Claims list if need
                                claim_id: claim_id,
                            })
                            is_data_loading.value = false
                        })
                        .catch(e => {
                            console.error(e)
                            is_data_loading.value = false
                        })
                }
            })
        } // removeClaim() {


        function answerClaim(claim_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You what to answer this claim!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: settingsAppColors.confirmButtonColor,
                cancelButtonColor: settingsAppColors.cancelButtonColor,
                confirmButtonText: 'Yes, answer!'
            }).then((result) => {
                if (result.isConfirmed) {
                    is_data_loading.value = true
                    axios.put(route('manager.new_claims.answer', {claim_id: claim_id}))
                        .then(({data}) => {
                            Toast.fire({
                                icon: 'success',
                                title: 'Claim was answered successfully'
                            })

                            window.emitter.emit('ClaimWasAnsweredEvent', {
                                claim_id: claim_id,
                            })
                            is_data_loading.value = false
                        })
                        .catch(e => {
                            console.error(e)
                            is_data_loading.value = false
                        })
                }
            })
        } // answerClaim() {


        function managerClaimDetailsOnMounted() {
        } // function managerClaimDetailsOnMounted() {

        onMounted(managerClaimDetailsOnMounted)

        return { // setup return
            // Listing Page state
            claim,
            is_data_loading,

            // Page actions
            removeClaim,
            answerClaim,

            // Settings vars

            // Common methods
            getHeaderIcon,
            getDictionaryLabel,
        }
    }, // setup() {

})
</script>

