<template>
    <small>
        <button class="button is-primary is-small" @click="cardModal()">Comment</button>

        <b-modal :active.sync="isComponentModalActive" has-modal-card>
            <form action="">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Comments {{ comments.length }}</p>
                    </header>
                    <section class="modal-card-body">

                        <div v-if="comments.length > 0">

                            <div class="media" v-for="comment in comments">

                                <figure class="media-left">
                                    <p class="image is-64x64">
                                        <img src="https://bulma.io/images/placeholders/128x128.png">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong>{{ comment.author_name}}</strong> <small>{{ comment.published_at}}</small>
                                        </p>
                                        {{ comment.body }}
                                    </div>
                                </div>

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

        methods: {

            cardModal: function(){
                this.isComponentModalActive = true;
                this.getComments();
            },

            getComments: function(){

                let _this = this;
                axios.get('/api/comments',  {
                    params: {
                        type: _this.type,
                        post_id: _this.postId
                    }
                }).then(function (response) {

                    console.log(response)
                    _this.comments = response.data

                }).catch(function (error) {
                    console.log(error);
                });

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
