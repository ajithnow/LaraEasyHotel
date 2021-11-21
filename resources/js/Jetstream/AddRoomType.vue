<template>
<div class="p-3">
    <form class="form-horizontal" id="formnew" @submit.prevent="addRoom">
        <div>
            <jet-label for="room_type_name" value="Type" />
            <input id="room_type_name" name="room_type_name" ref="room_type_name" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>
        <div>
            <jet-label for="room_type_desc" value="Description" />
            <input id="room_type_desc" name="room_type_desc" ref="room_type_desc" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>
        <div>
            <jet-label for="room_type_price" value="Price" />
            <input id="room_type_price" name="room_type_price" ref="room_type_price" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>
        <div>
            <jet-label for="room_type_max_guests" value="Max Guests" />
            <input id="room_type_max_guests" name="room_type_max_guests" ref="room_type_max_guests" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>
        <div>
            <jet-label for="room_type_max_children" value="Max Children" />
            <input id="room_type_max_children" name="room_type_max_children" ref="room_type_max_children" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>
        <div>
            <jet-label for="room_type_extra_bed_price" value="Price" />
            <input id="room_type_extra_bed_price" name="room_type_extra_bed_price" ref="room_type_extra_bed_price" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>
        <div>
            <jet-label for="room_type_is_active" value="Active" />
            <input id="room_type_is_active" name="room_type_is_active" ref="room_type_is_active" type="text" class="mt-1 block w-full"  required autofocus/>
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
            this.$emit('typeAdded');
        },
        addRoom() {
            let roomType = {
                room_type_name: this.$refs.room_type_name.value,
                room_type_desc: this.$refs.room_type_desc.value,
                room_type_price: this.$refs.room_type_price.value,
                room_type_max_guests: this.$refs.room_type_max_guests.value,
                room_type_max_children: this.$refs.room_type_max_children.value,
                room_type_extra_bed_price: this.$refs.room_type_extra_bed_price.value,
                room_type_is_active: this.$refs.room_type_is_active.value,
            }
            axios.post('/addroomtype', roomType)
            .then((response)=> {
                this.confirmingAdd = true;
                this.addStatus = "Room Type Added";
            })
            .catch(function (error) {
              console.log(error);
            }).then;
        }
    }
})
</script>
