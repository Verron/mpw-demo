<script lang="ts" setup>
import {useEventStore} from "@/stores/event";
import {useRoute} from "vue-router";
import {storeToRefs} from "pinia";
import EventForm from "@/components/EventForm.vue";
import {onMounted} from "vue";

const {event} = storeToRefs(useEventStore());

const $route = useRoute();

const id = $route.params.id;

const fetchEvent = async () => {
    const url = `${import.meta.env.VITE_API_HOST}/api/v1/events/${id}`;

    const result = await fetch(url);

    const data = (await result.json()).data;

    event.value = {
        ...event.value,
        name: data.name,
        email: data.email,
        date: data.date,
        type: data.type,
        details: data.details,
        newsletter: data.newsletter,
    };


};

onMounted(() => {
    fetchEvent()
});


</script>

<template>
    <main>
        <EventForm title="Edit Registration" :id="id" />
    </main>
</template>