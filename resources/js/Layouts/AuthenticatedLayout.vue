<script setup>
import { ref } from "vue";

import { Link } from "@inertiajs/vue3";

let openDrawer = ref(false);
if ( window.matchMedia('(min-width:720px)').matches ){
     openDrawer.value = ref(true);
}
const menu = [
    {
        title: "MENU UTAMA",
        children: [
            {
                title: "Dashboard",
                route: "/",
                value: "dashboard",
                icon: "mdi-view-dashboard",
            },
            {
                title: "Data Administrasi",
                icon: "mdi-account",
                value: "data-administrasi",
                submenus: [
                    {
                        title: "Detail Peserta",
                        value: "detail-peserta",
                        route : route('peserta.detail')
                    },
                    {
                        title: "Edit Data Peserta",
                        value: "edit-data-peserta",
                        route:route('peserta.data-peserta.edit')
                    },
                    {
                        title: "Data Orang Tua",
                        value: "data-orang-tua",
                        route:route('peserta.data-orang-tua.edit')
                    },
                    {
                        title: "Data Prestasi",
                        value: "data-prestasi",
                        route:route('peserta.data-prestasi.index')
                    },
                    {
                        title: "Data Rapot",
                        value: "data-rapot",
                    },
                    {
                        title: "Data Sekolah",
                        value: "data-sekolah",
                    },
                    {
                        title: "Kelengkapan Berkas",
                        value: "kelengkapan-berkas",
                    },
                ],
            },
            {
                title: "Pesan",
                icon: "mdi-message",
                value: "data-administrasi",
                route: "/dadan/user",
            },
        ],
    },
    {
        title: "Other",
        children: [
            {
                title: "Ubah Password",
                route: "/change-password",
                icon: "mdi-lock-reset",
            },
            {
                title: "Logout",
                route: "/logout",
                icon: "mdi-logout",
            },
        ],
    },
];
</script>

<template>
    <v-layout>
        <v-app-bar color="primary" >
            <v-app-bar-nav-icon @click="openDrawer = !openDrawer"></v-app-bar-nav-icon>
            <v-toolbar-title>PPDB SMK IFSU</v-toolbar-title>

            <v-btn append-icon="mdi-account-cog">Logout</v-btn>
        </v-app-bar>
        <v-navigation-drawer v-model="openDrawer">
            <template v-slot:prepend>
                <v-list-item lines="two" prepend-avatar="https://avatars.githubusercontent.com/u/149863272?v=4"
                    :title="$page.props.auth.user.name" :subtitle="$page.props.auth.user.email"></v-list-item>
            </template>
            <v-divider></v-divider>
            <v-list lines="one" density="compact" nav>
                <div v-if="menu" v-for="(m, menuIndex) in menu" :key="menuIndex">
                    <v-list-subheader>{{ m.title }}</v-list-subheader>
                    <div v-if="m.children" v-for="(ch, indexChildren) in m.children">
                        <Link v-if="!ch.submenus && ch?.route" :href="ch?.route">
                        <v-list-item :value="ch.value" :prepend-icon="ch.icon" :title="ch.title"></v-list-item>
                        </Link>
                        <v-list-group v-else>
                            <template v-slot:activator="{ props }">
                                <v-list-item v-bind="props" :prepend-icon="ch.icon" :title="ch.title"></v-list-item>
                            </template>
                            <Link v-for="(sb, sbIndex) in ch.submenus" :href="sb?.route ?? '/'">
                            <v-list-item :prepend-icon="sb.icon" :title="sb.title" :value="sb.value"></v-list-item>
                            </Link>
                        </v-list-group>
                    </div>
                </div>
            </v-list>
            <template v-slot:append>
                <v-btn variant="flat" color="primary" rounded="0" class="pa-2" prepend-icon="mdi-whatsapp" block>Kontak</v-btn>
            </template>
        </v-navigation-drawer>
        <v-main>
            <v-container fluid>
                <slot/>
            </v-container>

        </v-main>
    </v-layout>
</template>
