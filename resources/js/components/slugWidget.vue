<template>
    <div class="slug-widget">
        <div class="icon-wrapper wrapper">
            <i class="fas fa-link"></i>
        </div>

        <div class="wrapper url-wrapper">
            <span class="root-url">{{url}}</span>
            <span class="subdirectory-url">/{{subdirectory}}/</span>
            <span class="slug" v-show="slug && !isEditing" >{{slug}}</span>
            <input type="text" name="slug-edit" class="slug-edit input is-small" v-show="isEditing" v-model="customSlug">
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
                slug: this.convertTitle(),
                isEditing: false,
                customSlug: '',
                wasEdited: false
            };
        },
        methods: {
            convertTitle: function(){
                return Slug(this.title)
            },
            editSlug: function(){
                this.customSlug = this.slug;
                this.isEditing = true;
            },
            saveSlug: function(){

                this.slug = Slug(this.customSlug);
                this.isEditing = false;
                if( this.customSlug !== this.slug ){
                    this.wasEdited = true;
                }
            },
            resetSlug: function(){
                this.slug = this.convertTitle();
                this.wasEdited = false;
                this.isEditing = false;
            }
        },
        watch: {
            title: _.debounce(function () {
                if(this.wasEdited == false) {
                    this.slug = this.convertTitle();
                }
            }, 500),
            slug: function (val) {
                this.$emit('slug-changed', val);
            }
        }
    }

</script>
