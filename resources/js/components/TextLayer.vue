<template>
    <div>
        <div :style="style" :id="'text_' + number">Ваш текст</div>
    </div>
</template>

<script>
import CircleType from "circletype";
export default {
    props: ["params", "number", "width", "height"],
    data() {
        return {
            style: {},
            circleType: null,
            element: null
            // params: {
            //     text: "Ваш текст",
            //     fontFamily: "arial",
            //     color: "#000000",
            //     bold: false,
            //     italic: false,
            //     underlined: false,
            //     textAlign: "left",
            //     fontSize: "15",
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
                this.element.innerText = val.text;
                this.style = {
                    width: this.width,
                    height: this.height,
                    text: val.text,
                    fontFamily: val.fontFamily,
                    color: val.color,
                    fontWeight: val.bold ? 700 : 400,
                    fontStyle: val.italic ? "italic" : "normal",
                    textDecoration: val.underlined ? "underline" : "none",
                    textAlign: val.textAlign,
                    fontSize: val.fontSize + "px",
                    letterSpacing: val.letterSpacing + "px",
                    transform: 'rotate(' + val.angle + 'deg)'
                };

                if (this.circleType) {
                    this.circleType.destroy();
                    this.circleType = null;
                }

                if (val.circling) {
                    if (!this.circleType)
                        this.circleType = new CircleType(
                            document.getElementById("text_" + this.number)
                        );
                    this.circleType.radius(val.circlingParams.degree);
                    this.circleType.dir(val.circlingParams.reverse ? -1 : 1);
                    // this.circleType.forceWidth(true);
                    // this.circleType.forceHeight(true);
                    // this.circleType.container.style.width
                    this.circleType.refresh();
                }
                // else if (this.circleType) {
                //     this.circleType.destroy();
                //     this.circleType = null;
                // }
            },
            deep: true,
        },
    },
    mounted() {
        this.element = document.getElementById("text_" + this.number);
    },
};
</script>

<style>
</style>
