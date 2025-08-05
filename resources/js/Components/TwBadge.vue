<template>
<span :class="badgeClasses">
    <i v-if="icon" :class="icon" class="mr-1"></i>
    <slot></slot>
    <button v-if="closable" type="button" @click="$emit('close')" class="ml-1 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full text-xs hover:bg-black hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-white">
        <span class="sr-only">Remove</span>
        <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
            <path stroke-linecap="round" stroke-width="1.5" d="m1 1 6 6m0-6-6 6" />
        </svg>
    </button>
</span>
</template>

<script>
import {
    computed
} from 'vue'

export default {
    name: 'TwBadge',
    emits: ['close'],
    props: {
        variant: {
            type: String,
            default: 'primary',
            validator: (value) => ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'].includes(value)
        },
        size: {
            type: String,
            default: 'md',
            validator: (value) => ['sm', 'md', 'lg'].includes(value)
        },
        rounded: {
            type: Boolean,
            default: false
        },
        closable: {
            type: Boolean,
            default: false
        },
        icon: {
            type: String,
            default: ''
        },
        outlined: {
            type: Boolean,
            default: false
        }
    },
    setup(props) {
        const badgeClasses = computed(() => {
            const baseClasses = 'inline-flex items-center font-medium'

            let sizeClasses = ''
            switch (props.size) {
                case 'sm':
                    sizeClasses = 'px-2 py-0.5 text-xs'
                    break
                case 'lg':
                    sizeClasses = 'px-3 py-1 text-sm'
                    break
                default:
                    sizeClasses = 'px-2.5 py-0.5 text-xs'
            }

            let variantClasses = ''
            if (props.outlined) {
                switch (props.variant) {
                    case 'primary':
                        variantClasses = 'bg-white text-blue-700 border border-blue-200'
                        break
                    case 'secondary':
                        variantClasses = 'bg-white text-gray-700 border border-gray-200'
                        break
                    case 'success':
                        variantClasses = 'bg-white text-green-700 border border-green-200'
                        break
                    case 'danger':
                        variantClasses = 'bg-white text-red-700 border border-red-200'
                        break
                    case 'warning':
                        variantClasses = 'bg-white text-yellow-700 border border-yellow-200'
                        break
                    case 'info':
                        variantClasses = 'bg-white text-cyan-700 border border-cyan-200'
                        break
                    case 'light':
                        variantClasses = 'bg-white text-gray-700 border border-gray-200'
                        break
                    case 'dark':
                        variantClasses = 'bg-white text-gray-900 border border-gray-300'
                        break
                }
            } else {
                switch (props.variant) {
                    case 'primary':
                        variantClasses = 'bg-blue-100 text-blue-800'
                        break
                    case 'secondary':
                        variantClasses = 'bg-gray-100 text-gray-800'
                        break
                    case 'success':
                        variantClasses = 'bg-green-100 text-green-800'
                        break
                    case 'danger':
                        variantClasses = 'bg-red-100 text-red-800'
                        break
                    case 'warning':
                        variantClasses = 'bg-yellow-100 text-yellow-800'
                        break
                    case 'info':
                        variantClasses = 'bg-cyan-100 text-cyan-800'
                        break
                    case 'light':
                        variantClasses = 'bg-gray-50 text-gray-600'
                        break
                    case 'dark':
                        variantClasses = 'bg-gray-800 text-gray-100'
                        break
                }
            }

            const roundedClasses = props.rounded ? 'rounded-full' : 'rounded-md'

            return `${baseClasses} ${sizeClasses} ${variantClasses} ${roundedClasses}`.trim()
        })

        return {
            badgeClasses
        }
    }
}
</script>
