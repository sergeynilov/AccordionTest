<template>
    <form @submit.prevent="saveClaim" enctype="multipart/form-data">

        <div class="mb-4">
            <JetLabel for="title" value="Title"/>
            <JetInput
                id="title"
                v-model="formEditor.title"
                type="text"
                class="mt-1 block w-full"
                autofocus
            />
            <JetInputError :message="formEditor.errors.title" class="mt-2"/>
        </div>

        <div class="mb-4">
            <JetLabel for="text" value="Text"/>
            <JetInput
                id="text"
                v-model="formEditor.text"
                type="text"
                class="mt-1 block w-full"
                autofocus
            />
            <JetInputError :message="formEditor.errors.text" class="mt-2"/>
        </div>

        <div class="mb-4">
            <JetLabel for="client_name" value="Client name"/>
            <JetInput
                id="client_name"
                v-model="formEditor.client_name"
                type="text"
                class="mt-1 block w-full"
                autofocus
            />
            <JetInputError :message="formEditor.errors.client_name" class="mt-2"/>
        </div>

        <div class="mb-4">
            <JetLabel for="client_email" value="Client email"/>
            <JetInput
                id="client_email"
                v-model="formEditor.client_email"
                type="text"
                class="mt-1 block w-full"
                autofocus
            />
            <JetInputError :message="formEditor.errors.client_email" class="mt-2"/>
        </div>

        <div class="mb-4">
            <JetLabel for="client_email" value="Attach image"/>
            <FileUploaderPreviewer
                :imageUploader="formEditor"
                :image_url="claim_image_url"
                :image_info="claim_image_info"
                :parent_component_key="'claim_editor'"
                :layout="'client'"
                :show_upload_image_button="false"
            ></FileUploaderPreviewer>
        </div>

        <div class="mt-8 mb-4 flex flex-nowrap">

            <div class="flex flex-grow pl-2">
                <JetSecondaryButton @click="cancelClaimEditor">
                    Cancel
                </JetSecondaryButton>
                <JetButton class="ml-4" :class="{ 'opacity-25': formEditor.processing }"
                           :disabled="formEditor.processing">
                    Send
                </JetButton>
                <div v-show="formEditor.processing" class="ml-2 form_processing"></div>
            </div>

        </div>

    </form>


</template>


<script>

import {
    getHeaderIcon
} from '@/commonFuncs'
import {ref, computed, onMounted} from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from '@inertiajs/inertia'
import FileUploaderPreviewer from '@/components/FileUploaderPreviewer.vue'

import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        claim: {
            type: Object,
            required: true,
        }
    },

    name: 'clientClaimForm',
    components: {
        JetButton,
        JetSecondaryButton,
        JetInput,
        JetLabel,
        JetInputError,
        JetCheckbox,
        FileUploaderPreviewer,
    },
    setup(props) {
        let claim = props.claim.data

        let claim_image_url = ref('')
        let claim_image_info = ref('')
        let formEditor = ref(useForm({
            title: '',
            text: '',
            client_name: '',
            client_email: '',
            image: '',
            image_filename: '',
        }))

        let selected_image= null
        let selected_image_filename= null

        function cancelClaimEditor() {
            Inertia.visit(route('/'), {method: 'get'});
        }

        function saveClaim() {
            if (!selected_image_filename || !selected_image) { // if image was not selected
                storeClaim()
                return
            }

            fetch(selected_image.blob).then(function (response) {
                if (response.ok) {
                    return response.blob().then(function (imageBlob) {
                        formEditor.value.image = imageBlob
                        formEditor.value.image_filename = selected_image_filename
                        storeClaim()
                    })
                } else {
                    return response.json().then(function (jsonError) {
                        console.error(jsonError)
                    })
                }
            }).catch(function (e) {
                console.error(e)
            }) // fetch(currencyImageFile.blob).then(function (response) {
        }  // saveClaim() {

        function storeClaim() {
            formEditor.value.post(route('client.claims.store'), {
                preserveScroll: true,
                onSuccess: (resp) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Claim was created successfully'
                    })
                    formEditor.value.title= '';
                    formEditor.value.text= '';
                    formEditor.value.client_name= '';
                    formEditor.value.client_email= '';
                    formEditor.value.image= null;
                    formEditor.value.image_filename= '';
                    window.emitter.emit('clearFileUploaderPreviewerImageEvent', {
                        parent_component_key: 'claim_editor'
                    })
                },

                onError: (e) => {
                    console.error(e)
                    Toast.fire({
                        icon: 'error',
                        title: 'Creating claim error!'
                    })
                }
            })

        } // function storeClaim() {

        function clientClaimFormOnMounted() {
            window.emitter.on('FileUploaderPreviewerUploadImageEvent', params => {
                if (params.parent_component_key === 'claim_editor') {
                    selected_image= params.uploadedImageFile
                    selected_image_filename= params.uploadedImageFile.name
                }
            })

        } // function clientClaimFormOnMounted() {

        onMounted(clientClaimFormOnMounted)

        return { // setup return
            // Listing Page state
            claim,
            formEditor,
            claim_image_url,
            claim_image_info,

            // Page actions
            saveClaim,
            cancelClaimEditor,
            // Common methods
            getHeaderIcon,
        }

    }  // setup() {
})


</script>

