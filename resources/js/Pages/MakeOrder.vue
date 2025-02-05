<template>

        <v-container class="mt-5" fluid>
            <v-card class="glass pa-5">
                <v-row>
                    <v-col cols="12" sm="6" class="text-center">
                        <h1 class="mt-5 text-accent text-h1">
                            {{ $page.props.category.name }}
                        </h1>
                        <img :src="$page.props.category.preview_image" cover />
                    </v-col>

                    <v-col cols="12" sm="6">
                        <v-form @submit.prevent="submitOrder" v-if="$page.props.tab ==='one'">
                            <v-card flat class="pt-10">
                               <v-card-text>
                                   <v-row>
                                       <v-col cols="6">
                                           <v-text-field v-model="form.front_text" label="Front Text"
                                                         variant="outlined"
                                                         :error-messages="$page.props.errors?.front_text" />
                                           <v-text-field
                                                            v-model="form.back_text"
                                                            label="Back Text"
                                                            variant="outlined"
                                                            :error-messages="$page.props.errors?.back_text"
                                            />
                                       </v-col>

                                       <v-col cols="6">
                                           <v-file-input density="comfortable"
                                                         v-model="form.logo_image"
                                                         label="Upload Logo or image"
                                                         accept="image/*"
                                                         variant="outlined"
                                                         prepend-icon=""
                                                         prepend-inner-icon="mdi-camera"
                                                         :error-messages="$page.props.errors?.logo_image"
                                                         @update:model-value="previewImage" />

                                           <v-img
                                               v-if="imagePreview"
                                               :src="imagePreview"
                                               max-height="150"
                                               contain
                                               class="mt-n2"
                                           />

                                           <v-img
                                               v-else
                                               src="/images/logo-main.png"
                                               max-width="150"
                                               contain
                                               class="glass mt-n2"
                                           />
                                       </v-col>
                                   </v-row>

                                   <v-textarea rows="3" v-model="form.notes"
                                               label="Additional Details and Instructions" variant="outlined"
                                               :error-messages="$page.props.errors?.notes" />
                               </v-card-text>

                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn :loading="form.processing" type="submit" variant="flat" class="mx-1 pa-3">
                                        Next Step
                                    </v-btn>

                                </v-card-actions>
                            </v-card>
                        </v-form>
                    </v-col>
                </v-row>
            </v-card>
        </v-container>

</template>

<script>
import Default from '@/Layouts/Default.vue';

export default {
    layout:Default,

    data() {
        return {
            form: this.$inertia.form({
                category_id: this.$page.props.category.id, // Set category_id dynamically
                logo_image: null,
                notes: null,
                front_text: null,
                back_text: null,
                payment_status: null,
                status: null,
            }),
            imagePreview: null // Store preview image
        };
    },

    methods: {
        submitOrder() {
            if (this.$page.props.tab === 'one') {
                this.form.post(this.route('sendOrder'), {});
            }
        },

        previewImage(file) {
            if (!file) {
                this.imagePreview = null;
                return;
            }

            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = () => {
                this.imagePreview = reader.result;
            };
        }
    }
};
</script>
