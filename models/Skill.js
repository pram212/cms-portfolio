const mongoose = require('mongoose')
const useMongoDb = require('../database/mongodb')
useMongoDb()

// schema atau struktur  data (laravel: database schema)
const Schema = new mongoose.Schema({
    skill: { type: String, required: true },
    level: { type: String, required: false },
})

const Skill = mongoose.model('skill', Schema, 'keahlian')

module.exports = {
    Skill
}
