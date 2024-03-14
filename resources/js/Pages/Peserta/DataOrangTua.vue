<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, computed } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";
const page = usePage();
const pekerjaanItems = computed(() => page.props.pekerjaan);

const error = computed(() => page.props.errors);

const pendidikanTerakhir = [
    "Tidak Sekolah",
    "SD / MI",
    "SMP / MTs",
    "SMA / SMK / MA",
    "Diploma (D1-D4)",
    "Sarjana (S1)",
    "Magister (S2)",
    "Doktor (S3)",
];
const agama = computed(() => page.props.agama);

const statusOrangTua = [
    "Hidup Bersama",
    "Hidup Terpisah",
    "Duda",
    "Janda",
    "Meninggal",
];

const dataOrangTua = computed(() => page.props.dataOrangTua);

const orangTua = useForm({
    ayah: {
        nama: dataOrangTua?.value?.ayah?.nama,
        nik: dataOrangTua?.value?.ayah?.nik,
        status: dataOrangTua?.value?.ayah?.status,
        agama: dataOrangTua?.value?.ayah?.agama,
        tempat_lahir: dataOrangTua?.value?.ayah?.tempat_lahir,
        tanggal_lahir: dataOrangTua?.value?.ayah?.tanggal_lahir,
        pendidikan_terakhir: dataOrangTua?.value?.ayah?.pendidikan_terakhir,
        pekerjaan: dataOrangTua?.value?.ayah?.pekerjaan,
        penghasilan: dataOrangTua?.value?.ayah?.penghasilan,
        alamat: dataOrangTua?.value?.ayah?.alamat,
    },
    ibu: {
        nama: dataOrangTua?.value?.ibu?.nama,
        nik: dataOrangTua?.value?.ibu?.nik,
        status: dataOrangTua?.value?.ibu?.status,
        agama: dataOrangTua?.value?.ibu?.agama,
        tempat_lahir: dataOrangTua?.value?.ibu?.tempat_lahir,
        tanggal_lahir: dataOrangTua?.value?.ibu?.tanggal_lahir,
        pendidikan_terakhir: dataOrangTua?.value?.ibu?.pendidikan_terakhir,
        pekerjaan: dataOrangTua?.value?.ibu?.pekerjaan,
        penghasilan: dataOrangTua?.value?.ibu?.penghasilan,
        alamat: dataOrangTua?.value?.ibu?.alamat,
    },
    wali: {
        nama: dataOrangTua?.value?.wali?.nama,
        nik: dataOrangTua?.value?.wali?.nik,
        status: dataOrangTua?.value?.wali?.status,
        agama: dataOrangTua?.value?.wali?.agama,
        tempat_lahir: dataOrangTua?.value?.wali?.tempat_lahir,
        tanggal_lahir: dataOrangTua?.value?.wali?.tanggal_lahir,
        pendidikan_terakhir: dataOrangTua?.value?.wali?.pendidikan_terakhir,
        pekerjaan: dataOrangTua?.value?.wali?.pekerjaan,
        penghasilan: dataOrangTua?.value?.wali?.penghasilan,
        alamat: dataOrangTua?.value?.wali?.alamat,
    },
});
function simpan() {
    orangTua.patch(route("peserta.data-orang-tua.simpan"), {
        preserveScroll: true,
        preserveState: false,
    });
}
</script>
<template>
    <AuthenticatedLayout>
        <v-form @submit.prevent="simpan">
            <v-card elevation="0" class="m-0">
                <v-card-title>ISI Data Orang Tua</v-card-title>
                <v-card-subtitle
                    >Silahkan lengkapi data orang tua</v-card-subtitle
                >

                <v-card-text>
                    <v-alert
                        closable
                        variant="tonal"
                        density="compact"
                        class="pa-2 mb-5"
                        v-for="(ob, i) in error"
                        :type="i === 'success_simpan' ? 'success' : 'error'"
                        >{{ ob }}</v-alert
                    >
                    <v-expansion-panels>
                        <v-expansion-panel color="primary" title="DATA AYAH">
                            <v-expansion-panel-text>
                                <v-text-field
                                    v-model="orangTua.ayah.nama"
                                    label="Nama"
                                    placeholder="Nama"
                                ></v-text-field>
                                <v-text-field
                                    v-model="orangTua.ayah.nik"
                                    label="NIK"
                                    placeholder="NIK"
                                ></v-text-field>
                                <v-select
                                    v-model="orangTua.ayah.status"
                                    :items="statusOrangTua"
                                    label="status"
                                    placeholder="status"
                                ></v-select>
                                <v-select
                                    v-model="orangTua.ayah.agama"
                                    :items="agama"
                                    label="Agama"
                                    placeholder="Agama"
                                ></v-select>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            v-model="orangTua.ayah.tempat_lahir"
                                            label="Tempat Lahir"
                                            placeholder="Tempat Lahir"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-text-field
                                            v-model="
                                                orangTua.ayah.tanggal_lahir
                                            "
                                            type="date"
                                            label="Tanggal Lahir"
                                            placeholder="Tanggal Lahir"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-select
                                    v-model="orangTua.ayah.pendidikan_terakhir"
                                    :items="pendidikanTerakhir"
                                    label="Pendidikan Terakhir"
                                    placeholder="Pendidikan Terakhir"
                                ></v-select>
                                <v-row>
                                    <v-col>
                                        <v-select
                                            v-model="orangTua.ayah.pekerjaan"
                                            :items="pekerjaanItems"
                                            label="Pekerjaan"
                                            placeholder="Pekerjaan"
                                        ></v-select>
                                    </v-col>
                                    <v-col>
                                        <v-select
                                            v-model="orangTua.ayah.penghasilan"
                                            :items="[
                                                'Kurang Dari 500.000',
                                                '500.0000 - 2000.0000',
                                                '2000.0000 - 4000.0000',
                                                'Lebih Dari 4000.000',
                                                'Tidak Ada',
                                            ]"
                                            label="Penghasilan"
                                            placeholder="Penghasilan"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                                <v-textarea
                                    v-model="orangTua.ayah.alamat"
                                    label="alamat"
                                    placeholder="Alamat"
                                    variant="outlined"
                                ></v-textarea>
                            </v-expansion-panel-text>
                        </v-expansion-panel>

                        <v-expansion-panel color="primary" title="DATA IBU">
                            <v-expansion-panel-text>
                                <v-text-field
                                    v-model="orangTua.ibu.nama"
                                    label="Nama"
                                    placeholder="Nama"
                                ></v-text-field>
                                <v-text-field
                                    v-model="orangTua.ibu.nik"
                                    label="NIK"
                                    placeholder="NIK"
                                ></v-text-field>
                                <v-select
                                    v-model="orangTua.ibu.status"
                                    :items="statusOrangTua"
                                    label="status"
                                    placeholder="status"
                                ></v-select>
                                <v-select
                                    v-model="orangTua.ibu.agama"
                                    :items="agama"
                                    label="Agama"
                                    placeholder="Agama"
                                ></v-select>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            v-model="orangTua.ibu.tempat_lahir"
                                            label="Tempat Lahir"
                                            placeholder="Tempat Lahir"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-text-field
                                            v-model="orangTua.ibu.tanggal_lahir"
                                            type="date"
                                            label="Tanggal Lahir"
                                            placeholder="Tanggal Lahir"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-select
                                    v-model="orangTua.ibu.pendidikan_terakhir"
                                    :items="pendidikanTerakhir"
                                    label="Pendidikan Terakhir"
                                    placeholder="Pendidikan Terakhir"
                                ></v-select>
                                <v-row>
                                    <v-col>
                                        <v-select
                                            v-model="orangTua.ibu.pekerjaan"
                                            :items="pekerjaanItems"
                                            label="Pekerjaan"
                                            placeholder="Pekerjaan"
                                        ></v-select>
                                    </v-col>
                                    <v-col>
                                        <v-select
                                            v-model="orangTua.ibu.penghasilan"
                                            :items="[
                                                'Kurang Dari 500.000',
                                                '500.0000 - 2000.0000',
                                                '2000.0000 - 4000.0000',
                                                'Lebih Dari 4000.000',
                                                'Tidak Ada',
                                            ]"
                                            label="Penghasilan"
                                            placeholder="Penghasilan"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                                <v-textarea
                                    v-model="orangTua.ibu.alamat"
                                    label="alamat"
                                    placeholder="Alamat"
                                    variant="outlined"
                                ></v-textarea>
                            </v-expansion-panel-text>
                        </v-expansion-panel>

                        <v-expansion-panel color="primary" title="DATA WALI">
                            <v-expansion-panel-text>
                                <v-text-field
                                    v-model="orangTua.wali.nama"
                                    label="Nama"
                                    placeholder="Nama"
                                ></v-text-field>
                                <v-text-field
                                    v-model="orangTua.wali.nik"
                                    label="NIK"
                                    placeholder="NIK"
                                ></v-text-field>
                                <v-select
                                    v-model="orangTua.wali.status"
                                    :items="statusOrangTua"
                                    label="status"
                                    placeholder="status"
                                ></v-select>
                                <v-select
                                    v-model="orangTua.wali.agama"
                                    :items="agama"
                                    label="Agama"
                                    placeholder="Agama"
                                ></v-select>
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            v-model="orangTua.wali.tempat_lahir"
                                            label="Tempat Lahir"
                                            placeholder="Tempat Lahir"
                                        ></v-text-field>
                                    </v-col>
                                    <v-col>
                                        <v-text-field
                                            v-model="
                                                orangTua.wali.tanggal_lahir
                                            "
                                            type="date"
                                            label="Tanggal Lahir"
                                            placeholder="Tanggal Lahir"
                                        ></v-text-field>
                                    </v-col>
                                </v-row>
                                <v-select
                                    v-model="orangTua.wali.pendidikan_terakhir"
                                    :items="pendidikanTerakhir"
                                    label="Pendidikan Terakhir"
                                    placeholder="Pendidikan Terakhir"
                                ></v-select>
                                <v-row>
                                    <v-col>
                                        <v-select
                                            v-model="orangTua.wali.pekerjaan"
                                            :items="pekerjaanItems"
                                            label="Pekerjaan"
                                            placeholder="Pekerjaan"
                                        ></v-select>
                                    </v-col>
                                    <v-col>
                                        <v-select
                                            v-model="orangTua.wali.penghasilan"
                                            :items="[
                                                'Kurang Dari 500.000',
                                                '500.0000 - 2000.0000',
                                                '2000.0000 - 4000.0000',
                                                'Lebih Dari 4000.000',
                                                'Tidak Ada',
                                            ]"
                                            label="Penghasilan"
                                            placeholder="Penghasilan"
                                        ></v-select>
                                    </v-col>
                                </v-row>
                                <v-textarea
                                    v-model="orangTua.wali.alamat"
                                    label="alamat"
                                    placeholder="Alamat"
                                    variant="outlined"
                                ></v-textarea>
                            </v-expansion-panel-text>
                        </v-expansion-panel>
                        <v-btn
                            type="submit"
                            variant="elevated"
                            color="success"
                            block
                            >SIMPAN</v-btn
                        >
                    </v-expansion-panels>
                </v-card-text>
            </v-card>
        </v-form>
    </AuthenticatedLayout>
</template>
