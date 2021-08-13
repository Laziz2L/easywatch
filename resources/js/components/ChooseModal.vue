<template>
  <div class="modal fade" id="add-modal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Выберите {{ translations[type] }}</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body flex">
          <div
            class="modal-item"
            v-for="item of items"
            :key="item"
            @click="chooseComponent(item)"
          >
            <img :src="item" />
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Закрыть
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    props: [
        'items',
        'type'
    ],
    data() {
        return {
            translations: {
                belt: "ремешок",
                body: "корпус",
                dial: "циферблат",
                arrows: "стрелки"
            }
        }
    },
    methods: {
        chooseComponent(path) {
            this.$emit('chooseComponent', path)
        }
    }
};
</script>

<style>
</style>
