<template>
    <Layout>
        <div class="bg-white p-6">
            {{ user.link }}
            <h1 class="text-lg font-black">Hello {{ user.username }}</h1>
            <p>Expired - <span :date="user.expired_at">{{ user.expired_at }}</span></p>
            <div>
                <button @click="generateNewLink" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-6 rounded">
                    Generate new link
                </button>
                <button @click="imFeelingLucky" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-6 rounded">
                    Imfeelinglucky
                </button>
                <button @click="history" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-6 rounded">
                    History
                </button>
                <button @click="deactivateLink" style="background: darkred" class="text-white font-bold py-2 px-4 m-6 rounded">
                    Deactivate link
                </button>
            </div>
            <article v-if="imFeelingLuckyData">
                <p>Number - <span>{{ imFeelingLuckyData.number }}</span></p>
                <p>You <span>{{ imFeelingLuckyData.win ? 'Win' : 'Lose' }}</span></p>
                <p>Sum - <span>{{ imFeelingLuckyData.sum }}</span></p>
                <p>Total - <span>{{ imFeelingLuckyData.total }}</span></p>
            </article>
            <hr>
            <div v-if="imFeelingLuckyHistory">
                <h2 class="text-lg font-bold">Last 3 plays</h2>
                <hr>
                <article v-for="item in imFeelingLuckyHistory" :key="item.id">
                    <p>Number - <span>{{ item.number }}</span></p>
                    <p>You <span>{{ item.win ? 'Win' : 'Lose' }}</span></p>
                    <p>Sum - <span>{{ item.sum }}</span></p>
                    <p>Total - <span>{{ item.total }}</span></p>
                    <p>Date - <span>{{ item.created_at }}</span></p>
                    <hr>
                </article>
            </div>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Layouts/Layout.vue";
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Layout,
        Link
    },
    props: {
      user: Object
    },
    data() {
        return {
            link: this.user.link,
            imFeelingLuckyData: null,
            imFeelingLuckyHistory: null
        }
    },
    methods: {
        generateNewLink() {
            this.$inertia.post(`/user/${this.user.id}/generateNewToken`)
        },
        deactivateLink() {
            if (confirm('Deactivate your link?')) {
                this.$inertia.post(`/user/${this.user.id}/deactivateToken`)
            }
        },
        imFeelingLucky() {
            axios.post(`/user/${this.user.id}/imFeelingLucky`)
                .then(res => {
                    this.imFeelingLuckyData = res.data;
                })
        },
        history() {
            axios.get(`/user/${this.user.id}/imFeelingLucky/history`)
                .then(res => {
                    this.imFeelingLuckyHistory = res.data;
                })
        }
    }
}
</script>
