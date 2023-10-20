const express = require('express');
var expressLayouts = require('express-ejs-layouts');
const bodyParser = require('body-parser');
const ejs = require('ejs');
require('dotenv').config();

const app = express();
app.use(expressLayouts);
app.use(express.static('public'))
app.set('view engine', 'ejs');
app.use(bodyParser.urlencoded({ extended: true }));

// Routes
const webRoutes = require('./routes/web');
app.use('/', webRoutes);

// Server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server started on port ${PORT}`);
});
