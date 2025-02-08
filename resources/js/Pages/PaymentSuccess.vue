<template>


<v-container class="mt-5" fluid>
        <v-card class="glass pa-5">

            <v-toolbar class="mb-5 rounded-lg">
                <v-toolbar-title>
                    Order Details
                </v-toolbar-title>
                <v-spacer/>

                <v-btn color="black" variant="flat" class="mx-1">
                    Print
                </v-btn>

                <v-btn color="error" variant="flat" class="mx-1">
                    Save as PDF
                </v-btn>
            </v-toolbar>
            <v-row>
                <v-col cols="12" sm="6">
                    <v-card>
                        <v-card-title>
                            Order Details
                        </v-card-title>
                        <v-card-text>
                            {{  $page.props.order  }}
                        </v-card-text>
                    </v-card>
                </v-col>

                <v-col cols="12" sm="6">
                    <v-card>
                        <v-card-title>
                            Payment Status
                        </v-card-title>
                        <v-card-text>
                                {{  $page.props.payment  }}
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-card>
</v-container>


</template>
<script>
import Default from '@/Layouts/Default.vue';

export default {
    layout: Default,
}
</script>
