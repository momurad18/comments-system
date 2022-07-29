<template>
    <div>
        <SinglePost />
        <h3 class="my-3">Leave a comment</h3>
        <CommentForm :postId="parseInt($route.params.id)" />
        <h3 class="my-5">Comments</h3>
        <CommentList :comments="allComments" />
    </div>
</template>

<script>
import SinglePost from "../Components/Posts/SinglePost.vue";
import CommentForm from "../Components/Comments/CommentForm.vue";
import CommentList from "../Components/Comments/CommentList.vue";

export default {
    name: "Post",
    data() {
        return {
            reply: false,
            allComments: [],
        };
    },
    computed: {},
    created() {
        this.getComments();
    },
    methods: {
        async getComments() {
            try {
                this.allComments = await this.$store.dispatch(
                    "getComments",
                    this.$route.params.id
                );
            } catch (error) {
                console.error(error, "Post.vue");
            }
        },
    },
    components: { SinglePost, CommentForm, CommentList },
};
</script>

<style></style>
