<template>
    <div>
        <add
            @createText="createText"
            @chooseComponent="chooseComponent"
            @changeBGC="changeBGC"
            @uploadImage="createBackground"
        />
        <watch :watch="watchObject" />
        <drag-container
            v-for="item of draggable"
            :key="item.id"
            :number="item.id"
            :contentType="item.type"
            :src="item.src"
            @delete="deleteDraggableItem"
            @textChange="updateText"
        />
        <!-- <text-editor @change="log" :params="text"/>
        <text-layer :params="text" :number="23" /> -->
    </div>
</template>

<script>
import Watch from "../components/Watch.vue";
import Add from "../components/Add.vue";
import DragContainer from "../components/DragContainer.vue";
import TextEditor from "../components/TextEditor.vue";
import TextLayer from "../components/TextLayer.vue";
export default {
    data() {
        return {
            watchObject: {
                belt: "../watch/belt.png",
                body: "../watch/body2.png",
                background: "",
                backgroundColor: "#000000",
                text: "",
                dial: "../watch/dial.png",
                arrows: "../watch/arrows.png",
                width: "300px",
                height: "469px",
            },
            layersCount: 0,
            draggable: [],
            baseText: {
                text: "Ваш текст",
                fontFamily: "arial",
                color: "#000000",
                bold: false,
                italic: false,
                underlined: false,
                textAlign: "left",
                fontSize: "15",
                angle: "0",
                circling: false,
                circlingParams: {
                    degree: 0,
                    reverse: false,
                },
            },
        };
    },
    methods: {
        chooseComponent(component) {
            this.watchObject[component.type] = component.path;
        },
        deleteDraggableItem(number) {
            this.draggable = this.draggable.filter(function (item) {
                return item.id != number;
            });
            console.log(this.draggable);
        },
        changeBGC(val) {
            this.watchObject.backgroundColor = val;
        },
        createBackground(src) {
            this.layersCount++;
            this.draggable.push({
                id: this.layersCount,
                type: "img",
                src,
            });
        },
        createText() {
            this.layersCount++;
            this.draggable.push({
                id: this.layersCount,
                type: "text",
                src: {
                    text: "Ваш текст",
                    fontFamily: "arial",
                    color: "#000000",
                    bold: false,
                    italic: false,
                    underlined: false,
                    textAlign: "left",
                    fontSize: "15",
                    letterSpacing: "0",
                    angle: "0",
                    circling: false,
                    circlingParams: {
                        degree: 0,
                        reverse: false,
                    },
                },
            });
        },
        updateText(val) {
            this.draggable.map((item) => {
                if (item.id == val.number) {
                    item.src = val.params;
                    return item;
                }
            });
            console.log(this.draggable);
        },
        log(v) {
            this.text = v;
        },
    },
    components: {
        Watch,
        Add,
        DragContainer,
        TextEditor,
        TextLayer,
    },
};
</script>

<style>
@import url(../../css/app.css);
</style>
