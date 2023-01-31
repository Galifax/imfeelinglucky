<template>
    <!-- Page Content -->
    <main class="min-h-screen bg-gray-100 dark:bg-slate-900 pt-4">
        <article class="max-w-7xl mx-auto">
            <slot />
        </article>
    </main>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Link,
    }
}
</script>
