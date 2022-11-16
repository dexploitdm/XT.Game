<script setup>
import {onMounted, computed, ref} from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import {useStore} from "vuex";
const store = useStore()

const selections = computed(() => store.getters.getSelectionStore)

onMounted(async () => {
    await store.dispatch("getSelections", { self: this });
})



</script>
<template>
    <div class="layout">
        <div class="layout-box">
            <div class="selection">
                <div v-for="item in selections" class="selection-item">
                    <Link :href="route('showSelection', item.id)">
                        <div class="selection-item-cover" :style="'background-image: url(/uploads/selection/'+ item.cover +')'">
                            <div class="selection-item-title">
                                {{ item.title}}
                            </div>
                        </div>
                    </Link>

                </div>
            </div>

        </div>
    </div>
</template>
