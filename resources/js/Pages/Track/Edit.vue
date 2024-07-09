<template>
    <MusicLayout>
        <template #title>
            <Link class="bg-blue-500 text-white px-4 py-2 rounded w-full" :href="route('tracks.create')">
                Modifier une musique
            </Link>
        </template>
        <template #action>
            <Link :href="route('tracks.index')">
                Retour
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submitForm">
                <div class="my-4">
                    <label for="title" class="block text-sm font-medium">Titre</label>
                    <input id="title" type="text" v-model="form.title" :class="{ 'border-red-300': form.errors.title }" class="mt-1 block w-full border rounded-md shadow-sm">
                    <p class="text-xs text-red-600">{{ form.errors.title }}</p>

                    <label for="artist" class="block text-sm font-medium">Artiste</label>
                    <input id="artist" type="text" v-model="form.artist" :class="{ 'border-red-300': form.errors.artist }" class="mt-1 block w-full border rounded-md shadow-sm">
                    <p class="text-xs text-red-600">{{ form.errors.artist }}</p>

                    <div class="flex items-center space-x-2 mt-4">
                        <input id="isPrivate" type="checkbox" v-model="form.isPrivate" class="rounded text-blue-500 focus:ring-blue-500">
                        <label for="isPrivate" class="ml-2 text-sm font-medium">Privé</label>
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
        track: Object
    },
    data() {
        return {
            form: this.$inertia.form({
                title: this.track.title,
                artist: this.track.artist,
                isPrivate: this.track.isPrivate ? true : false
            })
        };
    },
    methods: {
        submitForm() {
            console.log(this.form);
            console.log(route('tracks.update',{track: this.track}))
            this.form.put(route('tracks.update',{track: this.track}))
        }
    }
}
</script>