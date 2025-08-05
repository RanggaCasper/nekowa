<template>
<div class="mb-4">
    <label v-if="label" :for="id" class="block text-sm font-medium text-gray-700 mb-2">
        {{ label }}
        <span v-if="required" class="text-red-500">*</span>
    </label>
    <input :id="id" :type="type" :placeholder="placeholder" :value="modelValue" :disabled="disabled" :readonly="readonly" @input="$emit('update:modelValue', $event.target.value)" @blur="$emit('blur', $event)" @focus="$emit('focus', $event)" :class="inputClasses" />
    <p v-if="error" class="mt-2 text-xs text-red-600">{{ error }}</p>
    <p v-if="hint && !error" class="mt-2 text-xs text-gray-500">{{ hint }}</p>
</div>
</template>

<script>
import {
    computed
} from 'vue'

export default {
    name: 'TwInput',
    emits: ['update:modelValue', 'blur', 'focus'],
    props: {
        modelValue: {
            type: [String, Number],
            default: ''
        },
        type: {
            type: String,
            default: 'text'
        },
        label: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        },
        readonly: {
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
        hint: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'md',
            validator: (value) => ['sm', 'md', 'lg'].includes(value)
        },
        variant: {
            type: String,
            default: 'default',
            validator: (value) => ['default', 'filled', 'outlined'].includes(value)
        },
        id: {
            type: String,
            default: () => 'input-' + Math.random().toString(36).substr(2, 9)
        }
    },
    setup(props) {
        const inputClasses = computed(() => {
            const baseClasses = 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 placeholder:text-gray-400 focus:ring-2 sm:text-sm sm:leading-6 transition-colors duration-200'

            let sizeClasses = ''
            switch (props.size) {
                case 'sm':
                    sizeClasses = 'px-2 py-1 text-sm'
                    break
                case 'lg':
                    sizeClasses = 'px-4 py-3 text-lg'
                    break
                default:
                    sizeClasses = 'px-3 py-1.5'
            }

            let variantClasses = ''
            if (props.error) {
                variantClasses = 'ring-red-300 focus:ring-red-500'
            } else {
                switch (props.variant) {
                    case 'filled':
                        variantClasses = 'bg-gray-50 ring-gray-300 focus:ring-blue-500'
                        break
                    case 'outlined':
                        variantClasses = 'bg-white ring-gray-300 focus:ring-blue-500'
                        break
                    default:
                        variantClasses = 'bg-white ring-gray-300 focus:ring-blue-500'
                }
            }

            const disabledClasses = props.disabled ? 'opacity-50 cursor-not-allowed bg-gray-100' : ''

            return `${baseClasses} ${sizeClasses} ${variantClasses} ${disabledClasses}`.trim()
        })

        return {
            inputClasses
        }
    }
}
</script>
