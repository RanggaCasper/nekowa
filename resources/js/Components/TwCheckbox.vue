<template>
<div class="flex items-start">
    <div class="flex h-6 items-center">
        <input :id="id" type="checkbox" :checked="modelValue" :disabled="disabled" :required="required" @change="$emit('update:modelValue', $event.target.checked)" @blur="$emit('blur', $event)" @focus="$emit('focus', $event)" :class="checkboxClasses" />
    </div>
    <div v-if="label || $slots.default" class="ml-3 text-sm leading-6">
        <label :for="id" :class="labelClasses">
            <slot>{{ label }}</slot>
            <span v-if="required" class="text-red-500 ml-1">*</span>
        </label>
        <p v-if="description" class="text-gray-500">{{ description }}</p>
    </div>
</div>
<p v-if="error" class="mt-2 text-sm text-red-600">{{ error }}</p>
</template>

<script>
import {
    computed
} from 'vue'

export default {
    name: 'TwCheckbox',
    emits: ['update:modelValue', 'blur', 'focus'],
    props: {
        modelValue: {
            type: Boolean,
            default: false
        },
        label: {
            type: String,
            default: ''
        },
        description: {
            type: String,
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        },
        required: {
            type: Boolean,
            default: false
        },
        error: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'md',
            validator: (value) => ['sm', 'md', 'lg'].includes(value)
        },
        id: {
            type: String,
            default: () => 'checkbox-' + Math.random().toString(36).substr(2, 9)
        }
    },
    setup(props) {
        const checkboxClasses = computed(() => {
            let sizeClasses = ''
            switch (props.size) {
                case 'sm':
                    sizeClasses = 'h-3 w-3'
                    break
                case 'lg':
                    sizeClasses = 'h-5 w-5'
                    break
                default:
                    sizeClasses = 'h-4 w-4'
            }

            let colorClasses = ''
            if (props.error) {
                colorClasses = 'text-red-600 focus:ring-red-600 border-red-300'
            } else {
                colorClasses = 'text-blue-600 focus:ring-blue-600 border-gray-300'
            }

            const baseClasses = 'rounded border-gray-300 focus:ring-2 focus:ring-blue-600'
            const disabledClasses = props.disabled ? 'opacity-50 cursor-not-allowed' : ''

            return `${baseClasses} ${sizeClasses} ${colorClasses} ${disabledClasses}`.trim()
        })

        const labelClasses = computed(() => {
            const baseClasses = 'font-medium text-gray-900 cursor-pointer'
            const disabledClasses = props.disabled ? 'opacity-50 cursor-not-allowed' : ''

            return `${baseClasses} ${disabledClasses}`.trim()
        })

        return {
            checkboxClasses,
            labelClasses
        }
    }
}
</script>
