<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
const loading = ref(false);
const $page = usePage();

const data = computed(function () {
    return $page.props.auth.user.pendaftaran.data_peserta;
});
const error = computed(() => $page.props.errors);
const snackbar = ref(true);
const form = useForm({
    nama_lengkap: data.value.nama_lengkap,
    nisn: data.value.nisn,
    jenis_kelamin: data.value.jenis_kelamin,
    tinggi_badan: data.value.tinggi_badan,
    berat_badan: data.value.berat_badan,
    penyakit_yang_pernah_diderita: data.value.penyakit_yang_pernah_diderita,
    golongan_darah: data.value.golongan_darah,
    agama: data.value.agama,
    tempat_lahir: data.value.tempat_lahir,
    tanggal_lahir: data.value.tanggal_lahir,
    alamat: {
        nama_jalan: data.value.nama_jalan,
        desa_kelurahan: data.value.desa_kelurahan,
        kecamatan: data.value.kecamatan,
        kota_kabupaten: data.value.kota_kabupaten,
        kode_pos: data.value.kode_pos,
    },
    no_telp_hp: data.value.no_telp_hp,
    keterangan_no_telp_hp: data.value.keterangan_no_telp_hp,
    anak_ke: data.value.anak_ke,
    jumlah_saudara: data.value.jumlah_saudara,
});

function simpan() {
    form.patch(route("peserta.data-peserta.simpan"), {
        onStart: function () {
            loading.value = true;
        },
        onFinish: function () {
            loading.value = false;
        },
        preserveScroll: false,
        preserveState: false,
    });
}
const jenisKelamin = computed(function () {
    return ["L", "P"];
});
</script>

<template>
    <AuthenticatedLayout>
        <v-card
            title="EDIT DATA PESERTA"
            subtitle="Edit data peserta dan lengkapi agar dapat mempermudah panitia"
        >
            <v-card-text>
                <v-form @submit.prevent="simpan">
                    <v-alert
                        closable
                        variant="tonal"
                        density="compact"
                        class="pa-2 mb-5"
                        v-for="(ob, i) in error"
                        :type="i === 'success_simpan' ? 'success' : 'error'"
                        >{{ ob }}</v-alert
                    >
                    <v-text-field
                        :error="error?.nama_lengkap != null"
                        v-model="form.nama_lengkap"
                        label="Nama Lengkap"
                        required
                        placeholder="Masukkan Nama Lengkap"
                    ></v-text-field>
                    <v-text-field
                        :error="error?.nisn != null"
                        v-model="form.nisn"
                        label="NISN"
                        required
                        placeholder="Masukkan NISN"
                        :value="data.nisn"
                    ></v-text-field>
                    <v-select
                        :error="error?.jenis_kelamin != null"
                        v-model="form.jenis_kelamin"
                        :items="jenisKelamin"
                        label="Jenis Kelamin"
                        required
                        placeholder="Pilih Jenis Kelamin"
                    ></v-select>
                    <v-row>
                        <v-col>
                            <v-text-field
                                :error="error?.tinggi_badan != null"
                                v-model="form.tinggi_badan"
                                label="Tinggi Badan"
                                required
                                placeholder="Masukkan Tinggi Badan"
                            ></v-text-field>
                        </v-col>
                        <v-col>
                            <v-text-field
                                :error="error?.berat_badan != null"
                                v-model="form.berat_badan"
                                label="Berat Badan"
                                required
                                placeholder="Masukkan Berat Badan"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-checkbox
                        :error="error?.penyakit_yang_pernah_diderita != null"
                        v-model="form.penyakit_yang_pernah_diderita"
                        label="Pernah menderita penyakit?"
                    ></v-checkbox>
                    <v-text-field
                        :error="error?.golongan_darah != null"
                        v-model="form.golongan_darah"
                        label="Golongan Darah"
                        required
                        placeholder="Masukkan Golongan Darah"
                    ></v-text-field>
                    <v-select
                        :items="$page.props.agama"
                        :error="error?.agama != null"
                        v-model="form.agama"
                        label="Agama"
                        required
                        placeholder="Masukkan Agama"
                    ></v-select>
                    <v-row>
                        <v-col>
                            <v-text-field
                                :error="error?.tempat_lahir != null"
                                v-model="form.tempat_lahir"
                                label="Tempat Lahir"
                                required
                                placeholder="Masukkan Tempat Lahir"
                            ></v-text-field>
                        </v-col>
                        <v-col>
                            <v-text-field
                                :error="error?.tanggal_lahir != null"
                                v-model="form.tanggal_lahir"
                                label="Tanggal Lahir"
                                type="date"
                                required
                                placeholder="Pilih Tanggal Lahir"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <v-text-field
                        :error="error?.alamat?.nama_jalan != null"
                        v-model="form.alamat.nama_jalan"
                        label="Nama Jalan"
                        required
                        placeholder="Masukkan Nama Jalan"
                    ></v-text-field>
                    <v-text-field
                        :error="error?.alamat?.desa_kelurahan != null"
                        v-model="form.alamat.desa_kelurahan"
                        label="Desa/Kelurahan"
                        required
                        placeholder="Masukkan Desa/Kelurahan"
                    ></v-text-field>
                    <v-text-field
                        :error="error?.alamat?.kecamatan != null"
                        v-model="form.alamat.kecamatan"
                        label="Kecamatan"
                        required
                        placeholder="Masukkan Kecamatan"
                    ></v-text-field>
                    <v-text-field
                        :error="error?.alamat?.kota_kabupaten != null"
                        v-model="form.alamat.kota_kabupaten"
                        label="Kota/Kabupaten"
                        required
                        placeholder="Masukkan Kota/Kabupaten"
                    ></v-text-field>
                    <v-text-field
                        :error="error?.alamat?.kode_pos != null"
                        v-model="form.alamat.kode_pos"
                        label="Kode Pos"
                        required
                        placeholder="Masukkan Kode Pos"
                    ></v-text-field>
                    <v-text-field
                        :error="error?.no_telp_hp != null"
                        v-model="form.no_telp_hp"
                        label="No. Telp/HP"
                        required
                        placeholder="Masukkan No. Telp/HP"
                    ></v-text-field>
                    <v-text-field
                        :error="error?.keterangan_no_telp_hp != null"
                        v-model="form.keterangan_no_telp_hp"
                        label="Keterangan No. Telp/HP"
                        required
                        placeholder="Masukkan Keterangan No. Telp/HP"
                    ></v-text-field>

                    <v-row>
                        <v-col>
                            <v-text-field
                                :error="error?.anak_ke != null"
                                v-model="form.anak_ke"
                                label="Anak Ke"
                                type="number"
                                required
                                placeholder="Masukkan Anak Ke"
                            ></v-text-field>
                        </v-col>
                        <v-col>
                            <v-text-field
                                :error="error?.jumlah_saudara != null"
                                v-model="form.jumlah_saudara"
                                label="Jumlah Saudara"
                                type="number"
                                required
                                placeholder="Masukkan Jumlah Saudara"
                            ></v-text-field>
                        </v-col>
                    </v-row>

                    <v-btn
                        :loading="loading"
                        type="submit"
                        variant="outlined"
                        color="primary"
                        >SIMPAN</v-btn
                    >
                </v-form>
            </v-card-text>
        </v-card>
    </AuthenticatedLayout>
</template>
