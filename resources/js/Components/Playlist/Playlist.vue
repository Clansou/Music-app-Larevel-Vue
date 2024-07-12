<template>
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 lg:w-1/3 p-4">
            <div>
                <h2 class="text-xl font-semibold mb-2">{{playlist.title}}</h2>
            </div>
        </div>
        <Link class="bg-lime-500 text-white px-4 py-2 rounded w-full my-4 text-center" :href="route('playlist.edit',{playlist:playlist})">
            Modifier la playlist
        </Link>
        <Link as="button" method="delete" class="bg-red-500 text-white px-4 py-2 rounded w-full my-4 text-center" :href="route('playlist.destroy',{playlist:playlist})">
            Supprimer la playlist
        </Link>
    </div>

</template>
<script>
export default {
    name: 'Playlist',
    props: {
        playlist: Object
    },
}
</script>