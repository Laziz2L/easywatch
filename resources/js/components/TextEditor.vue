<template>
    <div class="text-editor">
        <div class="text-editor-header">
            <h5 class="text-editor-title">Редактор текста {{number}}</h5>
            <!-- <div class="text-editor-close">&#10006;</div> -->
        </div>
        <div class="text-editor-body">
            <div class="row">
                <div class="col-12">
                    <textarea
                        class="text-editor-textarea form-control"
                        rows="3"
                        placeholder="Ваш текст"
                        v-model="params.text"
                    ></textarea>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-8">
                    <select class="form-control" v-model="params.fontFamily">
                        <option v-for="font in fonts" :key="font">{{ font }}</option>
                    </select>
                </div>
                <div class="col-4">
                    <colour-picker
                        v-model="params.color"
                        :value="params.color"
                        no-input
                        picker="sketch"
                    />
                </div>
            </div>

            <div class="row mt-1">
                <div class="btn-group col-6">
                    <button
                        @click="params.italic = !params.italic"
                        :class="{ active: params.italic }"
                        class="btn btn-outline-secondary"
                    >
                        <i>I</i>
                    </button>
                    <button
                        @click="params.bold = !params.bold"
                        :class="{ active: params.bold }"
                        class="btn btn-outline-secondary"
                    >
                        <strong>B</strong>
                    </button>
                    <button
                        @click="params.underlined = !params.underlined"
                        :class="{ active: params.underlined }"
                        class="btn btn-outline-secondary"
                    >
                        <ins>T</ins>
                    </button>
                </div>
                <div class="btn-group col-6">
                    <button @click="params.textAlign = 'left'" :class="{active: params.textAlign == 'left'}" class="btn btn-outline-secondary text-align-btn">
                        <img
                            class="text-align-icon"
                            src="/img/left-align.png"
                        />
                    </button>
                    <button @click="params.textAlign = 'center'" :class="{active: params.textAlign == 'center'}" class="btn btn-outline-secondary text-align-btn">
                        <img
                            class="text-align-icon"
                            src="/img/center-align.png"
                        />
                    </button>
                    <button @click="params.textAlign = 'right'" :class="{active: params.textAlign == 'right'}" class="btn btn-outline-secondary text-align-btn">
                        <img
                            class="text-align-icon"
                            src="/img/right-align.png"
                        />
                    </button>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-4">
                    <label>Размер</label>
                    <input type="number" min="1" max="96" v-model="params.fontSize" />
                </div>
                <div class="col-4">
                    <label>Интервал</label>
                    <input type="number" min="0" max="96" v-model="params.letterSpacing" />
                </div>
                <div class="col-4">
                    <label>Поворот</label>
                    <input type="number" min="-360" max="360" v-model="params.angle" />
                </div>
            </div>

            <div class="row mt-1">
                <div class="col-4">
                    <label>Закруглить</label>
                </div>
                <div class="col-4">
                    <input type="checkbox" v-model="params.circling" />
                </div>
            </div>

            <div class="row mt-1" v-show="params.circling">
                <div class="col-4">
                    <label>Степень</label>
                    <input
                        type="number"
                        step="10"
                        min="0"
                        max="96000"
                        v-model="params.circlingParams.degree"
                    />
                </div>
                <div class="col-4">
                    <label>Обратно</label>
                    <input type="checkbox" v-model="params.circlingParams.reverse" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ColourPicker from "vue-colour-picker";
export default {
    props: ['params', 'number'],
    data() {
        return {
            fonts: [
                'arial',
                'monospace',
                'serif',
                'sans-serif',
            ]
            // params: {
            //     text: "Ваш текст",
            //     fontFamily: "arial",
            //     color: "#000000",
            //     bold: false,
            //     italic: false,
            //     underlined: false,
            //     textAlign: "left",
            //     fontSize: "15",
            //     letterSpacing: "0",
            //     angle: "0",
            //     circling: false,
            //     circlingParams: {
            //         degree: 0,
            //         reverse: false,
            //     },
            // },
        };
    },
    watch: {
        params: {
            handler(val) {
                console.log('texteditor')
                console.log(val)
                this.$emit('change', val);
            },
            deep: true
        }
    },
    mounted() {},
    components: {
        ColourPicker,
    },
};
</script>

<style>
</style>
