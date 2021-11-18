<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Rooms
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <AddRoom v-on:itemAdded="getRooms()"/>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <RoomsList :rooms="Rooms" v-on:deleteRoom="(e)=>deleteRoom(e)" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import AddRoom from '@/Jetstream/AddRoom.vue'
    import RoomsList from '@/Jetstream/RoomsList.vue'

    export default defineComponent({
        components: {
            AppLayout,
            AddRoom,
            RoomsList,
        },
        mounted: function () {
            this.getRooms();
        },
        data() {
            return {
                Rooms: [],
            }
        },
        methods: {
        getRooms() {
            axios.get('/getrooms')
            .then((response)=> {
                this.Rooms = response.data;
            })
            .catch(function (error) {
              console.log(error);
            });
        },
        deleteRoom(e) {
            axios.delete('/room/delete/'+e)
            .then((response)=> {
                this.Rooms = response.data;
            }).then(()=>{
                this.getRooms();
            })
            .catch(function (error) {
              console.log(error);
            });
        },
        },
    })
</script>
