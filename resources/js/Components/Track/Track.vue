<template>
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 lg:w-1/3 p-4">
            <img :src="'storage/images/'+ track.image" alt="Image de la piste" class="w-full h-auto mb-4 rounded-lg shadow-lg">
            <div>
                <h2 class="text-xl font-semibold mb-2">{{track.title}}</h2>
                <p class="text-gray-600">{{track.artist}}</p>
            </div>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full my-4" @click="handleClick">Lire une musique</button>
        <Link class="bg-lime-500 text-white px-4 py-2 rounded w-full my-4 text-center" :href="route('tracks.edit',{track:track})">
            Modifier la musique
        </Link>
        <Link as="button" method="delete" class="bg-red-500 text-white px-4 py-2 rounded w-full my-4 text-center" :href="route('tracks.destroy',{track:track})">
            Supprimer la musique
        </Link>
    </div>

</template>
<script>
export default {
    name: 'Track',
    props: {
        track: Object
    },
    methods:{
        handleClick(){
            this.$emit("played", this.track); 
        }
    }
}
</script>