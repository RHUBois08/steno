<?php
// config.php (STORE THIS FILE *OUTSIDE* YOUR WEB ROOT)

// Path to your service account JSON file
define('FIREBASE_SERVICE_ACCOUNT_JSON', __DIR__ . '\steno-interpreter-20da6-firebase-adminsdk-1z6sz-e96c19b442.json');

// Your Firebase Database URI
define('FIREBASE_DATABASE_URI', 'https://steno-interpreter-20da6-default-rtdb.firebaseio.com');

//Optional: Firebase Project ID
define('FIREBASE_PROJECT_ID', 'steno-interpreter-20da6');

//Optional: Storage Bucket
define('FIREBASE_STORAGE_BUCKET', 'steno-interpreter-20da6.appspot.com');

?>