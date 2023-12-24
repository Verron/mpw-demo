import {ref} from "vue";
import {defineStore} from "pinia";
import type {Event} from "@/types";


export const useEventStore = defineStore('event', () => {
    const event = ref<Event>({
        name: '',
        email: '',
        date: '',
        type: null,
        details: '',
        newsletter: false,
    });

    return {event}
});