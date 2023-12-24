<script setup lang="ts">
import EventForm from "@/components/EventForm.vue";
import {useEventStore} from "@/stores/event";
import {storeToRefs} from "pinia";

const {event} = storeToRefs(useEventStore());

event.value = {
    name: "",
    email: "",
    date: "",
    type: null,
    details: "",
    newsletter: false,
};
</script>

<template>
  <main>
      <EventForm title="Register Event" />
  </main>
</template>
