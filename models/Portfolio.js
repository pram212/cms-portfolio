const mongoose = require('mongoose')
const useMongoDb = require('../database/mongodb')
useMongoDb()

// schema atau struktur  data (laravel: database schema)
const Schema = new mongoose.Schema({
    nama: { type: String, required: [true, 'nama aplikasi wajib diisi'] },
    role: { type: String, required: [true, 'role wajib diisi'] },
    deskripsi: { type: String, required: [true, 'deskripsi wajib diisi'] },
    kategori: { type: String, required: [true, 'kategori wajib diisi'] },
    demo_url: { type: String, required: false },
    demo_info: { type: String, required: false },
    modul: [{
        type: String, // Tipe elemen array adalah string
        trim: true, // Menghapus spasi kosong dari awal dan akhir string
    }],
    teknologi: [{
        type: String, // Tipe elemen array adalah string
        trim: true, // Menghapus spasi kosong dari awal dan akhir string
    }],
    image_url: [{
        type: String, // Tipe elemen array adalah string
        trim: true, // Menghapus spasi kosong dari awal dan akhir string
    }],
})

const Portfolio = mongoose.model('portfolio', Schema, 'portfolio')

module.exports = {
    Portfolio
}
