<template>
<button :type="type" :disabled="disabled || loading" @click="$emit('click', $event)" :class="buttonClasses">
    <div v-if="loading" class="mr-2">
        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    </div>

    <i v-if="icon && !loading" :class="icon" class="mr-2"></i>

    <slot></slot>
</button>
</template>

<script>
import {
    computed
} from 'vue'

export default {
    name: 'TwButton',
    emits: ['click'],
    props: {
        type: {
            type: String,
            default: 'button',
            validator: (value) => ['button', 'submit', 'reset'].includes(value)
        },
        variant: {
            type: String,
            default: 'primary',
            validator: (value) => ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark', 'outline'].includes(value)
        },
        size: {
            type: String,
            default: 'md',
            validator: (value) => ['xs', 'sm', 'md', 'lg', 'xl'].includes(value)
        },
        disabled: {
            type: Boolean,
            default: false
        },
        loading: {
            type: Boolean,
            default: false
        },
        icon: {
            type: String,
            default: ''
        },
        block: {
            type: Boolean,
            default: false
        },
        rounded: {
            type: Boolean,
            default: false
        }
    },
    setup(props) {
        const buttonClasses = computed(() => {
            const baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed'

            let sizeClasses = ''
            switch (props.size) {
                case 'xs':
                    sizeClasses = 'px-2 py-1 text-xs rounded'
                    break
                case 'sm':
                    sizeClasses = 'px-3 py-1.5 text-sm rounded'
                    break
                case 'lg':
                    sizeClasses = 'px-6 py-3 text-base rounded-lg'
                    break
                case 'xl':
                    sizeClasses = 'px-8 py-4 text-lg rounded-lg'
                    break
                default:
                    sizeClasses = 'px-4 py-2 text-sm rounded-md'
            }

            let variantClasses = ''
            switch (props.variant) {
                case 'primary':
                    variantClasses = 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500'
                    break
                case 'secondary':
                    variantClasses = 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500'
                    break
                case 'success':
                    variantClasses = 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500'
                    break
                case 'danger':
                    variantClasses = 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500'
                    break
                case 'warning':
                    variantClasses = 'bg-yellow-600 text-white hover:bg-yellow-700 focus:ring-yellow-500'
                    break
                case 'info':
                    variantClasses = 'bg-cyan-600 text-white hover:bg-cyan-700 focus:ring-cyan-500'
                    break
                case 'light':
                    variantClasses = 'bg-gray-100 text-gray-900 hover:bg-gray-200 focus:ring-gray-300'
                    break
                case 'dark':
                    variantClasses = 'bg-gray-800 text-white hover:bg-gray-900 focus:ring-gray-700'
                    break
                case 'outline':
                    variantClasses = 'border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 focus:ring-gray-500'
                    break
            }

            const roundedClasses = props.rounded ? 'rounded-full' : 'rounded-md'
            const blockClasses = props.block ? 'w-full' : ''
            const disabledClasses = (props.disabled || props.loading) ? 'opacity-50 cursor-not-allowed' : ''

            return `${baseClasses} ${sizeClasses} ${variantClasses} ${roundedClasses} ${blockClasses} ${disabledClasses}`.trim()
        })

        return {
            buttonClasses
        }
    }
}
</script>
