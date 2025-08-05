<template>
<Head>
    <title>{{ title }} | Register</title>
</Head>

<TwAlert v-if="formErrors.error_msg" type="error" :message="formErrors.error_msg" class="mb-4" dismissible @dismiss="formErrors.error_msg = ''" />

<form @submit.prevent="handleSubmit" class="space-y-2">
    <TwInput v-model="form.name" type="text" label="Full Name" required :error="formErrors.name" />

    <TwInput v-model="form.email" type="email" label="Email Address" required :error="formErrors.email" />

    <TwInput v-model="form.password" type="password" label="Password" required :error="formErrors.password" />

    <TwInput v-model="form.password_confirmation" type="password" label="Confirm Password" required :error="formErrors.password_confirmation" />

    <TwButton type="submit" variant="primary" block :loading="loading">
        Create Account
    </TwButton>
    <div class="text-xs text-gray-600">
        By creating an account, you agree to our
        <a href="#" class="text-blue-600 hover:text-blue-500">Terms of Service</a>
        and
        <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a>.
    </div>
</form>
<div class="mt-3">
    <h5 class="text-gray-600 text-sm">Already have an account?
        <Link :href="route('auth.login.index')" class="text-sm text-blue-600 hover:text-blue-500 font-medium">
        Sign in
        </Link>
    </h5>
</div>
</template>

<script>
import {
    Head,
    Link
} from '@inertiajs/vue3';
import {
    router
} from '@inertiajs/vue3';
import AuthLayout from "../../Shared/Layouts/AuthLayout.vue";
import {
    ref,
    reactive
} from "vue";
import {
    TwCard,
    TwInput,
    TwButton,
    TwAlert
} from "../../Components";

export default {
    layout: (h, page) => h(AuthLayout, {
        pageTitle: 'Create Account',
        pageDescription: 'Join thousands of users on our platform'
    }, () => page),
    name: "Register",
    components: {
        Head,
        Link,
        TwCard,
        TwInput,
        TwButton,
        TwAlert,
    },
    props: {
        title: {
            type: String,
            default: import.meta.env.VITE_APP_NAME,
        },
        errors: {
            type: Object,
            default: () => ({})
        }
    },
    setup(props) {
        const form = reactive({
            name: "",
            email: "",
            password: "",
            password_confirmation: ""
        });

        const loading = ref(false);

        const formErrors = reactive({
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            error_msg: ""
        });

        const handleSubmit = () => {
            loading.value = true;

            formErrors.name = "";
            formErrors.email = "";
            formErrors.password = "";
            formErrors.password_confirmation = "";
            formErrors.error_msg = "";

            router.post(route('auth.register.store'), form, {
                onSuccess: () => {
                    // Redirect akan ditangani otomatis oleh Inertia
                },
                onError: (errors) => {
                    formErrors.name = errors.name || "";
                    formErrors.email = errors.email || "";
                    formErrors.password = errors.password || "";
                    formErrors.password_confirmation = errors.password_confirmation || "";

                    if (errors.error_msg) {
                        formErrors.error_msg = errors.error_msg || "An error occurred during registration. Please try again.";
                    }
                },
                onFinish: () => {
                    loading.value = false;
                }
            });
        };

        return {
            form,
            errors: formErrors,
            formErrors,
            loading,
            handleSubmit,
        };
    },
};
</script>
