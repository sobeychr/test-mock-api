const process = require('node:process');

const onProcess = () => {
    process.on('disconnect', code => {
        console.log('Exit Mock-API', code);
    });

    process.on('exit', code => {
        console.log('Exit Mock-API', code);
    });
};

module.exports = onProcess;
