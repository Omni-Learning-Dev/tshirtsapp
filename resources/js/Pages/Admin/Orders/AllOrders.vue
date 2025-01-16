<template>

</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";

export default {

    layout:AppLayout,

    data(){
      return{
          search:'',
          headers:[
              {title:'id', key:'id'},
              { title: 'Order Quantity', key: 'quantity' },
              { title: 'Front text', key: 'front_text' },
              { title: 'Back text', key: 'back_text' },
              { title: 'Total price', key: 'total_price' },
              { title: 'Status', key: 'status' },
              { title: 'Payment status', key: 'payment_status' },
              { title: 'Gender', key: 'gender' },
              { title: 'Size', key: 'size' },

              { title: 'Actions', key: 'actions', sortable:false },
          ],
      }
    },

    methods:{
        deleteOrder(order){

            this.$swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete order!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    this.$inertia.delete(route('order.destroy',order.id),{
                        onSuccess:()=>{
                            this.dialog = false
                        }
                    })
                }
            });
        },
    }
}
</script>
