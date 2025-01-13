<script>
export default {
    watch: {
        $page: {
            handler() {
                const message = this.$page.props.flash.message;
                if (message != null) {
                    if(!message.optionRoute){
                        this.$swal.fire({
                            icon: message.type,
                            title: message.title,
                            text: message.description
                        })

                    }else{

                        this.$swal.fire({
                            title: message.title,
                            text:message.optiontext,
                            icon: message.type,
                            showCancelButton: true,
                            confirmButtonColor: '#42a848',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Close',
                            confirmButtonText: 'Yes, Proceed'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.$inertia.visit(message.optionRoute)
                            }
                        })
                    }
                }
            },
        },
    },

    data(){
        return{
            drawer:null,
            items:[

            ]
      }
   },
    
   

}
</script>