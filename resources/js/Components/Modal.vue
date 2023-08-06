<template>
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div
            class="modal-dialog modal-dialog-centered modal-lg"
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        {{ title }}
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot name="body" :clicked="handleClick" />
                </div>

                <div class="modal-footer">
                    <slot name="footer">
                        <button
                            type="button"
                            class="btn btn-info"
                            data-bs-dismiss="modal"
                            ref="closeButton"
                            @click="$emit('close')"
                        >
                            Close
                        </button>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
        },
    },
    methods: {
        handleClick() {
            this.$refs.closeButton.click();
        },
    },
};
</script>
