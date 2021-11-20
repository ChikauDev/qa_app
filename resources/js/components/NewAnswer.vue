<template>
    <div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>Your Answer</h3>
                        </div>
                        <hr>
                        <div class="form-group">
                            <form @submit.prevent="create">
                                <textarea name="body" class="form-control" cols="30" rows="7" v-model="body" required></textarea>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-outline-primary mt-3" :disabled="isInvalid">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: ['questionId'],

    data(){
        return {
            body: '',
        }
    },

    computed:{
        isInvalid(){
            return !this.signedIn || this.body.length < 10;
        }
    },

    methods: {
        create(){
            axios.post(`/questions/${this.questionId}/answers`,{
                body: this.body
            })
            .then(({data}) => {
                console.log(data);
                this.$toast.success(data.message, "Success");
                this.body = '';
                this.$emit('created', data.answer);
            })
            .catch(err =>{
                console.log(err);
            })
        }
    },
}
</script>