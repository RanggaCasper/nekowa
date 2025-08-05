<template>
<Head>
    <title>{{ title }} | Login Pages</title>
</Head>

<TwAlert v-if="formErrors.error_msg" type="error" :message="formErrors.error_msg" class="mb-4" dismissible @dismiss="formErrors.error_msg = ''" />

<form @submit.prevent="handleSubmit" class="space-y-4">
    <TwInput v-model="form.email" type="email" label="Email Address" required :error="formErrors.email" />

    <TwInput v-model="form.password" type="password" label="Password" required :error="formErrors.password" />

    <TwCheckbox v-model="form.remember" label="Remember me" />

    <TwButton type="submit" variant="primary" block :loading="loading">
        Sign In
    </TwButton>

    <div class="mt-3">
        <h5 class="text-gray-600 text-sm">Don't have an account?
            <Link :href="route('auth.register.index')" class="text-sm text-blue-600 hover:text-blue-500 font-medium" prefetch>
            Create an account
            </Link>
        </h5>
    </div>
</form>
</template>

<script>
import {
    Head,
    Link
} from "@inertiajs/vue3";
import {
    router
} from "@inertiajs/vue3";
import AuthLayout from "../../Shared/Layouts/AuthLayout.vue";
import {
    ref,
    reactive
} from "vue";
import {
    TwCard,
    TwInput,
    TwButton,
    TwCheckbox,
    TwAlert
} from "../../Components";

export default {
    layout: (h, page) => h(AuthLayout, {
        pageTitle: 'Sign In',
        pageDescription: 'Sign in to your account to continue'
    }, () => page),
    name: "Login",
    components: {
        Head,
        Link,
        TwCard,
        TwInput,
        TwButton,
        TwCheckbox,
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
            email: "",
            password: "",
            remember: false
        });

        const loading = ref(false);

        const formErrors = reactive({
            email: "",
            password: "",
            error_msg: ""
        });

        const handleSubmit = () => {
            loading.value = true;

            formErrors.email = "";
            formErrors.password = "";
            formErrors.error_msg = "";

            router.post(route('auth.login.store'), form, {
                onSuccess: () => {
                    // Redirect akan ditangani otomatis oleh Inertia
                },
                onError: (errors) => {
                    formErrors.email = errors.email || "";
                    formErrors.password = errors.password || "";

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
