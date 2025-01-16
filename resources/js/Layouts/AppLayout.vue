<script  >

export default{
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


    props:['title'],

    data(){
        return{
            drawer: true,
            rail: true,
            items:[
                {
                    text: "Dashboard",
                    icon: 'mdi-view-dashboard',
                    url:route('admin.dashboard')
                },
                {
                    text: "Orders",
                    icon: 'mdi-cart',
                    url:route('admin.orders.index')
                },
                {
                    text: "Categories",
                    icon: 'mdi-tag-multiple',
                    url:route('admin.categories.index')
                },
                {
                    text: "Products",
                    icon: 'mdi-tshirt-crew',
                    url:route('admin.products.index')
                },
                {
                    text: "Clients",
                    icon: 'mdi-account-group',
                    url:route('admin.clients.index')
                },
                {
                    text: "Inbox",
                    icon: 'mdi-inbox-arrow-down',
                    url:route('admin.enquiries.index')
                },
            ]
        }
    },

    methods:{
       logout() {
             this.$inertia.post(route('logout'))
        },

        getPath(stringG){
            if(stringG){
                let url = new URL(stringG)
                return url.pathname
            }
        }
    }
}



</script>

<template>
    <Head :title="title"/>
    <v-app id="inspire">
        <v-navigation-drawer
            v-model="drawer"
            :rail="rail"
            permanent
            @click="rail = false"
        >
            <v-list density="comfortable" class="mt-n3">
                <v-list>
                    <v-list-item
                        class="userinfo"
                        prepend-icon="mdi-account-circle"
                        :subtitle="$page.props.auth.user.email"
                        :title="$page.props.auth.user.name"
                    >

                    </v-list-item>
                </v-list>


                <v-divider class="my-2"/>
                <InertiaLink
                    class="InertiaLink  "
                    v-for="(item, i) in items"
                    :key="i"
                    :href="item.url"
                >
                    <v-list-item
                        class="rounded-sm"
                        :prepend-icon="item.icon"
                        :title="item.text"
                        :class="{ 'active-sidebar':$page.url === (getPath(item.url)) }"
                    >
                    </v-list-item>
                </InertiaLink>

            </v-list>

            <template v-slot:append>
                <div class="pa-2">
                    <v-btn block @click="logout">
                       <span v-if="!rail"> Logout</span>
                        <v-icon v-else>mdi-logout-variant</v-icon>
                    </v-btn>
                </div>
            </template>

        </v-navigation-drawer>

        <v-app-bar color="primary">
            <v-app-bar-nav-icon color="white" @click="rail = !rail"></v-app-bar-nav-icon>
            <v-app-bar-title>Application</v-app-bar-title>
            <v-btn
                color="white"
                variant="outlined"
                rounded
                class="mr-2"
            >
                <v-icon icon="mdi-account-circle" class="mr-1"/>
                {{ $page.props.auth.user.name }}
                <v-menu activator="parent">
                    <v-list>
                        <v-list-item>
                            <v-list-item-title>
                                {{ $page.props.auth.user.name }}
                            </v-list-item-title>
                            <v-list-item-subtitle>
                                {{ $page.props.auth.user.email }}
                            </v-list-item-subtitle>
                        </v-list-item>
                        <v-divider class="my-2" />

                        <v-list-item :href="route('profile.show')">
                            <v-list-item-title>
                                <v-icon>mdi-account-circle</v-icon>  Profile
                            </v-list-item-title>
                        </v-list-item>

                        <v-list-item class="cursor-pointer" @click="logout">
                            <v-list-item-title>
                                <v-icon>mdi-login</v-icon> Logout
                            </v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-btn>
        </v-app-bar>

        <v-main>
             <v-container>
                 <slot/>
             </v-container>
        </v-main>
    </v-app>
</template>
