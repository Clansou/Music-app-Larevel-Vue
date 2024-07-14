<template>

    <MusicLayout>
      <template #title>
        Liste de mes playlists
      </template>
      <template #action>
        <Link class="bg-blue-500 text-white px-4 py-2 rounded w-full" :href="route('playlist.create')">
          Ajouter une playlist
      </Link>
      </template>
      <template #content>
        <div>

          <div>
            <thead>
              <tr>
                  <th>Titre</th>
                  <th>Nombre de Musiques</th>
                  <th>Date de Création</th>
                  <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="playlist in playlists" :key="playlist.uuid">
                  <td>{{ playlist.title }}</td>
                  <td>{{ playlist.tracks_count }}</td>
                  <td>{{ $moment(playlist.created_at).format('DD/MM/YYYY hh:mm:ss') }}</td>
                  <td>
                      <Link as="button" method="get" class="bg-blue-500 text-white px-4 py-2 rounded w-full my-4 text-center" :href="route('playlist.show',{playlist:playlist})">
                        Voir
                      </Link>
                      <Link as="button" class="bg-lime-500 text-white px-4 py-2 rounded w-full my-4 text-center" :href="route('playlist.edit',{playlist:playlist})">
                        Modifier la playlist
                      </Link>
                      <Link as="button" method="delete" class="bg-red-500 text-white px-4 py-2 rounded w-full my-4 text-center" :href="route('playlist.destroy',{playlist:playlist})">
                        Supprimer la playlist
                      </Link>
                  </td>
              </tr>
          </tbody>
          </div>
        </div>
      </template>
    </MusicLayout>
  </template>
  
  <script>
  import MusicLayout from '@/Layouts/MusicLayout.vue';
  import { Link } from '@inertiajs/vue3';
  export default {
    name: 'Index',
    components: {
      MusicLayout,
    },
    props: {
      playlists: Array
    },
  }
  </script>