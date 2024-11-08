const process = require('node:process');

const onProcess = () => {
    process.on('disconnect', code => {
        console.log('Exit Mock-API', code);
    });

    process.on('exit', code => {
        console.log('Exit Mock-API', code);
    });

    const onEnd = signal => {
        console.log('Ending as', signal);
    }

    process.on('SIGINT', onEnd);
    process.on('SIGTERM', onEnd);
};

module.exports = onProcess;
