<template>
<Head>
    <title>{{ title }} | Dashboard</title>
</Head>

<div class="min-h-screen bg-gray-50">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-semibold text-gray-900">
                        {{ title }}
                    </h1>
                </div>

                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-700">
                        Welcome, {{ user.name }}!
                    </span>
                    <TwButton @click="logout" variant="secondary" size="sm">
                        Logout
                    </TwButton>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="border-4 border-dashed border-gray-200 rounded-lg p-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Dashboard
                    </h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Welcome to your dashboard! You have successfully logged in.
                    </p>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <TwCard class="text-center">
                            <h3 class="text-2xl font-bold text-blue-600">150</h3>
                            <p class="text-gray-600">Total Users</p>
                        </TwCard>

                        <TwCard class="text-center">
                            <h3 class="text-2xl font-bold text-green-600">89</h3>
                            <p class="text-gray-600">Active Sessions</p>
                        </TwCard>

                        <TwCard class="text-center">
                            <h3 class="text-2xl font-bold text-purple-600">245</h3>
                            <p class="text-gray-600">Total Orders</p>
                        </TwCard>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex justify-center space-x-4">
                        <TwButton variant="primary">
                            Create New Project
                        </TwButton>
                        <TwButton variant="secondary">
                            View Reports
                        </TwButton>
                        <TwButton variant="outline">
                            Settings
                        </TwButton>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</template>

<script>
import {
    Head
} from '@inertiajs/vue3';
import {
    router
} from '@inertiajs/vue3';
import {
    TwButton,
    TwCard
} from '../Components';

export default {
    name: 'Dashboard',
    components: {
        Head,
        TwButton,
        TwCard
    },
    props: {
        title: {
            type: String,
            default: import.meta.env.VITE_APP_NAME,
        },
        user: {
            type: Object,
            required: true
        }
    },
    setup() {
        const logout = () => {
            router.post(route('logout'));
        };

        return {
            logout
        };
    }
};
</script>
