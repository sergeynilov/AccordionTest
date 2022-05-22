<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl">
                New Claim
            </div>

            <div class="mt-6 text-gray-500">
                With your access you can and new Claim and our support will answer to it
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 p-8">
            <claim-form-editor :claim="claim"></claim-form-editor>
        </div>

    </div>
</template>

<script>
import ClaimFormEditor from '@/Pages/Client/Claim/Form'

import {
    getHeaderIcon,
    showFlashMessage,
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        claim: {
            type: Object,
            required: true,
        },
    },

    name: 'clientClaimEditor',
    components: {
        JetButton,
        JetSecondaryButton,
        JetInput,
        JetLabel,
        JetInputError,
        JetCheckbox,
        ClaimFormEditor
    },
    setup(props) {

        let claim = props.claim.data

        function clientClaimEditorOnMounted() {
            showFlashMessage()
        } // function clientClaimEditorOnMounted() {

        onMounted(clientClaimEditorOnMounted)

        return { // setup return
            // Listing Page state
            ClaimFormEditor,
            claim,

            // Page actions
            // setActiveTab,

            // Settings vars

            // Common methods
            getHeaderIcon,
            showFlashMessage,

        }
    }, // setup() {

})
</script>

