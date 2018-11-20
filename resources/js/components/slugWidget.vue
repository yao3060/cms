<template>
    <div class="slug-widget">
        <div class="icon-wrapper wrapper">
            <i class="fas fa-link"></i>
        </div>

        <div class="wrapper url-wrapper">
            <span class="root-url">{{url}}</span>
            <span class="subdirectory-url">/{{subdirectory}}/</span>
            <span class="slug" v-show="slug && !isEditing" >{{slug}}</span>
            <input type="text" name="slug-edit"
                   class="slug-edit input is-small"
                   v-show="isEditing"
                   v-model="customSlug">
        </div>

        <div class="wrapper buttons buttons-wrapper">
            <a class="button is-small" @click="editSlug" v-show="!isEditing">Edit</a>
            <a class="button is-small" @click="saveSlug" v-show="isEditing">Save</a>
            <a class="button is-small" @click="resetSlug" v-show="isEditing">Reset</a>
        </div>

    </div>
</template>

<style scoped>

    .wrapper {
        display: inline;
    }
    .slug-edit {
        max-width:200px;
    }

    .buttons-wrapper {
        margin-left:10px;
    }

    .slug {
        background-color: yellow;
    }

</style>

<script>

    export default {
        props:{
            url: {
                type: String,
                required: true
            },
            subdirectory:{
                type: String,
                required: true
            },
            title: {
                type: String,
                required: true
            }
        },
        data: function () {
            return {
                slug: this.setSlug(this.title),
                isEditing: false,
                customSlug: '',
                wasEdited: false,
                api_token: this.$root.api_token
            };
        },
        methods: {
            convertTitle: function(){
                return Slug(this.title)
            },
            editSlug: function(){
                this.customSlug = this.slug;
                this.$emit('edit', this.slug);
                this.isEditing = true;
            },
            saveSlug: function(){

                if( this.customSlug !== this.slug ){
                    this.wasEdited = true;
                }
                this.setSlug(this.customSlug);
                this.isEditing = false;
            },
            resetSlug: function(){
                this.setSlug(this.title);
                this.wasEdited = false;
                this.isEditing = false;
            },
            setSlug: function (newVal, count = 0) {
                // Slugify the newVal
                let slug = Slug(newVal + (count > 0 ? '-' + count : '' ));
                let _this = this;

                if (this.api_token && slug){

                    axios.get('/api/posts/unique', {
                        params: {
                            api_token: _this.api_token,
                            slug: slug
                        }
                    }).then(function (response) {

                        // see if it is unique and emit event
                        if (response.data){
                            _this.slug = slug;
                            _this.$emit('slug-changed', slug);
                        } else {
                            // else customize the slug to make it unique and test again
                            _this.setSlug(newVal, count+1);

                        }

                    }).catch(function (error) {
                        console.log(error);
                    });

                }
            }
        },
        watch: {
            title: _.debounce(function () {
                if(this.wasEdited == false) {
                    this.slug = this.setSlug(this.title);
                }
            }, 500)
        }
    }

</script>
