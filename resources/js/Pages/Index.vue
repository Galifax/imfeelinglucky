<template>
    <Layout>
        <div class="w-full max-w-xs mx-auto">
            <form @submit.prevent="form.post('/user/register')" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input v-model="form.username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                    <div  class="text-red-400" v-if="form.errors.username">{{ form.errors.username }}</div>
<!--                    <ul v-if="isset(errors, 'errors.username') === true">-->
<!--                        <li class="text-red-400" v-for="item in errors.errors.username"> {{ item }}</li>-->
<!--                    </ul>-->
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phonenumber">
                        Phonenumber
                    </label>
                    <input v-model="form.phonenumber" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phonenumber" type="text" placeholder="Phonenumber">
                    <div  class="text-red-400" v-if="form.errors.phonenumber">{{ form.errors.phonenumber }}</div>

                    <!--                    <ul v-if="isset(errors, 'errors.phonenumber') === true">-->
<!--                        <li class="text-red-400" v-for="item in errors.errors.phonenumber"> {{ item }}</li>-->
<!--                    </ul>-->
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Layouts/Layout.vue";
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'
import _ from 'lodash';

export default {
    components: {
        Layout,
        Link
    },
    data() {
        return {
            errors: null,
            link: null,
            form: useForm ({
                username: '',
                phonenumber: '',
            })
        }
    },
    methods: {
        // submit() {
        //     this.errors = null;
        //     this.$inertia.post('/user/register', this.form);
        // },
        isset(obj, keys) {
            return _.has(obj, keys);
        }
    }
}
</script>
