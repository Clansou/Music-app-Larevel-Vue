<template>
    <MusicLayout>
      <template #title>
        Liste de mes clés API
      </template>
      <template #action>
        <Link :href="route('apikey.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded py-2 px-4">
            Créer une clé API
        </Link>
      </template>
      <template #content>
        <div>
          <!-- Optional search input, uncomment if needed -->
          <!-- <input v-model='filter' type="search" class="shadow border px-4 py-2 rounded text-gray-700"/> -->
  
          <div>
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Nom
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Clé API
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Date de Création
                    </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="key in apiKeys" :key="key">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900">
                        {{ key.name }}
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                          {{ key.key }}
                        </div>
                      </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-500">
                        {{ $moment(key.created_at).format('DD/MM/YYYY hh:mm:ss') }}
                      </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <Link as="button" method="delete" class="bg-red-500 text-white px-4 py-2 rounded w-full my-4 text-center" :href="route('apikey.destroy',{apikey:key})">
                            Supprimer la playlist
                        </Link>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </template>
    </MusicLayout>
  </template>
  
  <script>
  import MusicLayout from '@/Layouts/MusicLayout.vue';
  import { Link } from '@inertiajs/vue3';
  import moment from 'moment';
  
  export default {
    name: 'ApiKeyIndex',
    components: {
      MusicLayout,
      Link,
    },
    props: {
      apiKeys: Array,
    }
  };
  </script>