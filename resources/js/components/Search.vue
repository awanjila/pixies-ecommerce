<template>
    <div>
        <desktop-search v-if="!isMobile" />
        <mobile-search v-else />
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'
import DesktopSearch from './DesktopSearch.vue'
import MobileSearch from './MobileSearch.vue'

export default {
    name: 'Search',
    components: {
        DesktopSearch,
        MobileSearch
    },
    setup() {
        const isMobile = ref(false)

        const checkMobile = () => {
            isMobile.value = window.innerWidth < 768
        }

        onMounted(() => {
            checkMobile()
            window.addEventListener('resize', checkMobile)
        })

        onUnmounted(() => {
            window.removeEventListener('resize', checkMobile)
        })

        return {
            isMobile
        }
    }
}
</script> 