<script setup>
import { reactive, ref } from 'vue'
import { useMessage } from 'naive-ui'
import { LocationArrow, TabletAlt, Envelope } from '@vicons/fa'

const formRef = ref(null)
const form = reactive({
  nama: '',
  instagram: '',
  email: '',
  title: '',
  alamat: '',
  estimasi: '',       // tampilan dengan format
  estimasiRaw: '',    // nilai asli
  pengetahuan: '',
  alasan: '',
  harapan: '',
  processing: false
})

const rules = {
  nama: { required: true, message: 'Nama wajib diisi', trigger: 'blur' },
  email: { required: true, message: 'Email wajib diisi', trigger: 'blur' },
  title: { required: true, message: 'Kebutuhan wajib dipilih', trigger: 'change' },
  estimasi: { required: true, message: 'Estimasi wajib diisi', trigger: 'blur' },
  alamat: { required: true, message: 'Alamat wajib diisi', trigger: 'blur' },
}

const timestamp = ref(null)
const time = ref(null)
const timeSelesai = ref(null)

const formatedKebutuhan = [
  { label: 'Wedding Only', value: 'Wedding Only' },
  { label: 'Paket All In Wedding', value: 'Paket All In Wedding' },
  { label: 'Prewedding Only', value: 'Prewedding Only' },
]

const formatedPengetahuan = [
  { label: 'Teman / Keluarga / Saudara', value: 'Teman / Keluarga / Saudara' },
  { label: 'Instagram', value: 'Instagram' },
  { label: 'Google', value: 'Google' },
]

const formatedAlasan = [
  { label: 'Good Result Take a Picture', value: 'Good Result Take a Picture' },
  { label: 'Good Result Take a Video', value: 'Good Result Take a Video' },
  { label: 'Good Result Take a Photo and Video', value: 'Good Result Take a Photo and Video' },
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

  const jamSelesai = new Date(time.value).toLocaleTimeString('id-ID', {
    hour: '2-digit', minute: '2-digit'
  })

  const formattedEstimasi = new Intl.NumberFormat('id-ID').format(form.estimasiRaw)

  const waMessage = `Assalamualaikum

Helo Admin Fix Creative.
Saya ${form.nama}, saya tertarik Menggunakan Jasa Fix Creative

Nama: ${form.nama}
Email: ${form.email}
Kebutuhan: ${form.title}
Estimasi Tanggal: ${tanggal}
Jam Acara: ${jamMulai} - ${jamSelesai}
Estimasi Budget: Rp. ${formattedEstimasi}
Venue: ${form.alamat}
Instagram: ${form.instagram}

Saya menentukan Fix Creative dari ${form.pengetahuan}

*Alasan Memilih Fix Creative:* ${form.alasan}

*Yang diharapkan dari Fix Creative:* ${form.harapan}

Boleh di info Pricelistnya, Terimakasih Fix Creative`

  const encoded = encodeURIComponent(waMessage)
  const nomorWA = '6285888074561'
  const waLink = `https://wa.me/${nomorWA}?text=${encoded}`

  window.open(waLink, '_blank')
  form.processing = false
}
</script>


<template>
    <section class="mt-20 px-4 py-4">
        <div class="text-center">
            <h1 class="text-2xl font-bold sm:text-4xl">HUBUNGI KAMI</h1>
            <div class="w-32 h-1 bg-primary mt-2 mx-auto"></div>
        </div>
        <div class="mt-8">
            <div class="flex flex-wrap justify-center gap-3 lg:flex-nowrap px-4 sm:px-16">
                <div class="w-full md:w-1/2 lg:mb-0 mb-10">
                    <h2 class="text-2xl font-bold sm:text-3xl text-primary">Get In Touch</h2>
                    <br>
                    <p class="text-sm sm:text-base">
                        Ingin tahu lebih jauh bagaimana kami dapat membantu anda? <br>
                        Silahkan hubungi kami melalui kontak di bawah ini.
                    </p>
                    <br>
                    <h3 class="text-lg font-bold sm:text-xl">
                        Fix Creative Production House
                    </h3>
                    <a href="https://maps.app.goo.gl/bbf76pkuc1d8zW1R8" target="_blank" class="address">
                        <p class="flex font-bold text-base items-center">
                            <LocationArrow class="mr-2 w-4" /> Fixcreative Production House
                        </p>
                        <p class="text-sm sm:text-base mt-1 ml-6">
                            Jl. Wibawa Mukti II No.RT06/04, Jatisari, Kec. Jatiasih, Kota Bks, Jawa Barat 17426
                        </p>
                    </a>
                    <a href="tel:085888074561" target="_blank" class="phone">
                        <p class="text-sm sm:text-base flex mt-2">
                            <TabletAlt class="mr-2 w-4" /> +62 858-8807-4561
                        </p>
                    </a>
                    <a href="mailto:fixcreativecoid@gmailcom" target="_blank" class="email">
                        <p class="text-sm sm:text-base flex mt-2">
                            <Envelope class="mr-2 w-4" /> fixcreativecoid@gmail.com
                        </p>
                    </a>
                </div>
                <div class="w-full md:w-1/2">
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

                        <n-form-item path="kebutuhan" label="Kebutuhan">
                            <n-select v-model:value="form.title" :options="formatedKebutuhan" />
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

                        <div class="flex justify-end">
                            <n-button attr-type="submit" type="primary" size="large" :disabled="form.processing">
                                Submit
                            </n-button>
                        </div>
                    </n-form>
                </div>
            </div>
        </div>
    </section>
</template>