<script setup>
import BreezeMainLayout from '@/Layouts/Main.vue';
import SelectionList from '@/Components/selections/SelectionList.vue';
import {Head, Link} from '@inertiajs/inertia-vue3';
import {computed, onMounted, ref} from "vue";
import {useStore} from 'vuex'

const store = useStore()

const props = defineProps({
  id: String
})

const game = computed(() => store.getters.getGameItem)

onMounted(async () => {
  await store.dispatch("getGameItem", props.id);
})


</script>

<template>
  <Head title="Game"/>
  <BreezeMainLayout>

    <div class="bg-w">
      <div class="container">
        <div class="container-box">

          <div class="single-game">
            <div class="single-game-cover">
              <img :src="'/uploads/games/' + game.cover">
            </div>
            <div class="single-game-content">
              <div class="single-game-content_title">{{ game.title }}</div>
              <div class="single-game-content_desc" v-html="game.desc"></div>
              <div class="single-game-content_text" v-html="game.content"></div>
              <button type="button" class="xt-btn color-3">Приобрести</button>
            </div>


          </div>

        </div>
      </div>
    </div>

    <SelectionList />

  </BreezeMainLayout>
</template>
