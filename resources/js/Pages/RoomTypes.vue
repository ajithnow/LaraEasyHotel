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
                    <AddRoomType v-on:typeAdded="getRoomTypes()"/>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <RoomTypesList :roomTypes="RoomTypes" v-on:deleteRoom="(e)=>deleteRoom(e)" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import AddRoomType from '@/Jetstream/AddRoomType.vue'
    import RoomTypesList from '@/Jetstream/RoomTypesList.vue'

    export default defineComponent({
        components: {
            AppLayout,
            AddRoomType,
            RoomTypesList,
        },
        mounted: function () {
            this.getRoomTypes();
        },
        data() {
            return {
                RoomTypes: [],
            }
        },
        methods: {
        getRoomTypes() {
            axios.get('/getroomtypes')
            .then((response)=> {
                this.RoomTypes = response.data;
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
