<template>
<div>
    <div v-if="label || showPercentage" class="flex justify-between mb-1">
        <span v-if="label" class="text-sm font-medium text-gray-700">{{ label }}</span>
        <span v-if="showPercentage" class="text-sm text-gray-500">{{ Math.round(percentage) }}%</span>
    </div>
    <div :class="progressBarClasses">
        <div :class="progressFillClasses" :style="{ width: `${percentage}%` }" role="progressbar" :aria-valuenow="value" :aria-valuemin="min" :aria-valuemax="max">
            <span v-if="showValue && size !== 'sm'" class="px-2 text-xs font-medium text-white">
                {{ value }}/{{ max }}
            </span>
        </div>
    </div>
    <p v-if="description" class="mt-1 text-sm text-gray-500">{{ description }}</p>
</div>
</template>

<script>
import {
    computed
} from 'vue'

export default {
    name: 'TwProgress',
    props: {
        value: {
            type: Number,
            required: true
        },
        max: {
            type: Number,
            default: 100
        },
        min: {
            type: Number,
            default: 0
        },
        label: {
            type: String,
            default: ''
        },
        description: {
            type: String,
            default: ''
        },
        color: {
            type: String,
            default: 'blue',
            validator: (value) => ['blue', 'green', 'red', 'yellow', 'purple', 'pink', 'gray'].includes(value)
        },
        size: {
            type: String,
            default: 'md',
            validator: (value) => ['sm', 'md', 'lg'].includes(value)
        },
        showPercentage: {
            type: Boolean,
            default: false
        },
        showValue: {
            type: Boolean,
            default: false
        },
        striped: {
            type: Boolean,
            default: false
        },
        animated: {
            type: Boolean,
            default: false
        }
    },
    setup(props) {
        const percentage = computed(() => {
            const range = props.max - props.min
            const progress = props.value - props.min
            return Math.min(Math.max((progress / range) * 100, 0), 100)
        })

        const progressBarClasses = computed(() => {
            const baseClasses = 'w-full bg-gray-200 rounded-full overflow-hidden'

            let sizeClasses = ''
            switch (props.size) {
                case 'sm':
                    sizeClasses = 'h-2'
                    break
                case 'lg':
                    sizeClasses = 'h-6'
                    break
                default:
                    sizeClasses = 'h-4'
            }

            return `${baseClasses} ${sizeClasses}`.trim()
        })

        const progressFillClasses = computed(() => {
            const baseClasses = 'h-full flex items-center justify-center text-center transition-all duration-300 ease-in-out'

            let colorClasses = ''
            switch (props.color) {
                case 'green':
                    colorClasses = 'bg-green-600'
                    break
                case 'red':
                    colorClasses = 'bg-red-600'
                    break
                case 'yellow':
                    colorClasses = 'bg-yellow-600'
                    break
                case 'purple':
                    colorClasses = 'bg-purple-600'
                    break
                case 'pink':
                    colorClasses = 'bg-pink-600'
                    break
                case 'gray':
                    colorClasses = 'bg-gray-600'
                    break
                default:
                    colorClasses = 'bg-blue-600'
            }

            const stripedClasses = props.striped ? 'bg-gradient-to-r from-transparent to-white bg-[length:1rem_1rem]' : ''
            const animatedClasses = props.animated ? 'animate-pulse' : ''

            return `${baseClasses} ${colorClasses} ${stripedClasses} ${animatedClasses}`.trim()
        })

        return {
            percentage,
            progressBarClasses,
            progressFillClasses
        }
    }
}
</script>
