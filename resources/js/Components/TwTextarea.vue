<template>
<div class="mb-4">
    <label v-if="label" :for="id" class="block text-sm font-medium text-gray-700 mb-2">
        {{ label }}
        <span v-if="required" class="text-red-500">*</span>
    </label>
    <textarea :id="id" :placeholder="placeholder" :value="modelValue" :disabled="disabled" :readonly="readonly" :required="required" :rows="rows" :maxlength="maxlength" @input="$emit('update:modelValue', $event.target.value)" @blur="$emit('blur', $event)" @focus="$emit('focus', $event)" :class="textareaClasses"></textarea>
    <div v-if="maxlength" class="flex justify-between mt-1">
        <p v-if="error" class="text-sm text-red-600">{{ error }}</p>
        <p v-else-if="hint" class="text-sm text-gray-500">{{ hint }}</p>
        <div v-if="!error" class="text-sm text-gray-500">
            {{ modelValue.length }}/{{ maxlength }}
        </div>
    </div>
    <p v-else-if="error" class="mt-2 text-sm text-red-600">{{ error }}</p>
    <p v-else-if="hint" class="mt-2 text-sm text-gray-500">{{ hint }}</p>
</div>
</template>

<script>
import {
    computed
} from 'vue'

export default {
    name: 'TwTextarea',
    emits: ['update:modelValue', 'blur', 'focus'],
    props: {
        modelValue: {
            type: String,
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
        rows: {
            type: Number,
            default: 3
        },
        maxlength: {
            type: Number,
            default: null
        },
        resize: {
            type: String,
            default: 'vertical',
            validator: (value) => ['none', 'both', 'horizontal', 'vertical'].includes(value)
        },
        id: {
            type: String,
            default: () => 'textarea-' + Math.random().toString(36).substr(2, 9)
        }
    },
    setup(props) {
        const textareaClasses = computed(() => {
            const baseClasses = 'block w-full rounded-md border-0 py-1.5 px-3 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 transition-colors duration-200'

            let resizeClasses = ''
            switch (props.resize) {
                case 'none':
                    resizeClasses = 'resize-none'
                    break
                case 'both':
                    resizeClasses = 'resize'
                    break
                case 'horizontal':
                    resizeClasses = 'resize-x'
                    break
                default:
                    resizeClasses = 'resize-y'
            }

            let colorClasses = ''
            if (props.error) {
                colorClasses = 'ring-red-300 focus:ring-red-500'
            } else {
                colorClasses = 'ring-gray-300 focus:ring-blue-500'
            }

            const disabledClasses = props.disabled ? 'opacity-50 cursor-not-allowed bg-gray-100' : 'bg-white'

            return `${baseClasses} ${resizeClasses} ${colorClasses} ${disabledClasses}`.trim()
        })

        return {
            textareaClasses
        }
    }
}
</script>
