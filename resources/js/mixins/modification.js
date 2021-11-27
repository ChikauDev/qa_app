export default{

    data() {
        return {
            editing: false,
        }
    },

    methods: {

        edit(){
            this.setEditCache();
            this.editing = true;
        },

        cancel(){
            this.restoreFromCache();
            this.editing = false;
        },

        setEditCache(){
        },

        restoreFromCache(){
        },
        
        update(){
            axios.put(this.endpoint, this.payload())
            .then(({data}) =>{
                this.bodyHtml = data.body_html;
                this.$toast.success(data.message, "Success", {timeout: 3000});
                this.editing = false;
            })
            .catch(({response}) => {
                this.$toast.error(response.data.message, "Error", {timeout: 3000})
            })
        },

        payload(){

        },
    
        destroy(){
            this.$toast.question('Are you sure to delete', "Confirm", {
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Hey',
                message: 'Are you sure about that?',
                position: 'center',
                buttons: [
                    ['<button><b>YES</b></button>', (instance, toast) => {
                        this.delete();
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }, true],
                    ['<button>NO</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }],
                ],
            });
        },

        delete(){}

    },

}