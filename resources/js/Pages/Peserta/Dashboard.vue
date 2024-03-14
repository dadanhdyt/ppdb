<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
    <AuthenticatedLayout>
        <v-alert variant="outlined" type='info'>Selamat datang <b>{{ $page.props.auth.user.name }}</b> Di PPDB SMK Informatika Sumdang</v-alert>

        <div class="grid grid-cols-1 gap-3 my-3 sm:grid-cols-2">
            <div>
                <v-alert variant="elevated" type='warning' :title="$page.props.status_verifikasi.status">
                   {{ $page.props.status_verifikasi.msg }}
                </v-alert>
            </div>
            <div>
                <v-alert variant="elevated" type='error' title="Status Diterima">
                    Mohon Maaf Status Diterima Masih Dalam Peninjauan
                </v-alert>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
