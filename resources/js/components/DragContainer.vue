<template>
    <div :id="'draggable_' + number">
        <div class="drag-container" :style="style">
            <div
                v-if="contentType == 'img'"
                class="drag-content watch-component watch-background"
            >
                <img :src="src" :style="style" @click="activate" />
            </div>
            <div
                v-if="contentType == 'text'"
                class="drag-content watch-component watch-text"
            >
                <text-layer :number="number" :params="src" :width="style.width" :height="style.height" />
            </div>
            <div v-if="active" class="drag-management">
                <div class="drag-move-area" @mousedown="move"></div>
                <div
                    class="drag-resize-area tl"
                    @mousedown="resize($event, 'tl')"
                ></div>
                <div
                    class="drag-resize-area tr"
                    @mousedown="resize($event, 'tr')"
                ></div>
                <div
                    class="drag-resize-area br"
                    @mousedown="resize($event, 'br')"
                ></div>
                <div
                    class="drag-resize-area bl"
                    @mousedown="resize($event, 'bl')"
                ></div>
            </div>
        </div>
        <text-editor @change="textChange" v-show="contentType == 'text' && active" :params="src" :number="number" />
    </div>
</template>

<script>
import TextEditor from "../components/TextEditor.vue";
import TextLayer from "../components/TextLayer.vue";

export default {
    props: ["number", "contentType", "src"],
    data() {
        return {
            contentImg: "../watch/test-bg.png",

            style: {
                width: "100px",
                height: "100px",
                top: "200px",
                left: "200px",
            },

            dragging: false,
            x: 0,
            y: 0,

            active: false,

            container:''
        };
    },
    methods: {
        move(e) {
            window.addEventListener("mousemove", mousemove);
            window.addEventListener("mouseup", mouseup);

            const t = this.style;

            let prevX = e.clientX;
            let prevY = e.clientY;

            function mousemove(e) {
                let newX = e.clientX - prevX;
                let newY = e.clientY - prevY;

                t.left = parseInt(t.left) + newX + "px";
                t.top = parseInt(t.top) + newY + "px";

                prevX = e.clientX;
                prevY = e.clientY;
            }

            function mouseup() {
                window.removeEventListener("mousemove", mousemove);
                window.removeEventListener("mouseup", mouseup);
            }
        },
        resize(e, type = "tl") {
            window.addEventListener("mousemove", mousemove);
            window.addEventListener("mouseup", mouseup);

            const t = this.style;

            let prevX = e.clientX;
            let prevY = e.clientY;

            function mousemove(e) {
                let newX = e.clientX - prevX;
                let newY = e.clientY - prevY;

                if (type == "tl" || type == "tr") {
                    t.height = parseInt(t.height) - newY + "px";
                    t.top = parseInt(t.top) + newY + "px";
                } else {
                    t.height = parseInt(t.height) + newY + "px";
                }

                if (type == "tl" || type == "bl") {
                    t.width = parseInt(t.width) - newX + "px";
                    t.left = parseInt(t.left) + newX + "px";
                } else {
                    t.width = parseInt(t.width) + newX + "px";
                }

                prevX = e.clientX;
                prevY = e.clientY;
            }

            function mouseup() {
                window.removeEventListener("mousemove", mousemove);
                window.removeEventListener("mouseup", mouseup);
            }
        },
        async activate() {
            if (!this.active) {
                this.active = true;
                setTimeout(() => {
                    window.addEventListener("click", this.deactivate);
                }, 0);
            }
        },
        deactivate(e) {
            if (!this.container.contains( e.target)) {
                window.removeEventListener("click", this.deactivate);
                this.active = false;
            }
        },
        emitDelete() {
            document.getElementById("layer_" + this.number).remove();
            this.$emit("delete", this.number);
        },
        textChange(params) {
            console.log('dragcontainer')
            console.log(params)
            this.src = params
            this.$emit("textChange", {params, number:this.number});
        }
    },
    mounted() {
        this.container = document.getElementById('draggable_' + this.number);
        this.activate();

        let showBtn = document.createElement("button");
        showBtn.classList.add(["btn"]);
        showBtn.classList.add(["btn-outline-secondary"]);
        showBtn.innerText = (this.contentType == 'text' ? "текст " : "фон ") + this.number;
        showBtn.addEventListener("click", this.activate);

        let deleteBtn = document.createElement("button");
        deleteBtn.classList.add(["btn"]);
        deleteBtn.classList.add(["btn-outline-danger"]);
        // deleteBtn.classList.add(["btn-delete-layer"]);
        deleteBtn.innerHTML = `&#10006;`;
        deleteBtn.addEventListener("click", this.emitDelete);

        let btnGroup = document.createElement("div");
        btnGroup.classList.add(["btn-group"]);
        btnGroup.id = "layer_" + this.number;
        btnGroup.appendChild(showBtn);
        btnGroup.appendChild(deleteBtn);

        let layersBar = document.getElementsByClassName("layers-bar");

        if (layersBar.length) {
            layersBar = layersBar[0];
            layersBar.appendChild(btnGroup);
        } else {
            layersBar = document.createElement("div");
            layersBar.classList.add(["layers-bar"]);
            layersBar.appendChild(btnGroup);
            document.getElementsByTagName("body")[0].appendChild(layersBar);
        }
    },
    components: {
        TextLayer,
        TextEditor,
    },
};
</script>

<style>
</style>
