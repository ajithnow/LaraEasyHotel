<template>
<h1 class="text-xl font-bold m-4">Add Room</h1>
<div class="p-3">
    <form class="form-horizontal" id="formnew" @submit.prevent="addRoom">
        <div class="py-3">
            <jet-label for="room_name" value="Room Name" />
            <input id="room_name" name="room_name" ref="room_name" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>
        <div class="py-3">
            <jet-label for="is_active" value="Active" />
            <select id="is_active" name="is_active" ref="is_active" required>
                <option value="1" selected>Yes</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="py-3">
            <jet-label for="room_type" value="Room Type" />
            <select class="shadow bg-white top-100 z-40 lef-0 rounded max-h-select overflow-y-auto" id="room_type" name="room_type" ref="room_type_id" required>
                <option v-for="type in roomTypes" :value="type.id" v-bind:key="type.id">{{type.name}}</option>
            </select>
        </div>

        <div class="mt-4">
            <jet-button>
                    Save Room
            </jet-button>
        </div>
    </form>
</div>
 <!-- Log Out Other Devices Confirmation Modal -->
            <jet-dialog-modal :show="confirmingAdd">
                <template #title>
                    {{addStatus}}
                </template>

                <template #content>
                    You have successfully added a new room.
                </template>

                <template #footer>
                    <jet-button @click="closeModal">
                        Okay
                    </jet-button>
                </template>
            </jet-dialog-modal>
    
</template>

<script>
import { defineComponent } from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetDropdown from '@/Jetstream/Dropdown.vue'

export default defineComponent({
  components: { 
        JetButton,
        JetInput,
        JetLabel,
        JetDialogModal,
        JetDropdown
    },
    data() {
        return {
            confirmingAdd: false,
            addStatus: '',
            roomTypes: [],
        }
    },
    mounted() {
        this.getRoomTypes();
    },
    methods: {
        closeModal() {
            this.confirmingAdd = false;
            this.$emit('itemAdded');
        },
        addRoom() {
            let room = {
                room_name: this.$refs.room_name.value,
                is_active: this.$refs.is_active.value,
                room_type_id: this.$refs.room_type_id.value,
            }
            axios.post('/addroom', room)
            .then((response)=> {
                this.confirmingAdd = true;
                this.addStatus = "Room Added";
            })
            .catch(function (error) {
              console.log(error);
            });
        },
        getRoomTypes() {
            axios.get('/getroomtypes')
            .then((response)=> {
                this.roomTypes = response.data;
            })
            .catch(function (error) {
              console.log(error);
            });
        }
    }
})
</script>

