const express = require('express');
const phpExpress = require('php-express')({
    // Path to your PHP files
    bin: 'php', // Make sure PHP is installed and accessible in your environment
    // You can also specify the path to your PHP executable if needed
});

const app = express();

// Use php-express middleware
app.use(phpExpress);

// Define a route to serve the PHP script
app.get('/hello', (req, res) => {
    res.sendFile(__dirname + '/hello.php'); // Serve the PHP file
});

// Export the app as a Cloud Function
exports.phpFunction = functions.https.onRequest(app);


const functions = require('firebase-functions');
const express = require('express');
const phpExpress = require('php-express')({
    bin: 'php',
});

const app = express();

// Use the logger to log a message
const logger = functions.logger;

app.get('/hello', (req, res) => {
    logger.info('Hello endpoint was called'); // Log when the endpoint is accessed
    res.sendFile(__dirname + '/hello.php');
});

exports.phpFunction = functions.https.onRequest(app);