<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
const form = useForm({
    nama: "",
    tahun: null,
    jenis_perlombaan: "",
    lingkup: "",
    perinkat: "",
    file_sertifikat: null,
});
const jenisPrelombaan = ["Perorangan", "Perkelompok"];
const lingkup = [
    "Provinsi",
    "Kabupaten/Kota",
    "Internasional",
    "Nasional",
    "Regional",
    "Sekolah",
];
const peringkat = [
    'Juara 1', 'Juara 2', 'Juara 3'
];
const simpan = function () {
    form.post(route('peserta.data-prestasi.simpan'),{
        preserveState:true,
        preserveScroll:true,
    })
}
</script>
<template>
    <AuthenticatedLayout>
        <v-card>
            <v-card-title>Tambah Data Prestasi</v-card-title>
            <v-card-subtitle>Silahkan isi data prestasi yang telah anda
                raih</v-card-subtitle>
            <v-card-text>
                <v-alert closable variant="tonal" density="compact" class="pa-2 mb-5" v-for="(ob, i) in $page.props.errors"
                    :type="i === 'success_simpan' ? 'success' : 'error'">{{ ob }}</v-alert>
                <v-form @submit.prevent="simpan">
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-text-field v-model="form.nama" label="Nama"
                                placeholder="Contoh (Lomba LKS Tingkat Provinsi)"></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-text-field v-model="form.tahun" label="Tahun" type="number"></v-text-field>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-select :items="jenisPrelombaan" v-model="form.jenis_perlombaan"
                                label="Jenis Perlombaan"></v-select>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-select :items="lingkup" v-model="form.lingkup" label="Lingkup"></v-select>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-select placeholder="Pilih peringkat" :items="peringkat" v-model="form.perinkat"
                                label="Perinkat"></v-select>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-file-input variant="outlined"
                                show-size
                                @input="form.file_sertifikat = $event.target.files[0]"
                                label="File Sertifikat"
                                placeholder="Pilih file sertifikat (Format .pdf)" prepend-inner-icon="mdi-file"
                                density="compact"
                                prepend-icon=""></v-file-input>
                        </v-col>
                    </v-row>
                    <v-btn type="submit" variant="outlined">Simpan</v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </AuthenticatedLayout>
</template>
