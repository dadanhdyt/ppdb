<script setup>
import AuthenticatedLayout from '../../Layouts/AuthenticatedLayout.vue';

</script>
<template>
    <AuthenticatedLayout>
        <v-list-item prepend-avatar="https://avatars.githubusercontent.com/u/149863272?v=4">
            <v-list-item-title>{{ $page.props.auth.user.name }}</v-list-item-title>
            <v-list-item-subtitle>
                <div>{{ $page.props.auth.user.pendaftaran.no_pendaftaran }} (UMUM)</div>
                <v-badge class="pa-3" color="warning"
                    :content="$page.props.auth.user.pendaftaran.status_verifikasi"></v-badge>
            </v-list-item-subtitle>
        </v-list-item>

        <v-expansion-panels density="compact">
            <v-expansion-panel color="primary" title="Data Peserta">
                <v-expansion-panel-text>
                    <v-table>
                        <template v-slot:default>
                            <tbody>
                                <tr>
                                    <th class="text-left">No. Pendaftaran</th>
                                    <td>{{ $page.props.auth.user.pendaftaran.no_pendaftaran }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Nama Lengkap</th>
                                    <td>{{ $page.props.data_peserta?.nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">NISN</th>
                                    <td>{{ $page.props.data_peserta?.nisn }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Jenis Kelamin</th>
                                    <td>{{ $page.props.data_peserta?.jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Tinggi Badan</th>
                                    <td>{{ $page.props.data_peserta?.tinggi_badan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Berat Badan</th>
                                    <td>{{ $page.props.data_peserta?.berat_badan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Penyakit Yang Pernah Diderita</th>
                                    <td>{{ $page.props.data_peserta?.penyakit_yang_pernah_diderita }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Golongan Darah</th>
                                    <td>{{ $page.props.data_peserta?.golongan_darah }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Agama</th>
                                    <td>{{ $page.props.data_peserta?.agama }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Tempat Lahir</th>
                                    <td>{{ $page.props.data_peserta?.tempat_lahir }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Tanggal Lahir</th>
                                    <td>{{ $page.props.data_peserta?.tanggal_lahir }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Alamat - Nama Jalan</th>
                                    <td>{{ $page.props.data_peserta?.nama_jalan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Alamat - Desa/Kelurahan</th>
                                    <td>{{ $page.props.data_peserta?.desa_kelurahan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Alamat - Kecamatan</th>
                                    <td>{{ $page.props.data_peserta?.kecamatan }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Alamat - Kota/Kabupaten</th>
                                    <td>{{ $page.props.data_peserta?.kota_kabupaten }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Alamat - Kode Pos</th>
                                    <td>{{ $page.props.data_peserta?.kode_pos }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">No. Telp/HP</th>
                                    <td>{{ $page.props.data_peserta?.no_telp_hp }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Keterangan No. Telp/HP</th>
                                    <td>{{ $page.props.data_peserta?.keterangan_no_telp_hp }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Anak Ke</th>
                                    <td>{{ $page.props.data_peserta?.anak_ke }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left">Jumlah Saudara</th>
                                    <td>{{ $page.props.data_peserta?.jumlah_saudara }}</td>
                                </tr>

                            </tbody>
                        </template>
                    </v-table>
                </v-expansion-panel-text>
            </v-expansion-panel>

            <v-expansion-panel title="Data Orang Tua" color="primary">
                <v-expansion-panel-text>
                    <div v-if="$page.props.data_orang_tua != null" class="mb-3" v-for="(data, i) in $page.props.data_orang_tua">
                        <div class="font-bold rounded bg-primary px-4 py-2"> Data {{ i }}</div>
                        <v-col cols="12">
                            <v-row>
                                <v-col cols="4"><strong>Nama:</strong></v-col>
                                <v-col cols="8">{{ data.nama ?? '-' }}</v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4"><strong>NIK:</strong></v-col>
                                <v-col cols="8">{{ data.nik ?? '-' }}</v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4"><strong>Status:</strong></v-col>
                                <v-col cols="8">{{ data.status ?? '-' }}</v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4"><strong>Agama:</strong></v-col>
                                <v-col cols="8">{{ data.agama ?? '-' }}</v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4"><strong>Tempat Lahir:</strong></v-col>
                                <v-col cols="8">{{ data.tempat_lahir ?? '-' }}</v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4"><strong>Tanggal Lahir:</strong></v-col>
                                <v-col cols="8">{{ data.tanggal_lahir ?? '-' }}</v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4"><strong>Pendidikan Terakhir:</strong></v-col>
                                <v-col cols="8">{{ data.pendidikan_terakhir ?? '-' }}</v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4"><strong>Pekerjaan:</strong></v-col>
                                <v-col cols="8">{{ data.pekerjaan ?? '-' }}</v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4"><strong>Penghasilan:</strong></v-col>
                                <v-col cols="8">{{ data.penghasilan ?? '-' }}</v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="4"><strong>Alamat:</strong></v-col>
                                <v-col cols="8">{{ data.alamat ?? '-' }}</v-col>
                            </v-row>
                        </v-col>
                    </div>
                    <div v-else>
                        <v-alert variant="outlined" type="warning" density="compact">Data orang tua belum diisi! Silahkan isi terlebih dahulu</v-alert>
                    </div>
                </v-expansion-panel-text>
            </v-expansion-panel>
            <v-expansion-panel title="Data Prestasi" color="primary">
                <v-expansion-panel-text>
                    dadan
                </v-expansion-panel-text>
            </v-expansion-panel>
            <v-expansion-panel title="Data Rapot" color="primary">
                <v-expansion-panel-text>
                    dadan
                </v-expansion-panel-text>
            </v-expansion-panel>
            <v-expansion-panel title="Data Sekolah Asal" color="primary">
                <v-expansion-panel-text>

                    <v-list>
                        <v-list-item>NAMA: SMK IN$page.props.data_peserta?ATIKA SUMEDANG</v-list-item>
                        <v-list-item>NAMA: SMK IN$page.props.data_peserta?ATIKA SUMEDANG</v-list-item>
                    </v-list>

                </v-expansion-panel-text>
            </v-expansion-panel>
            <v-btn color="warning" append-icon="mdi-printer" block>Cetak</v-btn>
        </v-expansion-panels>

    </AuthenticatedLayout>
</template>
