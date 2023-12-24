<script setup lang="ts">
import {onMounted, ref} from "vue";
import type {Event, EventType} from "@/types";
import {RouterLink} from "vue-router";

const events = ref<Event[]>([]);

const typeImages: Record<EventType, string> = {
    birthday: "https://images.unsplash.com/photo-1510924199351-4e9d94df18a6?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
    corporate: "https://images.unsplash.com/photo-1561489396-888724a1543d?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
    other: "https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
    wedding: "https://plus.unsplash.com/premium_photo-1681841263726-118093874fda?q=80&w=800&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
};

const fetchEvents = async () => {
    const url = `${import.meta.env.VITE_API_HOST}/api/v1/events`;

    const result = await fetch(url);

    const data = (await result.json()).data;

    events.value = data.map((event: any) => {
        return {
            ...event,
            lastSeen: event.lastSeen ? new Date(event.lastSeen).toLocaleString() : null,
            lastSeenDateTime: event.lastSeen ? new Date(event.lastSeen).toISOString() : null,
        }
    });
};

onMounted(() => {
    fetchEvents();
});

</script>

<template>
    <div class="max-w-2xl mx-auto">
        <div class="py-12">
            <div class="flex">
                <div class="flex-1">
                    <h1 class="text-2xl">Event List</h1>
                </div>
                <div class="flex-shrink">
                    <RouterLink to="/create" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-500 focus:outline-none focus:border-emerald-700 focus:shadow-outline-emerald active:bg-emerald-700 transition duration-150 ease-in-out">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M10 12a2 2 0 100-4 2 2 0 000 4zM3 10a7 7 0 1114 0 7 7 0 01-14 0zm7-5a5 5 0 00-5 5h2a3 3 0 016 0h2a5 5 0 00-5-5z"/>
                        </svg>
                        Create
                    </RouterLink>
                </div>
            </div>
        </div>
        <ul role="list" class="divide-y divide-gray-100 dark:divide-gray-700">
            <RouterLink v-for="event in events" :key="event.email" :to="`/${event.id}`">
                <li class="flex justify-between gap-x-6 py-5 border border-transparent my-3 p-4 hover:border-gray-400 dark:hover:border-gray-600">
                    <div class="flex min-w-0 gap-x-4">
                        <img class="h-12 w-12 flex-none rounded-full bg-gray-50" :src="typeImages[event.type ?? 'other']" alt=""/>
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">{{ event.name }}</p>
                            <p class="mt-1 truncate text-xs leading-5 text-gray-500 dark:text-gray-400">{{ event.email }}</p>
                        </div>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm leading-6 text-gray-900 dark:text-white">{{ event.type }}</p>
                        <p v-if="event.date" class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400">
                            Last seen
                            <time :datetime="event.date">{{ event.date }}</time>
                        </p>
                        <div v-else class="mt-1 flex items-center gap-x-1.5">
                            <div class="flex-none rounded-full bg-emerald-500/20 p-1">
                                <div class="h-1.5 w-1.5 rounded-full bg-emerald-500"/>
                            </div>
                            <p class="text-xs leading-5 text-gray-500">Online</p>
                        </div>
                    </div>
                </li>
            </RouterLink>
        </ul>
    </div>
</template>

<style scoped>

</style>