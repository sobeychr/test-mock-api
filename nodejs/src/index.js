const express = require('express');
const onDynamic = require('./dynamicRoutes');
const onProcess = require('./process');
const onRoutes = require('./routes');

const app = express();
onProcess();
onRoutes(app);
onDynamic(app);

const SERVER_HOST = process.env?.SERVER_HOST ?? 'mock-api.local';
const SERVER_PORT = process.env?.SERVER_PORT ?? 1300;

app.listen(SERVER_PORT, SERVER_HOST, () => {
    console.log(`Running Mock-API as NodeJS under http://${SERVER_HOST}:${SERVER_PORT}`);
});
