<script setup>
import { reactive, ref, computed } from 'vue'
import { useMessage } from 'naive-ui'

const formRef = ref(null)
const form = reactive({
  nama: '',
  instagram: '',
  email: '',
  divisi: null, 
  title: null,
  alamat: '',
  estimasi: '',
  estimasiRaw: '',
  pengetahuan: null,
  alasan: null,
  harapan: '',
  processing: false
})

const rules = {
  nama: { required: true, message: 'Nama wajib diisi', trigger: 'blur' },
  email: { required: true, message: 'Email wajib diisi', trigger: 'blur' },
  divisi: { required: true, message: 'Divisi wajib dipilih', trigger: 'change' }, 
  title: { required: true, message: 'Kebutuhan wajib dipilih', trigger: 'change' },
  estimasi: { required: true, message: 'Estimasi wajib diisi', trigger: 'blur' },
  alamat: { required: true, message: 'Alamat wajib diisi', trigger: 'blur' },
}

const timestamp = ref(null)
const time = ref(null)
const timeSelesai = ref(null)

const divisiOptions = [
  { label: 'Fotografi', value: 'Fotografi' },
  { label: 'Agency', value: 'Agency' },
  { label: 'Studio', value: 'Studio' },
]

const kebutuhanOptions = {
  Fotografi: [
    { label: 'Wedding', value: 'Wedding' },
    { label: 'Prewedding', value: 'Prewedding' },
    { label: 'Pengajian / Siraman', value: 'Pengajian / Siraman' },
    { label: 'Wisuda', value: 'Wisuda' },
  ],
  Agency: [
    { label: 'Multicam Live streaming', value: 'Multicam Live streaming' },
    { label: 'Video Spin 360', value: 'Video Spin 360' },
    { label: 'Web Development', value: 'Web Development' },
    { label: 'Web Design', value: 'Web Design' },
    { label: 'App Development', value: 'App Development' },
    { label: 'App Design', value: 'App Design' },
  ],
  Studio: [
    { label: 'Photo & Video Wedding', value: 'Photo & Video Wedding' },
    { label: 'Photo & Video Prewedding', value: 'Photo & Video Prewedding' },
    { label: 'Photobooth', value: 'Photobooth' },
    { label: 'Sewa Sound System', value: 'Sewa Sound System' },
    { label: 'Sewa Rigging', value: 'Sewa Rigging' },
    { label: 'Sewa Blower', value: 'Sewa Blower' },
    { label: 'Sewa Genset', value: 'Sewa Genset' },
    { label: 'Sewa AC', value: 'Sewa AC' },
  ]
}

const formatedKebutuhan = computed(() => {
  return kebutuhanOptions[form.divisi] || []
})

const formatedPengetahuan = [
  { label: 'Teman / Keluarga / Saudara', value: 'Teman / Keluarga / Saudara' },
  { label: 'Instagram', value: 'Instagram' },
  { label: 'Google', value: 'Google' },
  { label: 'Lainnya', value: 'Lainnya' },
]

const formatedAlasan = [
  { label: 'Good Result Take a Picture', value: 'Good Result Take a Picture' },
  { label: 'Good Result Take a Video', value: 'Good Result Take a Video' },
  { label: 'Good Result Take a Photo and Video', value: 'Good Result Take a Photo and Video' },
  { label: 'Good Result Take a Photo, Video and Live Stream', value: 'Good Result Take a Photo, Video and Live Stream' },
  { label: 'Good Result Take a Photo, Video, Live Stream and Sound', value: 'Good Result Take a Photo, Video, Live Stream and Sound' },
  { label: 'Good Result Take a Photo, Video, Live Stream, Sound and Rigging', value: 'Good Result Take a Photo, Video, Live Stream, Sound and Rigging' },
  { label: 'Good Result Take a Photo, Video, Live Stream, Sound, Rigging and Blower', value: 'Good Result Take a Photo, Video, Live Stream, Sound, Rigging and Blower' },
  { label: 'Good Result Take a Photo, Video, Live Stream, Sound, Rigging, Blower and Genset', value: 'Good Result Take a Photo, Video, Live Stream, Sound, Rigging, Blower and Genset' },
  { label: 'Good Result Take a Photo, Video, Live Stream, Sound, Rigging, Blower, Genset and AC', value: 'Good Result Take a Photo, Video, Live Stream, Sound, Rigging, Blower, Genset and AC' },
]

const message = useMessage()

function formatRupiah(value) {
  const number = parseInt(value.replace(/\D/g, '')) || 0
  return number.toLocaleString('id-ID')
}

function handleEstimasiInput(value) {
  const raw = value.replace(/\D/g, '')
  form.estimasiRaw = raw
  form.estimasi = formatRupiah(raw)
}

const submit = () => {
  form.processing = true

  const tanggal = new Date(timestamp.value).toLocaleDateString('id-ID', {
    day: 'numeric', month: 'long', year: 'numeric'
  })

  const jamMulai = new Date(time.value).toLocaleTimeString('id-ID', {
    hour: '2-digit', minute: '2-digit'
  })

  const jamSelesai = new Date(timeSelesai.value).toLocaleTimeString('id-ID', {
    hour: '2-digit', minute: '2-digit'
  })

  const formattedEstimasi = new Intl.NumberFormat('id-ID').format(form.estimasiRaw)

  const waMessage = `Assalamualaikum

Helo Admin Fix Creative.
Saya ${form.nama}, saya tertarik Menggunakan Jasa Fix Creative

Nama: ${form.nama}
Email: ${form.email}
Divisi: ${form.divisi}
Kebutuhan: ${form.title}
Estimasi Tanggal: ${tanggal}
Jam Acara: ${jamMulai} - ${jamSelesai}
Estimasi Budget: Rp. ${formattedEstimasi}
Venue: ${form.alamat}
Instagram: ${form.instagram}

Saya mengetahui Fix Creative dari ${form.pengetahuan}

*Alasan Memilih Fix Creative:* ${form.alasan}

*Yang diharapkan dari Fix Creative:* ${form.harapan}

Boleh di info Pricelistnya, Terimakasih Fix Creative`

  const encoded = encodeURIComponent(waMessage)
  const nomorWA = '6285894934143'
  const waLink = `https://wa.me/${nomorWA}?text=${encoded}`

  window.open(waLink, '_blank')
  form.processing = false
}
</script>

<template>
    <section class="mt-20 py-4">
        <div class="text-center">
            <h1 class="text-2xl font-bold sm:text-4xl">HUBUNGI KAMI</h1>
            <div class="w-32 h-1 bg-primary-100 mt-2 mx-auto"></div>
        </div>
        <div class="mt-8">
            <div class="px-4 sm:px-16">
                <div class="w-full lg:mb-0 mb-10 mx-auto">
                    <h2 class="text-2xl font-bold sm:text-3xl text-primary">Get In Touch</h2>
                    <br>
                    <p class="text-sm sm:text-base">
                        Halo guys! Untuk lebih lanjut, silahkan Isi & Sumbit terlebih dahulu format Dibawah ini, kalian akan Otomatis Terhubung WhatsApp Kami. 
                        <br>
                        Yuk dapatkan Discount spesial dari kami.
                    </p>
                    <br>
                    <h3 class="text-lg font-bold sm:text-xl mb-5">
                        Fix Creative Production House
                    </h3>
                </div>
                <div class="w-full mx-auto">
                    <n-form ref="formRef" :model="form" :rules="rules" @submit.prevent="submit">
                        <n-form-item path="nama" label="Nama">
                            <n-input v-model:value="form.nama" placeholder="Nama" />
                        </n-form-item>

                        <n-form-item path="instagram" label="Instagram">
                            <n-input v-model:value="form.instagram" placeholder="Instagram" />
                        </n-form-item>

                        <n-form-item path="email" label="Email">
                            <n-input v-model:value="form.email" placeholder="Email" />
                        </n-form-item>

                        <n-form-item path="divisi" label="Layanan">
                            <n-select v-model:value="form.divisi" :options="divisiOptions" placeholder="Pilih Divisi" />
                        </n-form-item>

                        <n-form-item path="title" label="Kebutuhan">
                            <n-select v-model:value="form.title" :options="formatedKebutuhan" placeholder="Pilih Kebutuhan" />
                        </n-form-item>

                        <div class="flex gap-3">
                            <n-form-item class="w-1/3" path="tanggal" label="Tanggal">
                                <n-date-picker class="w-full" v-model:value="timestamp" type="date" />
                            </n-form-item>

                            <n-form-item class="w-1/3" path="jam_mulai" label="Jam Mulai">
                                <n-time-picker class="w-full" v-model:value="time" format="h:mm a" />
                            </n-form-item>

                            <n-form-item class="w-1/3" path="jam_selesai" label="Jam Selesai">
                                <n-time-picker class="w-full" v-model:value="timeSelesai" format="h:mm a" />
                            </n-form-item>
                        </div>

                        <n-form-item path="estimasi" label="Estimasi Budget">
                            <n-input
                                v-model:value="form.estimasi"
                                placeholder="Estimasi"
                                @update:value="handleEstimasiInput"
                            />
                        </n-form-item>

                        <n-form-item path="alamat" label="Alamat">
                            <n-input v-model:value="form.alamat" type="textarea" placeholder="Alamat" />
                        </n-form-item>

                        <n-form-item path="pengetahuan" label="Dari mana anda mengetahui Fix Creative?">
                            <n-select v-model:value="form.pengetahuan" :options="formatedPengetahuan" />
                        </n-form-item>

                        <n-form-item path="alasan" label="Mengapa anda memilih Fix Creative?">
                            <n-select v-model:value="form.alasan" :options="formatedAlasan" />
                        </n-form-item>

                        <n-form-item path="harapan" label="Yang anda harapkan dari Fix Creative">
                            <n-input v-model:value="form.harapan" type="textarea" placeholder="Harapan" />
                        </n-form-item>

                        <div class="flex justify-start">
                            <n-button attr-type="submit" type="primary" size="large" :disabled="form.processing">
                                Submit
                            </n-button>
                        </div>
                    </n-form>
                </div>
            </div>
            <div class="map mt-16">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.437900798684!2d106.94299827453266!3d-6.337282362004516!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699387d9e11061%3A0x1de8f0398bdf8d1d!2sFix%20Creative%20Photo%20Studio%20Bekasi!5e0!3m2!1sid!2sid!4v1747973624933!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
</template>