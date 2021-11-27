<template>
    <div>
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#write">Write</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#preview">Preview</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <div class="tab-pane active" id="write">
                   <slot></slot>
                </div>
                <div class="tab-pane" v-html="preview" id="preview"></div>
            </div>
        </div>
    </div>
</template>

<style>
    .active{
        background-color: white !important;
    }
</style>

<script>
import MarkdownIt from 'markdown-it';
import prism from 'markdown-it-prism'
import autosize from 'autosize';


const md = new MarkdownIt();
md.use(prism);

export default {
    props: ['body'],

    computed:{
        preview(){
            return md.render(this.body);
        }
    },

    // watch:{
    //     body: function(){
    //         // console.log('watch body');
    //     }
    // },

    // mounted(){
    //     autosize(this.$el.querySelector('textarea'))
    // },

    // updated(){
    //     autosize(this.$el.querySelector('textarea'))
    // }
}
</script>