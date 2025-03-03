const readFile = require('./readFile');

const onRoutes = (app) => {
    app.get('/', (_req, res) => {
        res.status(200).send('Mock-API').end();
    });

    app.get('/healthcheck', (_req, res) => {
        res.status(200).send('ok').end();
    });

    app.get('/test-json', (_req, res) => {
        const data = readFile('test-1.json');
        res.status(200).json(data).end();
    });

    app.get('/test-html', (_req, res) => {
        const data = readFile('test-0.html', false);
        res.status(200).set({
            'Content-Type': 'text/html; charset=utf-8',
            'Content-Length': data.toString().length,
        }).send(data).end();
    });
};

module.exports = onRoutes;
