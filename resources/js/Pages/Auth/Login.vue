<template>


        <jet-authentication-card>
            <template #logo>
                <jet-application-logo :icon_type="'big'" :layout="'frontend'"/>
            </template>

            <div class="card-body">

                <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ status }}
                </div>

                <form @submit.prevent="loginSubmit">
                    <div class="form-group">
                        <jet-label for="login_email" value="Email"/>
                        <jet-input id="login_email" type="email" v-model="formLogin.email" required autofocus/>
                        <JetInputError :message="formLogin.errors.email" class="mt-2"/>
                    </div>

                    <div class="form-group">
                        <jet-label for="login_password" value="Password"/>
                        <jet-input id="login_password" type="password" v-model="formLogin.password" required
                                   autocomplete="current-password"/>
                        <JetInputError :message="formLogin.errors.password" class="mt-2"/>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox mt-2">
                            <jet-checkbox id="remember_me" name="remember" v-model:checked="formLogin.remember"
                                          class="custom-control-input-outline mr-2"/> &nbsp;
                            <jet-label for="remember_me" value="Remember Me" class="ml-2"/>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="d-flex justify-content-end align-items-baseline  mt-2">
                            <jet-button type="submit" class="ms-4 d-flex flex-nowrap" :class="{ 'text-white-50': formLogin.processing }"
                                        :disabled="formLogin.processing">
                                Log&nbsp;in
                            </jet-button>
                            <div v-show="formLogin.processing" class="form_processing ml-2"></div>

                        </div>
                        <div class="d-flex justify-content-end align-items-baseline mt-2">
                            <Link v-if="canResetPassword" :href="route('password.request')" class="text-muted me-3">
                                Forgot your password?
                            </Link>
                        </div>
                    </div>
                </form>
            </div>
        </jet-authentication-card>

</template>


<script>
import {defineComponent, ref} from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import {Head, Link, useForm, usePage} from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia'

export default defineComponent({
    props: {
        canResetPassword: Boolean,
        status: String
    },
    name: 'LoginPage',
    components: {
        Head,
        JetAuthenticationCard,
        JetApplicationLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        Link,
        JetInputError
    },

    setup(props) {
        let formLogin = ref(useForm({
            email: '',  // manager
            password: '',
            remember: false
        }))

        function loginSubmit() {

            formLogin.value.post(route('login'), {
                preserveScroll: true,
                onSuccess: (data) => {

                    if(usePage().props.value.auth.is_logged_user_manager) {
                        Toast.fire({
                            icon: 'success',
                            title: 'You are logged into the app as manager'
                        })
                        Inertia.visit(route('manager.new_claims.index'), {method: 'get'});
                        return;
                    } // if(usePage().props.value.auth.is_logged_user_manager) {

                    Toast.fire({
                        icon: 'success',
                        title: 'You are logged into the app as client'
                    })
                    Inertia.visit(route('client.claim.create'), {method: 'get'});

                },
                onError: (e) => {
                    console.log(e)
                    Toast.fire({
                        icon: 'error',
                        title: 'Login error'
                    })
                }
            })
        } // saveCMSItem() {

        return { // setup return
            formLogin,
            loginSubmit
        }
    }, // setup() {

})
</script>
