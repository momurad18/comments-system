<template>
    <ul class="list-unstyled">
        <Comment
            v-for="(comment, index) in comments"
            :key="index"
            :comment="comment"
            :widthClass="'w-100'"
        />
    </ul>
</template>

<script>
import Comment from "./Comment.vue";

export default {
    name: "CommentsList",
    props: {
        comments: {
            type: Array,
            default: [],
        },
    },
    components: { Comment },
};
</script>

<style></style>
