require('dotenv').config()

const ejs = require('ejs')
const express = require('express')
const flash = require('connect-flash')
const bodyParser = require('body-parser')
const session = require('express-session') 
const cookieParser = require('cookie-parser');
const auth = require('./middleware/authMiddleware')
const expressLayouts = require('express-ejs-layouts')

const app = express()

// setup sessions and cookies
app.use(cookieParser())
app.use(session({ 
    secret:'geeksforgeeks', 
    saveUninitialized: true, 
    resave: true
})) 
  
// use flash for message
app.use(flash()) 

// Setup Templating Engine
app.use(expressLayouts)
app.set('view engine', 'ejs')
app.use(bodyParser.urlencoded({ extended: true }))

// Enable Access Public Folder
app.use(express.static('public'))

// Load Routes
const authRoutes = require('./routes/auth')
const webRoutes = require('./routes/web')

app.use('/auth', authRoutes)
app.use('/', auth, webRoutes)

// Server
const PORT = process.env.PORT || 3000
app.listen(PORT, () => {
    console.log(`Server started on port ${PORT}`)
})
