<template>

    <MusicLayout>
      <template #title>
        Liste de mes playlists
      </template>
      <template #action>
        Ajouter une playlist
      </template>
      <template #content>
        <div>
          <!-- <input v-model='filter' type="search" class="shadow border px-4 py-2 rounded text-gray-700"/> -->

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
                  <td>{{ playlist.created_at }}</td>
                  <td>
                      <Link as="button" method="get" class="bg-blue-500 text-white px-4 py-2 rounded w-full my-4 text-center" :href="route('playlist.show',{playlist:playlist})">
                        Voir
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
  import Playlist from '@/Components/Playlist/Playlist.vue';
  import { Link } from '@inertiajs/vue3';
  export default {
    name: 'Index',
    components: {
      MusicLayout,
      Playlist,
    },
    props: {
      playlists: Array
    },
  }
  </script>