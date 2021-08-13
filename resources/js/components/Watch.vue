<template>
  <div class="watch-container" :style="{ width: watch.width, height: watch.height, backgroundColor: watch.backgroundColor }">
    <div class="watch-component watch-canvas">
      <img :src="canvas" :style="{ width: watch.width }" />
    </div>
    <div class="watch-component watch-belt">
      <img :src="watch.belt" :style="{ width: watch.width }" />
    </div>
    <div class="watch-component watch-body">
      <img :src="watch.body" :style="{ width: watch.width }" />
    </div>
    <div class="watch-component watch-dial">
      <img :src="watch.dial" :style="{ width: watch.width }" />
    </div>
    <div class="watch-component watch-arrows">
      <img :src="watch.arrows" :style="{ width: watch.width }" />
    </div>
  </div>
</template>

<script>
export default {
  props: ['watch'],
  data() {
    return {
        canvas: "../watch/pustoy_krug.png"
    };
  },
};
</script>

