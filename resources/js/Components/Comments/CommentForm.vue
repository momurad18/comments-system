<template>
    <form @submit.prevent="sendComment(comment)">
        <div class="comment-container" :class="{ toggled: isToggled }">
            <div class="my-2">
                <input
                    type="text"
                    class="input form-control"
                    placeholder="Name"
                    name="username"
                    v-model="comment.name"
                    required
                />
            </div>
            <textarea
                class="input form-control comment-body"
                placeholder="Write a comment"
                name="comment-body"
                v-model="comment.body"
                required
            ></textarea>
            <div class="my-3">
                <button
                    type="submit"
                    class="btn btn-primary"
                    :disabled="isSending || !comment.body"
                >
                    Send
                </button>
                <button
                    type="submit"
                    class="btn btn-outline-secondary"
                    @click="resetForm()"
                >
                    Reset
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
    name: "CommentForm",
    props: {
        parentId: {
            type: Number,
            default: null,
        },
        depth: {
            type: Number,
            default: 0,
        },
        postId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            isToggled: false,
            isSending: false,
            comment: {
                post_id: this.postId,
                parent_id: this.parentId,
                level: this.depth,
                name: "",
                body: "",
            },
        };
    },
    computed: {
        ...mapGetters({
            comments: "comments",
            perPage: "perPage",
        }),
    },
    methods: {
        resetForm() {
            this.comment.body = "";
            this.comment.name = "";
        },
        closeForm() {
            this.isToggled = !this.isToggled;
            this.comment.body = "";
            this.comment.name = "";
        },
        async sendComment(comment) {
            try {
                this.isSending = true;
                const response = await this.$store.dispatch(
                    "sendComment",
                    comment
                );
                await this.setComment(this.comments, response.data.comment);
                this.comment = {
                    post_id: this.postId,
                    parent_id: this.parentId,
                    level: this.depth,
                    name: "",
                    body: "",
                };
                this.isSending = false;
                this.isToggled = !this.isToggled;
                this.$emit("created");
            } catch (error) {
                this.isSending = false;
                console.log(error);
            }
        },
        setComment(comments, reply) {
            if (!reply.parent_id) {
                if (comments.length >= this.perPage) comments.pop();
                comments.unshift(reply);
            } else {
                if (comments?.length > 0) {
                    for (let comment of comments) {
                        if (comment.id === reply.parent_id) {
                            comment.children
                                ? comment.children.unshift(reply)
                                : (comment.children = [reply]);
                        } else {
                            this.setComment(comment.children, reply);
                        }
                    }
                }
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.comment-container {
    position: relative;
    max-width: 100%;
    overflow: hidden;
    box-shadow: rgb(0 0 0 / 12%) 0px 2px 8px;
    padding: 1rem;
    .input {
        box-sizing: border-box;
        &.form-control:focus {
            box-shadow: none;
        }
    }
    .comment-body {
        height: 160px;
        transition: all 0.3s;
        resize: none;
        background-color: rgb(247 247 247);
    }
}
</style>
