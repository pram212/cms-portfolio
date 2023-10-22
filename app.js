const express = require('express');
const expressLayouts = require('express-ejs-layouts');
const bodyParser = require('body-parser');
const ejs = require('ejs');
require('dotenv').config();
const session = require('express-session'); 
const flash = require('connect-flash');

const app = express();

app.use(session({ 
    secret:'geeksforgeeks', 
    saveUninitialized: true, 
    resave: true
})); 
  
app.use(flash()); 

// Setup Templating Engine
app.use(expressLayouts);
app.set('view engine', 'ejs');
app.use(bodyParser.urlencoded({ extended: true }));

// Enable Access Public Folder
app.use(express.static('public'))

// Load Routes
const webRoutes = require('./routes/web');
const { default: Swal } = require('sweetalert2');
app.use('/', webRoutes);

// Server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server started on port ${PORT}`);
});
