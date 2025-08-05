<template>
<div class="mb-4">
    <label v-if="label" :for="id" class="block text-sm font-medium text-gray-700 mb-2">
        {{ label }}
        <span v-if="required" class="text-red-500">*</span>
    </label>
    <div class="relative">
        <select :id="id" :value="modelValue" :disabled="disabled" :required="required" @change="$emit('update:modelValue', $event.target.value)" @blur="$emit('blur', $event)" @focus="$emit('focus', $event)" :class="selectClasses">
            <option v-if="placeholder" value="" disabled>{{ placeholder }}</option>
            <option v-for="option in normalizedOptions" :key="option.value" :value="option.value" :disabled="option.disabled">
                {{ option.label }}
            </option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
            <ChevronDownIcon class="h-4 w-4" aria-hidden="true" />
        </div>
    </div>
    <p v-if="error" class="mt-2 text-sm text-red-600">{{ error }}</p>
    <p v-if="hint && !error" class="mt-2 text-sm text-gray-500">{{ hint }}</p>
</div>
</template>

<script>
import {
    computed
} from 'vue'
import {
    ChevronDownIcon
} from '@heroicons/vue/20/solid'

export default {
    name: 'TwSelect',
    components: {
        ChevronDownIcon
    },
    emits: ['update:modelValue', 'blur', 'focus'],
    props: {
        modelValue: {
            type: [String, Number],
            default: ''
        },
        label: {
            type: String,
            default: ''
        },
        placeholder: {
            type: String,
            default: ''
        },
        options: {
            type: Array,
            required: true
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
        hint: {
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
            default: () => 'select-' + Math.random().toString(36).substr(2, 9)
        }
    },
    setup(props) {
        const normalizedOptions = computed(() => {
            return props.options.map(option => {
                if (typeof option === 'string' || typeof option === 'number') {
                    return {
                        label: option,
                        value: option,
                        disabled: false
                    }
                }
                return {
                    label: option.label || option.value,
                    value: option.value,
                    disabled: option.disabled || false
                }
            })
        })

        const selectClasses = computed(() => {
            const baseClasses = 'block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 appearance-none bg-white'

            let sizeClasses = ''
            switch (props.size) {
                case 'sm':
                    sizeClasses = 'py-1 text-sm'
                    break
                case 'lg':
                    sizeClasses = 'py-3 text-lg'
                    break
                default:
                    sizeClasses = 'py-1.5'
            }

            let colorClasses = ''
            if (props.error) {
                colorClasses = 'ring-red-300 focus:ring-red-500'
            } else {
                colorClasses = 'ring-gray-300 focus:ring-blue-500'
            }

            const disabledClasses = props.disabled ? 'opacity-50 cursor-not-allowed bg-gray-100' : ''

            return `${baseClasses} ${sizeClasses} ${colorClasses} ${disabledClasses}`.trim()
        })

        return {
            normalizedOptions,
            selectClasses
        }
    }
}
</script>
