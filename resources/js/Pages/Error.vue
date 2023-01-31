<template>
    <Layout>
        <div class="bg-white shadow-mdpx-8 p-8 mb-4">
            <H1>{{ title }}</H1>
            <div>{{ description }}</div>
            <Link href="/">Home</Link>
        </div>
    </Layout>
</template>

<script>
import Layout from '@/Layouts/Layout.vue'
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Layout,
        Link
    },
    props: {
        status: Number,
    },
    computed: {
        title() {
            return {
                503: '503: Service Unavailable',
                500: '500: Server Error',
                404: '404: Page Not Found',
                403: '403: Forbidden',
            }[this.status]
        },
        description() {
            return {
                503: 'Sorry, we are doing some maintenance. Please check back soon.',
                500: 'Whoops, something went wrong on our servers.',
                404: 'Sorry, the page you are looking for could not be found.',
                403: 'Sorry, you are forbidden from accessing this page.',
            }[this.status]
        },
    },
}
</script>
