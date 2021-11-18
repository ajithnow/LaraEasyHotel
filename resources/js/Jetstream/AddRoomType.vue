<template>
<div class="p-3">
    <form class="form-horizontal" id="formnew" @submit.prevent="addRoom">
        <div>
            <jet-label for="room_name" value="Room Name" />
            <input id="room_name" name="room_name" ref="room_name" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>
        <div>
            <jet-label for="is_active" value="Active" />
            <input id="is_active" name="is_active" ref="is_active" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>
        <div>
            <jet-label for="room_type" value="Room Type" />
            <input id="room_type" name="room_type" ref="room_type_id" type="text" class="mt-1 block w-full"  required autofocus/>
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

export default defineComponent({
  components: { 
        JetButton,
        JetInput,
        JetLabel,
        JetDialogModal
    },
    data() {
        return {
            confirmingAdd: false,
            addStatus: '',
        }
    },
    methods: {
        closeModal() {
            this.confirmingAdd = false;
        },
        addRoom() {
            let room = {
                room_type_name: this.$refs.room_name.value,
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
            }).then;
        }
    }
})
</script>
