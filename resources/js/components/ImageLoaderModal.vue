<template>
    <div class="modal fade" id="load-modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Загрузка изображения</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="uploadImage">
                        <div class="form-group">
                            <input
                                type="file"
                                class="form-control-file"
                                accept="image/jpeg,image/png,image/jpg"
                                required
                            />
                            <br />
                            <button
                                type="submit"
                                class="btn btn-outline-success"
                            >
                                Отправить
                            </button>
                        </div>
                    </form>
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
    methods: {
        uploadImage(e) {
            let img = e.target.getElementsByTagName("input")[0].files[0];
            let fd = new FormData();

            fd.append("image", img);
            axios.post("/api/image", fd).then((resp) => {
                this.$emit('uploadImage', resp.data)
            });
        },
    },
};
</script>

<style>
</style>
