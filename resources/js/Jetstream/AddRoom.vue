<template>

    <form class="form-horizontal" id="formnew" @submit.prevent="addRoom">
        <div>
            <jet-label for="room_name" value="Room Name" />
            <input id="name" name="name" ref="name" type="text" class="mt-1 block w-full"  required autofocus/>
        </div>

        <div class="mt-4">
            <jet-button>
                    Save Room
            </jet-button>
        </div>
    </form>

    <!-- Log Out Other Devices Confirmation Modal -->
            <jet-dialog-modal :show="confirmingAdd">
                <template #title>
                    Log Out Other Browser Sessions
                </template>

                <template #content>
                    Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.

                    <div class="mt-4">
                        <jet-input type="password"/>

                        <jet-input-error  class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click="closeModal">
                        Cancel
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click="logoutOtherBrowserSessions">
                        Log Out Other Browser Sessions
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
        }
    },
    methods: {
        addRoom() {
            let room = {
                roomname: this.$refs.name.value,
            }
            this.$inertia.post(route('addroom'), room,{
                onFinish: () => {
                    this.confirmingAdd = true
                }
            })

        }
    }
})
</script>
