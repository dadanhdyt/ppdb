<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage, Link, useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";
const page = usePage();
const deletedItem = useForm({
    id: 0,
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
const dialogEdit = ref(false);
const editedForm = useForm({
    _method : 'patch',
    id: "",
    pendaftaran_id: "",
    nama: "",
    tahun: "",
    jenis_perlombaan: "",
    lingkup: "",
    perinkat: "",
    file_sertifikat: "",
});

const success_feedback = computed(() => page.props.errors.success);

const deleteLoading = ref(false);
const editLoading = ref(false);
const dialogDelete = ref(false);
const headers = [
    { title: "Aksi", key: "aksi" },
    { title: "Nama", key: "nama" },
    { title: "Jenis Perlombaan", key: "jenis_perlombaan" },
    { title: "Tahun", key: "tahun" },
    { title: "Lingkup", key: "lingkup" },
    { title: "Peringkat", key: "perinkat" },
    { title: "Sertifikat", key: "file_sertifikat" },
];

const actions = {
    editItem : () =>{
        editedForm.post(route('peserta.data-prestasi.update',editedForm.id),{
            onStart:()=>editLoading.value = true,
            onFinish : ()=>{
                editLoading.value = false
                dialogEdit.value = false;
            },
        });
    },
    deleteItem: () => {
        deletedItem.delete(
            route("peserta.data-prestasi.delete", deletedItem.id),
            {
                preserveScroll: true,
                preserveState: false,
                onStart: () => {
                    deleteLoading.value = true;
                },
                onFinish: () => {
                    dialogDelete.value = false;
                    deletedItem.reset();
                    deleteLoading.value = false;
                },
            }
        );
    },
    delete: (item) => {
        deletedItem.id = item.id;
        dialogDelete.value = true;
    },
    edit(item) {
        dialogEdit.value = true;
        editedForm.id = item.id;
        editedForm.nama = item.nama;
        editedForm.pendaftaran_id = item.pendaftaran_id;
        editedForm.tahun = item.tahun;
        editedForm.jenis_perlombaan = item.jenis_perlombaan;
        editedForm.lingkup = item.lingkup;
        editedForm.lingkup = item.lingkup;
        editedForm.perinkat = item.perinkat;
        editedForm.file_sertifikat = item.file_sertifikat;
    },
};
const items = computed(() => page.props.prestasi);
</script>
<template>
    <AuthenticatedLayout>
        <v-alert
            v-if="success_feedback"
            type="success"
            density="compact"
            closable
            variant="outlined"
            class="mb-2"
            >{{ success_feedback }}</v-alert
        >
        <v-dialog width="500px" v-model="dialogDelete">
            <v-card>
                <v-card-title>
                    <v-icon icon="mdi-help-box"></v-icon>
                    Konfirmasi
                </v-card-title>
                <v-card-subtitle
                    >Apakah anda yakin ingin menghapus data
                    ini?</v-card-subtitle
                >
                <v-card-actions>
                    <v-btn
                        density="compact"
                        :loading="deleteLoading"
                        @click="actions.deleteItem"
                        variant="plain"
                        color="error"
                        >YA</v-btn
                    >
                    <v-btn
                        density="compact"
                        variant="plain"
                        color="warning"
                        @click="dialogDelete = !dialogDelete"
                        >Tidak</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog width="500px" v-model="dialogEdit">
            <v-card>
                <v-card-title>
                    <v-icon icon="mdi-pencil"></v-icon>
                    Edit Item
                </v-card-title>
                <v-card-text>
                    <v-form>
                        <v-row>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    v-model="editedForm.nama"
                                    label="Nama"
                                    placeholder="Contoh (Lomba LKS Tingkat Provinsi)"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-text-field
                                    v-model="editedForm.tahun"
                                    label="Tahun"
                                    type="number"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6">
                                <v-select
                                    :items="jenisPrelombaan"
                                    v-model="editedForm.jenis_perlombaan"
                                    label="Jenis Perlombaan"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-select
                                    :items="lingkup"
                                    v-model="editedForm.lingkup"
                                    label="Lingkup"
                                ></v-select>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="6">
                                <v-select
                                    placeholder="Pilih peringkat"
                                    :items="peringkat"
                                    v-model="editedForm.perinkat"
                                    label="Perinkat"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" sm="6">
                                <v-file-input
                                    variant="outlined"
                                    show-size
                                    @input="
                                        editedForm.file_sertifikat =
                                            $event.target.files[0]
                                    "
                                    label="File Sertifikat"
                                    placeholder="Pilih file sertifikat (Format .pdf)"
                                    prepend-inner-icon="mdi-file"
                                    density="compact"
                                    prepend-icon=""
                                ></v-file-input>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-btn
                        density="compact"
                        :loading="editLoading"
                        variant="plain"
                        color="error"
                        @click="actions.editItem"
                        >YA</v-btn
                    >
                    <v-btn
                        density="compact"
                        variant="plain"
                        color="warning"
                        @click="dialogEdit = !dialogEdit"
                        >Tidak</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
        <!-- Tabel -->
        <v-card title="Data Prestasi" subtitle="Data Prestasi">
            <v-card-text>
                <Link :href="route('peserta.data-prestasi.tambah')">
                    <v-btn
                        variant="outlined"
                        color="primary"
                        prepend-icon="mdi-plus"
                        >TAMBAH</v-btn
                    >
                </Link>
                <v-data-table
                    density="compact"
                    :headers="headers"
                    :items="items"
                >
                    <template v-slot:item.aksi="{ item }">
                        <div class="flex gap-3">
                            <v-btn
                                variant="plain"
                                @click="actions.delete(item)"
                                color="error"
                                density="compact"
                                icon="mdi-delete"
                            />
                            <v-btn
                                @click="actions.edit(item)"
                                variant="plain"
                                color="warning"
                                density="compact"
                                icon="mdi-pencil-circle"
                            />
                        </div>
                    </template>
                    <template v-slot:item.file_sertifikat="{ value }">
                        <a :href="'/storage/' + value">
                            <v-btn
                                color="primary"
                                variant="plain"
                                density="comfortable"
                                icon="mdi-download"
                            />
                        </a>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </AuthenticatedLayout>
</template>
