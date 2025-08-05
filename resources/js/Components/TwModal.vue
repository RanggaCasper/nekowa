<template>
<Teleport to="body">
    <Transition enter-active-class="duration-300 ease-out" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="duration-200 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
        <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black/10 bg-opacity-50 transition-opacity" @click="closeOnBackdrop && close()"></div>

                <!-- Modal panel -->
                <Transition enter-active-class="duration-300 ease-out" enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="duration-200 ease-in" leave-from-class="opacity-100 translate-y-0 sm:scale-100" leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div v-if="show" :class="modalClasses" role="dialog" aria-modal="true">
                        <!-- Header -->
                        <div v-if="$slots.header || title || closable" class="flex items-center justify-between p-6 border-b border-gray-200">
                            <div>
                                <h3 v-if="title" class="text-lg font-medium leading-6 text-gray-900">
                                    {{ title }}
                                </h3>
                                <slot name="header"></slot>
                            </div>
                            <button v-if="closable" type="button" @click="close" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <span class="sr-only">Close</span>
                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                            </button>
                        </div>

                        <!-- Body -->
                        <div :class="bodyClasses">
                            <slot></slot>
                        </div>

                        <!-- Footer -->
                        <div v-if="$slots.footer" class="flex items-center justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50">
                            <slot name="footer"></slot>
                        </div>
                    </div>
                </Transition>
            </div>
        </div>
    </Transition>
</Teleport>
</template>

<script>
import {
    computed,
    watch
} from 'vue'
import {
    XMarkIcon
} from '@heroicons/vue/24/outline'

export default {
    name: 'TwModal',
    components: {
        XMarkIcon
    },
    emits: ['close', 'update:show'],
    props: {
        show: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: 'md',
            validator: (value) => ['xs', 'sm', 'md', 'lg', 'xl', '2xl', 'full'].includes(value)
        },
        closable: {
            type: Boolean,
            default: true
        },
        closeOnBackdrop: {
            type: Boolean,
            default: true
        },
        padding: {
            type: String,
            default: 'md',
            validator: (value) => ['none', 'sm', 'md', 'lg', 'xl'].includes(value)
        }
    },
    setup(props, {
        emit
    }) {
        const modalClasses = computed(() => {
            const baseClasses = 'relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all'

            let sizeClasses = ''
            switch (props.size) {
                case 'xs':
                    sizeClasses = 'sm:w-full sm:max-w-xs'
                    break
                case 'sm':
                    sizeClasses = 'sm:w-full sm:max-w-sm'
                    break
                case 'lg':
                    sizeClasses = 'sm:w-full sm:max-w-lg'
                    break
                case 'xl':
                    sizeClasses = 'sm:w-full sm:max-w-xl'
                    break
                case '2xl':
                    sizeClasses = 'sm:w-full sm:max-w-2xl'
                    break
                case 'full':
                    sizeClasses = 'sm:w-full sm:max-w-full sm:m-4'
                    break
                default:
                    sizeClasses = 'sm:w-full sm:max-w-md'
            }

            return `${baseClasses} ${sizeClasses}`.trim()
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

        const close = () => {
            emit('update:show', false)
            emit('close')
        }

        // Handle escape key
        const handleEscape = (e) => {
            if (e.key === 'Escape' && props.show && props.closable) {
                close()
            }
        }

        watch(() => props.show, (newVal) => {
            if (newVal) {
                document.addEventListener('keydown', handleEscape)
                document.body.style.overflow = 'hidden'
            } else {
                document.removeEventListener('keydown', handleEscape)
                document.body.style.overflow = ''
            }
        })

        return {
            modalClasses,
            bodyClasses,
            close
        }
    }
}
</script>
