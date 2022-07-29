<template>
    <li class="ms-auto" :class="widthClass">
        <div
            class="border-0 card my-3"
            style="box-shadow: rgb(0 0 0 / 12%) 0px 2px 8px"
        >
            <div class="card-header d-flex justify-content-between">
                <span style="font-weight: 500"
                    >{{ comment.name }} // {{ comment.id }}</span
                >
                <span class="small">{{ comment.created_at }}</span>
            </div>
            <div class="card-body">
                {{ comment.body }}
            </div>
            <div
                class="position-absolute small"
                style="right: 8px; bottom: 8px; cursor: pointer"
            >
                <a
                    style="color: red"
                    @click="hideReplyForm(comment.id)"
                    v-if="reply && isActive == comment.id"
                >
                    Cancel
                </a>
                <span v-if="reply">|</span>
                <a
                    @click="showReplyForm(comment.id)"
                    v-if="comment.level < maxDepth"
                >
                    Reply
                </a>
            </div>
        </div>

        <CommentForm
            :postId="parseInt($route.params.id)"
            :parentId="comment.id"
            :depth="parseInt(comment.level) + 1"
            v-if="reply && isActive == comment.id"
            @created="replied"
        />
        <template v-if="comment.children">
            <Comment
                v-for="reply in comment.children"
                :comment="reply"
                :key="reply.id"
                :widthClass="'w-75'"
            />
        </template>
    </li>
</template>

<script>
import CommentForm from "./CommentForm.vue";
export default {
    name: "Comment",
    props: {
        comment: {
            required: true,
            type: Object,
        },
        widthClass: {
            type: String,
        },
    },
    components: { CommentForm },
    data() {
        return {
            reply: false,
            isActive: null,
            root: [],
        };
    },
    computed: {
        maxDepth() {
            return process.env.MIX_COMMENT_MAX_DEPTH - 1;
        },
    },
    methods: {
        showReplyForm(id) {
            this.reply = true;
            this.isActive = id;
        },
        hideReplyForm() {
            this.reply = false;
            this.isActive = null;
        },
        replied() {
            this.reply = !this.reply;
            this.isActive = null;
        },
    },
};
</script>

<style></style>
