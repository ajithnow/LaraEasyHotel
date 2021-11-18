<template>
    <div>
        <h1 class="text-xl font-bold m-4">Rooms</h1>

        <table class="text-left w-full">
            <thead class="bg-blue-500 flex text-white w-full">
                <tr class="flex w-full mb-4">
                    <th class="p-2 w-1/4">Room Name</th>
                    <th class="p-2 w-1/4">Room Type</th>
                    <th class="p-2 w-1/4">Status</th>
                    <th class="p-2 w-1/4">Action</th>
                </tr>
            </thead>
            <tbody class="bg-grey-light flex flex-col items-center text-left justify-between overflow-y-scroll w-full" style="height: 50vh;">
                <tr v-for="room in rooms" v-bind:key="room.id" class="flex w-full mb-4" >
                    <td class="p-2 w-1/4 break-words">{{room.name}}</td>
                    <td class="p-2 w-1/4">{{room.roomType}}</td>
                    <td class="p-2 w-1/4">{{room.is_active ? 'Active' : 'Not Active'}}</td>
                    <td class="p-2 w-1/4">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 border border-blue-700 rounded mr-1" @click="editRoom(room)">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 border border-red-700 rounded" @click="deleteRoomConfirm(room)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
    <!-- Log Out Other Devices Confirmation Modal -->
            <jet-dialog-modal :show="confirmingDelete">
                <template #title>
                    Delete {{ delRoom.name }}
                </template>

                <template #content>
                    You are about to delete {{ delRoom.name }} room.
                </template>

                <template #footer>
                    <jet-button style="margin-right:10px;background:green" @click="closeModal()">
                        No
                    </jet-button>
                    <jet-button style="background:red" @click="closeModal(delRoom)">
                        Okay
                    </jet-button>
                </template>
            </jet-dialog-modal>
</template>



<script>
import { defineComponent } from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'

export default defineComponent({
    components: {
        JetDialogModal,
        JetButton,
    },
    props: ['rooms'],
    data: function () {
        return {
            confirmingDelete: false,
            delRoomId: '',
        }
    },
    methods:{
        deleteRoomConfirm(room) {
            this.confirmingDelete = true;
            this.delRoom = room;
        },
        deleteRoom(room){
            this.$emit('deleteRoom', room.id);
        },
        closeModal(room){
            if (room) {
                this.deleteRoom(room);
            }
            this.confirmingDelete = false;
        },
    }
})
</script>
