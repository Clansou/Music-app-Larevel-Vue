<template>
    <MusicLayout>
        <template #title>
            <Link class="bg-blue-500 text-white px-4 py-2 rounded w-full" :href="route('apikey.create')">
                Créer une musique
            </Link>
        </template>
        <template #action>
            <Link :href="route('apikey.index')">
                Retour
            </Link>
        </template>
        <template #content>
            <form @submit.prevent="submitForm">
                <div class="my-4">
                    <label for="name" class="block text-sm font-medium">name</label>
                    <input id="name" type="text" v-model="form.name" :class="{ 'border-red-300': form.errors.name }" class="mt-1 block w-full border rounded-md shadow-sm">
                    <p class="text-xs text-red-600">{{ form.errors.name }}</p>

                    <button type="submit" class="mt-6 px-4 py-2 text-white rounded-md transition duration-150 ease-in-out" :class="[form.processing ? 'bg-grey-500' : 'bg-blue-500 hover:bg-blue-600']" :disabled="form.processing">Créer</button>
                </div>
            </form>
        </template>
    </MusicLayout>
</template>

<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';

export default {
    name: 'Create',
    components: {
        MusicLayout,
    },
    data() {
        return {
            form: this.$inertia.form({
                name:'',
            })
        };
    },
    methods: {
        submitForm() {
            console.log(this.form);
            this.form.post(route('apikey.store'))
        }
    }
}
</script>