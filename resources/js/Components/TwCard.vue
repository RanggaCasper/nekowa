<template>
<div :class="cardClasses">
    <div v-if="$slots.header || title" class="px-6 py-4 border-b border-gray-200">
        <div v-if="title" class="text-lg font-medium text-gray-900">{{ title }}</div>
        <slot name="header"></slot>
    </div>

    <div :class="bodyClasses">
        <slot></slot>
    </div>

    <div v-if="$slots.footer" class="px-6 py-4 border-t border-gray-200 bg-gray-50">
        <slot name="footer"></slot>
    </div>
</div>
</template>

<script>
import {
    computed
} from 'vue'

export default {
    name: 'TwCard',
    props: {
        title: {
            type: String,
            default: ''
        },
        shadow: {
            type: String,
            default: 'md',
            validator: (value) => ['none', 'sm', 'md', 'lg', 'xl'].includes(value)
        },
        bordered: {
            type: Boolean,
            default: false
        },
        padding: {
            type: String,
            default: 'md',
            validator: (value) => ['none', 'sm', 'md', 'lg', 'xl'].includes(value)
        },
        rounded: {
            type: String,
            default: 'md',
            validator: (value) => ['none', 'sm', 'md', 'lg', 'xl', 'full'].includes(value)
        }
    },
    setup(props) {
        const cardClasses = computed(() => {
            const baseClasses = 'bg-white overflow-hidden'

            let shadowClasses = ''
            switch (props.shadow) {
                case 'none':
                    shadowClasses = ''
                    break
                case 'sm':
                    shadowClasses = 'shadow-sm'
                    break
                case 'lg':
                    shadowClasses = 'shadow-lg'
                    break
                case 'xl':
                    shadowClasses = 'shadow-xl'
                    break
                default:
                    shadowClasses = 'shadow-md'
            }

            let roundedClasses = ''
            switch (props.rounded) {
                case 'none':
                    roundedClasses = ''
                    break
                case 'sm':
                    roundedClasses = 'rounded-sm'
                    break
                case 'lg':
                    roundedClasses = 'rounded-lg'
                    break
                case 'xl':
                    roundedClasses = 'rounded-xl'
                    break
                case 'full':
                    roundedClasses = 'rounded-full'
                    break
                default:
                    roundedClasses = 'rounded-md'
            }

            const borderClasses = props.bordered ? 'border border-gray-200' : ''

            return `${baseClasses} ${shadowClasses} ${roundedClasses} ${borderClasses}`.trim()
        })

        const bodyClasses = computed(() => {
            let paddingClasses = ''
            switch (props.padding) {
                case 'none':
                    paddingClasses = ''
                    break
                case 'sm':
                    paddingClasses = 'p-4'
                    break
                case 'lg':
                    paddingClasses = 'p-8'
                    break
                case 'xl':
                    paddingClasses = 'p-12'
                    break
                default:
                    paddingClasses = 'p-6'
            }

            return paddingClasses
        })

        return {
            cardClasses,
            bodyClasses
        }
    }
}
</script>
