<template>
    <div>
        <h1 class="text-xl font-bold m-4">Rooms</h1>

        <table class="text-left w-full">
            <thead class="bg-blue-500 flex text-white w-full">
                <tr class="flex w-full mb-4">
                    <th class="p-2 w-1/4">Room Type</th>
                    <th class="p-2 w-1/4">Room Price</th>
                    <th class="p-2 w-1/4">Status</th>
                    <th class="p-2 w-1/4">Action</th>
                </tr>
            </thead>
            <tbody class="bg-grey-light flex flex-col items-center text-left overflow-y-scroll w-full" style="height: 50vh;">
                <tr v-for="roomType in roomTypes" v-bind:key="roomType.id" class="flex w-full mb-4" >
                    <td class="p-2 w-1/4 break-words">{{roomType.name}}</td>
                    <td class="p-2 w-1/4">{{roomType.price}}</td>
                    <td class="p-2 w-1/4">{{roomType.is_active ? 'Active' : 'Inactive'}}</td>
                    <td class="p-2 w-1/4">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 border border-blue-700 rounded mr-1" @click="editRoom(roomType)">Edit</button>
                        <button class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 border border-red-700 rounded" @click="deleteRoomConfirm(roomType)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
        
    </div>
    <!-- Log Out Other Devices Confirmation Modal -->
            <jet-dialog-modal :show="confirmingDelete">
                <template #title>
                    Delete {{ delRoomType.name }}
                </template>

                <template #content>
                    You are about to delete {{ delRoomType.name }} room.
                </template>

                <template #footer>
                    <jet-button style="margin-right:10px;background:green" @click="closeModal()">
                        No
                    </jet-button>
                    <jet-button style="background:red" @click="closeModal(delRoomType)">
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
    props: ['roomTypes'],
    data: function () {
        return {
            confirmingDelete: false,
            delRoomTypeId: '',
        }
    },
    methods:{
        deleteRoomConfirm(roomType) {
            this.confirmingDelete = true;
            this.delRoomType = roomType;
        },
        deleteRoomType(roomType){
            this.$emit('deleteRoomType', roomType.id);
        },
        closeModal(roomType){
            if (roomType) {
                this.deleteRoomType(roomType);
            }
            this.confirmingDelete = false;
        },
    }
})
</script>
