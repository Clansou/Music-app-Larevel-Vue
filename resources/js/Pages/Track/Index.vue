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
        <input v-model='filter' type="search" class="shadow border px-4 py-2 rounded text-gray-700"/>
        <div>
          <ul>
              <Track v-for="track in filteredTracks" :key="track.uuid" :track='track' @played="play"/>
          </ul>
        </div>
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
  data(){
    return{
      audio:null,
      currentTrack:null,
      filter:''
    }
  },
  computed:{
    filteredTracks() {
      return this.tracks.filter(track => track.title.toLowerCase().includes(this.filter.toLowerCase()) || track.artist.toLowerCase().includes(this.filter.toLowerCase()))
    }
  },
  methods:{
    play(track){
            const url = 'storage/musics/'+ track.music
            if(!this.currentTrack){
              this.audio = new Audio(url);
              this.audio.play();
            }
            else if(this.currentTrack !== track.uuid){
              this.audio.pause();
              this.audio.src = url;
              this.audio.play();
            }
            else{
              this.audio.paused ? this.audio.play():this.audio.pause();
            }
            this.currentTrack = track.uuid;
            this.audio.addEventListener('ended', () => this.currentTrack = null)

        }
  }
}
</script>