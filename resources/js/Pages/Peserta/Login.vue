<script setup>
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
const form = useForm({
    email: "",
    password: "",
});
const loading = ref(false);
function login() {
    form.post(route("peserta.login"), {
        onStart: function () {
            loading.value = true;
        },
        onFinish: function () {
            loading.value = false;
        },
    });
}
</script>
<template>
    <v-container>
        <div class="w-full max-w-md mx-auto mt-3">
            <v-card
                :loading="loading"
                rounded="lg"
                elevation="8"
                class="pb-8 pa-4"
            >
                <div class="mb-3">
                    <v-card-title class="text-center"
                        >LOGIN PPDB SMK IFSU</v-card-title
                    >
                    <v-card-subtitle class="text-center">
                        Silahkan login dengan akun anda
                    </v-card-subtitle>
                </div>
                <v-card-text>
                    <v-alert class="mb-3" v-if="$page.props.errors.success_daftar" color="success" type="success" density="compact">
                        {{ $page.props.errors.success_daftar }}
                    </v-alert>

                    <v-btn
                        prepend-icon="mdi-google"
                        class="mb-6"
                        block
                        variant="outlined"
                        color="primary"
                        >Login With Google</v-btn
                    >
                    <v-form @submit.prevent="login">
                        <v-text-field
                            :error="$page.props.errors.email != null"
                            :error-messages="$page.props.errors.email"
                            v-model="form.email"
                            class="pb-2"
                            prepend-inner-icon="mdi-email"
                            label="Email/Nisn"
                            placeholder="Ketikan email anda"
                        />
                        <v-text-field
                            :error="$page.props.errors.password != null"
                            :error-messages="$page.props.errors.password"
                            v-model="form.password"
                            class="pb-2"
                            prepend-inner-icon="mdi-key"
                            append-inner-icon="mdi-eye"
                            @click:append-inner=""
                            type="password"
                            label="Password"
                            placeholder="Ketikan password anda"
                        />
                        <Btn type="submit" variant="flat" block>Login</Btn>
                    </v-form>
                </v-card-text>
                <v-card-text class="text-center">
                    <v-btn variant="text" class="font-bold text-blue"
                        >Lupa Password</v-btn
                    >
                    <v-btn variant="text" class="font-bold text-blue"
                        >Daftar Akun
                        <v-icon icon="mdi-chevron-right"></v-icon>
                    </v-btn>
                </v-card-text>
            </v-card>
        </div>
    </v-container>
</template>
