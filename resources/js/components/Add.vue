<template>
    <div>
        <div class="add-bar">
            <div class="btn-group-vertical">
                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="showModal('belt')"
                >
                    Ремешок
                </button>
                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="showModal('body')"
                >
                    Корпус
                </button>
                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="showLoadModal"
                >
                    Загрузить фон
                </button>
                <button
                    @click="showColorPicker = !showColorPicker"
                    type="button"
                    class="btn btn-outline-secondary"
                >
                    Цвет фона
                </button>
                <button @click="createText" type="button" class="btn btn-outline-secondary">
                    Текст
                </button>
                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="showModal('dial')"
                >
                    Циферблат
                </button>
                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    @click="showModal('arrows')"
                >
                    Стрелки
                </button>
            </div>
        </div>

        <choose-modal
            :type="modalType"
            :items="items[modalType]"
            @chooseComponent="chooseComponent"
        />
        <image-loader-modal @uploadImage="createBackground" />

        <div v-show="showColorPicker" class="background-color-picker-container">
            <colour-picker
                v-model="colour"
                :value="colour"
                label="Pick Colour"
                picker="sketch"
            />
        </div>
    </div>
</template>

<script>
import ChooseModal from "../components/ChooseModal.vue";
import ImageLoaderModal from "../components/ImageLoaderModal.vue";
import ColourPicker from "vue-colour-picker";
export default {
    data() {
        return {
            modal: "",
            loadModal: "",
            modalType: "",

            items: {
                belt: [
                    "../watch/belt.png",
                    "../watch/2.png",
                    "../watch/5.png",
                    "../watch/6.png",
                    "../watch/7.png",
                ],
                body: ["../watch/body1.png", "../watch/body2.png"],
                dial: [
                    "../watch/dial.png",
                    "../watch/3.png",
                    "../watch/8.png",
                    "../watch/9.png",
                ],
                arrows: ["../watch/arrows.png"],
            },

            showColorPicker: false,
            colour: "#000000",
        };
    },
    methods: {
        showModal(component = "") {
            this.modalType = component;
            this.modal.show();
        },
        showLoadModal() {
            this.loadModal.show();
        },

        chooseComponent(path) {
            this.$emit("chooseComponent", { path, type: this.modalType });
            this.modal.hide();
        },
        createBackground(src) {
            this.$emit("uploadImage", src);
            this.loadModal.hide();
        },
        createText() {
            this.$emit("createText");
        },
    },
    watch: {
        colour(val) {
            this.$emit("changeBGC", val);
        },
    },
    mounted() {
        this.modal = new bootstrap.Modal(document.getElementById("add-modal"), {
            keyboard: false,
        });
        this.loadModal = new bootstrap.Modal(
            document.getElementById("load-modal"),
            {
                keyboard: false,
            }
        );
    },
    components: {
        ChooseModal,
        "colour-picker": ColourPicker,
        ImageLoaderModal,
    },
};
</script>

<style>
</style>
