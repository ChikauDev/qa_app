<template>
    <div>
        <div class="media post my-4">
            <vote :model="answer" name="answer"></vote>
            <div class="media-body">
                <form v-if="editing" @submit.prevent="update">
                    <div class="form-group">
                        <textarea v-model="body" class="form-control" rows="10" required>
                        </textarea>
                    </div>
                    <button class="btn btn-primary" :disabled="isInvalid">Update</button>
                    <button class="btn btn-outline-secondary" @click="cancel">Cancel</button>
                </form>
                <div v-else>
                    <div v-html="bodyHtml"></div>
                    <div class="row">
                        <div class="col-4">
                            <div class="ml-auto">
                                <a v-if="authorize('modify', answer)" @click.prevent="edit" class="btn btn-sm btn-outline-info">
                                    Edit
                                </a>   
                                <button v-if="authorize('modify', answer)" class="btn btn-sm btn-outline-danger" @click="destroy">
                                    Delete
                                </button>        
                            </div>
                        </div>
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                            <user-info :model="answer" label="Answered"></user-info>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</template>
<script>
import Vote from './Vote.vue';
import UserInfo from './UserInfo.vue';
import modification from '../mixins/modification';

export default {
    
    props:['answer'],

    mixins: [modification],
    components: {Vote, UserInfo},

    data() {
        return {
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null
        }
    },

    methods: {
        setEditCache(){
            this.beforeEditCache = this.body;
        },
        restoreFromCache(){
            this.body = this.beforeEditCache;
        },

        payload(){
            return  {
                body: this.body
            }
        },
        delete(){
            axios.delete(this.endpoint)
                .then(({data}) => {
                    this.$toast.success(data.message, "Success", {timeout: 2000});
                    this.$emit('deleted')
                });
        }

    },

    computed: {

        isInvalid(){
            return this.body.length < 10;
        },

        endpoint(){
            return `/questions/${this.questionId}/answers/${this.id}`;
        }
    }
}
</script>
