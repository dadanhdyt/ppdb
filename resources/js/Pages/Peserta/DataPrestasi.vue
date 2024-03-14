<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage, Link, useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";
const page = usePage();
const editedItem = useForm({
    id: 0,
});
const success_feedback = computed(()=>page.props.errors.success);

const deleteLoading = ref(false);
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
    deleteItem: () => {
        editedItem.delete(
            route("peserta.data-prestasi.delete", editedItem.id),
            {
                preserveScroll:true,
                preserveState:false,
                onStart: () => {
                    deleteLoading.value = true;
                },
                onFinish: () => {
                    dialogDelete.value = false;
                    editedItem.reset();
                    deleteLoading.value = false;
                },
            }
        );
    },
    delete: (item) => {
        editedItem.id = item.id;
        dialogDelete.value = true;
    },
};
const items = computed(() => page.props.prestasi);
</script>
<template>
    <AuthenticatedLayout>
        <v-alert v-if="success_feedback" type="success" density="compact" closable variant="outlined" class="mb-2">{{ success_feedback }}</v-alert>
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

        <v-card  title="Data Prestasi" subtitle="Data Prestasi">
            <v-card-text>
                <Link :href="route('peserta.data-prestasi.tambah')">
                    <v-btn variant="outlined" color="primary" prepend-icon="mdi-plus"
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
