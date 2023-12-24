<script lang="ts" setup>
import {useEventStore} from "@/stores/event";
import {storeToRefs} from "pinia";
import {RouterLink, useRouter} from "vue-router";
import {ref} from "vue";

const props = defineProps<{
    title: string,
    id?: string,
}>()

const {event} = storeToRefs(useEventStore());

const router = useRouter();

const submitting = ref(false);

const submitEvent = async () => {
    submitting.value = true;

    try {
        if (props.id) {
            const url = `${import.meta.env.VITE_API_HOST}/api/v1/events/${props.id}`

            await fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(event.value)
            });

            return;
        } else {
            const url = `${import.meta.env.VITE_API_HOST}/api/v1/events`

            const result = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(event.value)
            });

            const data = await result.json();

            await router.push(`/${data.data.id}`);
        }
    } catch (e) {
    } finally {
        submitting.value = false;
    }
}
</script>

<template>
    <div class="max-w-2xl mx-auto">
        <div class="py-12">
            <div class="flex">
                <div class="flex-1">
                    <h1 class="text-2xl">{{ title}}</h1>
                </div>
                <div class="flex-shrink">
                    <RouterLink to="/" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-500 focus:outline-none focus:border-emerald-700 focus:shadow-outline-emerald active:bg-emerald-700 transition duration-150 ease-in-out">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M10 12a2 2 0 100-4 2 2 0 000 4zM3 10a7 7 0 1114 0 7 7 0 01-14 0zm7-5a5 5 0 00-5 5h2a3 3 0 016 0h2a5 5 0 00-5-5z"/>
                        </svg>
                        List
                    </RouterLink>
                </div>
            </div>
            <div class="mt-8">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block">
                            <span class="text-gray-700 dark:text-gray-50">Full name</span>
                            <input v-model="event.name" type="text"
                                   class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 dark:bg-gray-700 dark:focus:bg-gray-600 dark:focus:border-gray-700"
                                   placeholder="">
                        </label>
                    </div>
                    <div>
                        <label class="block">
                            <span class="text-gray-700 dark:text-gray-50">Email address</span>
                            <input v-model="event.email" type="email"
                                   class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 dark:bg-gray-700 dark:focus:bg-gray-600 dark:focus:border-gray-700"
                                   placeholder="john@example.com">
                        </label>
                    </div>
                    <div>
                        <label class="block">
                            <span class="text-gray-700 dark:text-gray-50">When is your event?</span>
                            <input v-model="event.date" type="date"
                                   class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 dark:bg-gray-700 dark:focus:bg-gray-600 dark:focus:border-gray-700">
                        </label>
                    </div>
                    <div>
                        <label class="block">
                            <span class="text-gray-700 dark:text-gray-50">What type of event is it?</span>
                            <select v-model="event.type"
                                    class="block w-full mt-1 rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 dark:bg-gray-700 dark:focus:bg-gray-600 dark:focus:border-gray-700">
                                <option value="corporate">Corporate event</option>
                                <option value="wedding">Wedding</option>
                                <option value="birthday">Birthday</option>
                                <option value="other">Other</option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <label class="block">
                            <span class="text-gray-700 dark:text-gray-50">Additional details</span>
                            <textarea v-model="event.details"
                                      class="mt-1 block w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 dark:bg-gray-700 dark:focus:bg-gray-600 dark:focus:border-gray-700"
                                      rows="3"></textarea>
                        </label>
                    </div>
                    <div class="block">
                        <div class="mt-2">
                            <div>
                                <label class="inline-flex items-center">
                                    <input v-model="event.newsletter" type="checkbox"
                                           class="rounded bg-gray-200 border-transparent focus:border-transparent focus:bg-gray-200 text-gray-700 focus:ring-1 focus:ring-offset-2 focus:ring-gray-500  dark:bg-gray-700 dark:focus:bg-gray-600 dark:focus:ring-gray-700">
                                    <span class="ml-2">Email me news and special offers</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <button @click="submitEvent" type="button" :disabled="submitting"
                                class="py-2 px-4  bg-indigo-800 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  dark:bg-indigo-700 dark:hover:bg-indigo-600 dark:focus:ring-indigo-700">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>