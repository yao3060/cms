<template>
    <small>
        <button class="button is-primary is-small" @click="isComponentModalActive = true">Comment</button>

        <b-modal :active.sync="isComponentModalActive" has-modal-card>
            <form action="">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Comments {{ comments.length }}</p>
                    </header>
                    <section class="modal-card-body">

                        <h4>Comments</h4>
                        <div v-if="comments.length > 0">

                            <div class="media" v-for="comment in comments">
                                <h3>{{ comment.author_name}}</h3>
                                {{ comment.body }}
                            </div>

                        </div>

                        <hr />
                        <div class="comment_form">
                            <b-field>
                                <b-input
                                    type="textarea"
                                    v-model="comment"
                                    :placeholder="commentPlaceholder"
                                    maxlength="200"
                                    required>
                                </b-input>
                            </b-field>
                            <div class="buttons">
                                <button class="button" type="button" @click="$parent.close()">Close</button>
                                <a class="button is-primary" @click="saveComment">Submit</a>
                            </div>
                        </div>
                    </section>

                </div>
            </form>
        </b-modal>
    </small>
</template>

<script>

    export default {
        props: [
            'type',
            'postid'
        ],
        data() {
            return {
                isComponentModalActive: false,
                commentPlaceholder: 'Say Something',
                comment:'',
                newComment: {},
                comments: [],
                api_token: this.$root.api_token,
                postId: this.postid
            }
        },
        created:function () {
            getComments();
        },
        methods: {
            getComments: function(){

            },
            saveComment: function(){

                let _this = this;

                axios.post('/api/comments/store', {
                    type: _this.type,
                    postID: _this.postId,
                    comment: _this.comment,
                    api_token: _this.api_token
                }).then(function (response) {

                    _this.newComment = response.data;
                    _this.comments.unshift(_this.newComment);

                }).catch(function (error) {
                        console.log(error);
                });


            }
        }
    }
</script>
