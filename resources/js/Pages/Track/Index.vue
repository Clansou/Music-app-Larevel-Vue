  <template>

  <MusicLayout>
    <template #title>
      Liste de mes tracks
    </template>
    <template #action>
      Ajouter une musique
    </template>
    <template #content>
      <div>
        <ul>
            <Track v-for="track in tracks" :key="track.uuid" :track='track' @played="play"/>
        </ul>
      </div>
    </template>
  </MusicLayout>
</template>

<script>
import MusicLayout from '@/Layouts/MusicLayout.vue';
import Track from '@/Components/Track/Track.vue';

export default {
  name: 'Index',
  components: {
    MusicLayout,
    Track,
  },
  props: {
    tracks: Array,
  },
  methods:{
    play(track){
            const url = 'storage/musics/'+ track.music
            let audio = new Audio(url);
            audio.play();
        }
  }
}
</script>