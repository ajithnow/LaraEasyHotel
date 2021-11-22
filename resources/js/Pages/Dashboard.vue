<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <p class="mt-1 max-w-2xl text-xl leading-5 text-gray-500 p-2">
                            We have <span class="text-gray-900">{{ this.roomscount}}</span> rooms.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Welcome from '@/Jetstream/Welcome.vue'
    import axios from 'axios'

    export default defineComponent({
        components: {
            AppLayout,
            Welcome,
        },
        mounted(){
            this.getroomscount()
        },
        data() {
            return {
                roomscount: 0,
            }
        },
        methods: {
            getroomscount() {
                axios.get('rooms/count').then(response => {
                    this.roomscount = response.data;
                });
            },
        },
    })
</script>
