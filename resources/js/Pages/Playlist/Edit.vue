<template>
    <MusicLayout>
        <template #title>
            <Link class="bg-blue-500 text-white px-4 py-2 rounded w-full" :href="route('playlist.create')">
                Ajouter une playlist
            </Link>
        </template>
        <template #action>
            <Link class="bg-blue-500 text-white px-4 py-2 rounded w-full" :href="route('playlist.index')">
                Retour
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submitForm">
                <div class="my-4">
                    <label for="title" class="block text-sm font-medium">Titre</label>
                    <input id="title" type="text" v-model="form.title" :class="{ 'border-red-300': form.errors.title }" class="mt-1 block w-full border rounded-md shadow-sm">
                    <p class="text-xs text-red-600">{{ form.errors.title }}</p>
                    <div v-for="track in tracks" :key="track.uuid">
                        <input :id="track.uuid" type="checkbox" :value="track.uuid" v-model="form.tracks" name="tracks" class="mr-5" :checked="form.tracks.includes(track.uuid)"></input>
                        <label :for="track.uuid">{{track.title}}</label>
                    </div>

                    <button type="submit" class="mt-6 px-4 py-2 text-white rounded-md transition duration-150 ease-in-out" :class="[form.processing ? 'bg-grey-500' : 'bg-blue-500 hover:bg-blue-600']" :disabled="form.processing">Modifier</button>
                </div>
            </form>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';

export default {
    name: 'Edit',
    components: {
        MusicLayout,
    },
    props:{
        playlist: Object,
        tracks: Array,
        currentTracks: Array
    },
    data() {
        return {
            form: this.$inertia.form({
                title: this.playlist.title,
                tracks:this.currentTracks 
            })
        };
    },
    methods: {
        submitForm() {
            this.form.put(route('playlist.update',{playlist: this.playlist}))
        }
    }
}
</script>