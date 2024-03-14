<script setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
const page = usePage();
const JalurPendaftaran = computed(() => page.props.jalur_pendaftaran_id);
const loading = ref(false);
const formDaftar = useForm({
    nama: "",
    nisn: "",
    email: "",
    no_telp: "",
    jalur_pendaftaran_id: "",
    jenis_kelamin: "",
    password : '',
});
function simpan() {
    formDaftar.post(route("peserta.daftar.simpan"), {
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
    <div class="max-w-md mt-5 w-full mx-auto">
        <v-card :loading="loading" class="pa-5">
            <v-card-title>Daftar Akun Baru</v-card-title>
            <v-card-subtitle
                >Silahkan lengkapi untuk daftar akun</v-card-subtitle
            >
            <v-card-text>
                <v-form @submit.prevent="simpan">
                    <v-text-field
                        :error="page.props.errors.nama != null"
                        :error-messages="page.props.errors.nama"
                        v-model="formDaftar.nama"
                        label="Nama Lengkap"
                        placeholder="Nama lengkap"
                    ></v-text-field>
                    <v-text-field
                        :error="page.props.errors.nisn != null"
                        :error-messages="page.props.errors.nisn"
                        v-model="formDaftar.nisn"
                        label="NISN"
                        placeholder="NISN"
                    ></v-text-field>
                    <v-text-field
                        :error="page.props.errors.email != null"
                        :error-messages="page.props.errors.email"
                        v-model="formDaftar.email"
                        label="Alamat Email"
                    ></v-text-field>
                    <v-text-field
                        :error="page.props.errors.no_telp != null"
                        :error-messages="page.props.errors.no_telp"
                        v-model="formDaftar.no_telp"
                        label="Nomor Telepon"
                    ></v-text-field>
                    {{ JalurPendaftaran }}
                    <v-select
                        :error="page.props.errors.jalur_pendaftaran_id != null"
                        :error-messages="page.props.errors.jalur_pendaftaran_id"
                        v-model="formDaftar.jalur_pendaftaran_id"
                        label="Jalur pendaftaran"
                        item-value="id"
                        item-title="nama"
                        :items="$page.props.jalur_pendaftaran"
                    ></v-select>
                    <v-select
                        :error="page.props.errors.jenis_kelamin != null"
                        :error-messages="page.props.errors.jenis_kelamin"
                        v-model="formDaftar.jenis_kelamin"
                        :items="['L', 'P']"
                        label="Jenis kelamin"
                        placeholder="Pilih jenis kelamin"
                    ></v-select>
                    <v-text-field
                    type="password"
                        :error="page.props.errors.password != null"
                        :error-messages="page.props.errors.password"
                        v-model="formDaftar.password"
                        label="Password"
                    ></v-text-field>
                    <v-btn
                        :loading="loading"
                        color="primary"
                        block
                        type="submit"
                        >Daftar</v-btn
                    >
                </v-form>
            </v-card-text>
        </v-card>
    </div>
</template>
