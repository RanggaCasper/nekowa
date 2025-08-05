<template>
<div v-if="show" :class="alertClasses" role="alert">
    <div class="flex">
        <div>
            <h3 v-if="title" :class="titleClasses">{{ title }}</h3>
            <div :class="messageClasses">
                <slot>{{ message }}</slot>
            </div>
        </div>
        <div v-if="dismissible" class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button type="button" @click="dismiss" :class="dismissClasses">
                    <span class="sr-only">Dismiss</span>
                    <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                </button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    computed,
    ref
} from 'vue'
import {
    CheckCircleIcon,
    ExclamationTriangleIcon,
    XCircleIcon,
    InformationCircleIcon,
    XMarkIcon
} from '@heroicons/vue/20/solid'

export default {
    name: 'TwAlert',
    components: {
        CheckCircleIcon,
        ExclamationTriangleIcon,
        XCircleIcon,
        InformationCircleIcon,
        XMarkIcon
    },
    emits: ['dismiss'],
    props: {
        type: {
            type: String,
            default: 'info',
            validator: (value) => ['success', 'warning', 'error', 'info'].includes(value)
        },
        title: {
            type: String,
            default: ''
        },
        message: {
            type: String,
            default: ''
        },
        dismissible: {
            type: Boolean,
            default: false
        },
        bordered: {
            type: Boolean,
            default: false
        }
    },
    setup(props, {
        emit
    }) {
        const show = ref(true)
        
        const alertClasses = computed(() => {
            const baseClasses = 'rounded-md p-4'

            let typeClasses = ''
            switch (props.type) {
                case 'success':
                    typeClasses = 'bg-green-50'
                    break
                case 'warning':
                    typeClasses = 'bg-yellow-50'
                    break
                case 'error':
                    typeClasses = 'bg-red-50'
                    break
                default:
                    typeClasses = 'bg-blue-50'
            }

            const borderClasses = props.bordered ? 'border-l-4' : ''
            let borderColorClasses = ''
            if (props.bordered) {
                switch (props.type) {
                    case 'success':
                        borderColorClasses = 'border-green-400'
                        break
                    case 'warning':
                        borderColorClasses = 'border-yellow-400'
                        break
                    case 'error':
                        borderColorClasses = 'border-red-400'
                        break
                    default:
                        borderColorClasses = 'border-blue-400'
                }
            }

            return `${baseClasses} ${typeClasses} ${borderClasses} ${borderColorClasses}`.trim()
        })

        const titleClasses = computed(() => {
            let colorClasses = ''
            switch (props.type) {
                case 'success':
                    colorClasses = 'text-green-800'
                    break
                case 'warning':
                    colorClasses = 'text-yellow-800'
                    break
                case 'error':
                    colorClasses = 'text-red-800'
                    break
                default:
                    colorClasses = 'text-blue-800'
            }

            return `text-sm font-medium ${colorClasses}`.trim()
        })

        const messageClasses = computed(() => {
            let colorClasses = ''
            switch (props.type) {
                case 'success':
                    colorClasses = 'text-green-700'
                    break
                case 'warning':
                    colorClasses = 'text-yellow-700'
                    break
                case 'error':
                    colorClasses = 'text-red-700'
                    break
                default:
                    colorClasses = 'text-blue-700'
            }

            const sizeClasses = props.title ? 'text-sm mt-1' : 'text-sm'

            return `${sizeClasses} ${colorClasses}`.trim()
        })

        const dismissClasses = computed(() => {
            let colorClasses = ''
            switch (props.type) {
                case 'success':
                    colorClasses = 'bg-green-50 text-green-500 hover:bg-green-100 focus:ring-green-600'
                    break
                case 'warning':
                    colorClasses = 'bg-yellow-50 text-yellow-500 hover:bg-yellow-100 focus:ring-yellow-600'
                    break
                case 'error':
                    colorClasses = 'bg-red-50 text-red-500 hover:bg-red-100 focus:ring-red-600'
                    break
                default:
                    colorClasses = 'bg-blue-50 text-blue-500 hover:bg-blue-100 focus:ring-blue-600'
            }

            return `inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 ${colorClasses}`.trim()
        })

        const dismiss = () => {
            show.value = false
            emit('dismiss')
        }

        return {
            show,
            alertClasses,
            titleClasses,
            messageClasses,
            dismissClasses,
            dismiss
        }
    }
}
</script>
