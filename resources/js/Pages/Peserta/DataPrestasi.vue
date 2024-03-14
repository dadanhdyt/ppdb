<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { usePage, Link } from "@inertiajs/vue3";
import { computed } from "vue";
const page = usePage();
const headers = [
    { title: "Aksi", key: "aksi" },
    { title: "Nama", key: "nama" },
    { title: "Jenis Perlombaan", key: "jenis_perlombaan" },
    { title: "Tahun", key: "tahun" },
    { title: "Lingkup", key: "lingkup" },
    { title: "Peringkat", key: "peringkat" },
    { title: "Sertifikat", key: "file_sertifikat" },
];
const items = computed(() => page.props.prestasi);
</script>
<template>
    <AuthenticatedLayout>
        <v-card title="Data Prestasi" subtitle="Data Prestasi">
            <v-card-text>
                <Link :href="route('peserta.data-prestasi.tambah')">
                    <v-btn color="primary" prepend-icon="mdi-plus"
                        >TAMBAH</v-btn
                    >
                </Link>
                <v-data-table :headers="headers" :items="items">
                    <template v-slot:item.aksi="{ value }">
                        <div class="flex gap-3">
                            <v-btn
                                color="info"
                                density="compact"
                                icon="mdi-eye"
                            />
                            <v-btn
                                color="error"
                                density="compact"
                                icon="mdi-delete"
                            />
                            <v-btn
                                color="warning"
                                density="compact"
                                icon="mdi-pencil"
                            />
                        </div>
                    </template>
                    <template v-slot:item.file_sertifikat="{ value }">
                        <a :href="'/storage/' + value">
                            <v-btn
                                color="primary"
                                density="compact"
                                prepend-icon="mdi-file"
                                >Lihat</v-btn
                            >
                        </a>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>
    </AuthenticatedLayout>
</template>
