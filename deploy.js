/*
    Prerequisito: 
    npm install ftp minimatch

    Uso:
    node deploy.js produccion
    node deploy.js p
    
    node deploy.js staging
    node deploy.js s
*/
const fs = require('fs');
const path = require('path');
const crypto = require('crypto');
const FTPClient = require('ftp'); // Cambiado a cliente FTP estándar
const { minimatch } = require('minimatch');

// =========================================================================
// 1. CONFIGURACIÓN DE ENTORNOS Y CREDENCIALES
// =========================================================================
const CONFIG = {
    staging: {
        host: '46.202.196.239',
        port: 21,
        username: 'u229619509',
        password: '7-8-9Contra@',
        remotePath: '/domains/7devlab.com/public_html/demos/hotevia.info/wp-content/themes/newsplus'
    },
    produccion: {
        //host: '177.11.51.5',
        host: '217.76.142.221',
        port: 21,
        username: 'sen4445',
        password: 'TnpnNVEyOXVkSE1@',
        remotePath: '/wp-content/themes/newsplus'
    }
};

// =========================================================================
// 2. ARCHIVOS Y CARPETAS A INCLUIR (Patrones tipo Glob)
// =========================================================================
const FILES_TO_INCLUDE = [
    'css/**/*',
    'functions/**/*',
    'js/**/*',
    'parts/**/*',
    '**/*.php',
    'style.css',
    //'**/*.js',
];

const EXCLUDE_ALWAYS = [
    'assets/**',
    'fonts/**',
    'formats/**',
    'images/**',
    'includes/**',
    'languages/**',
    'License/**',
    'plugins/**',
    'templates/**',
    'woocommerce/**',
    'node_modules/**',
    '.git/**',
    '.deploy-cache.json',
    'deploy.js',
    '**/package.json',
    '**/package-lock.json',
    '**/.DS_Store'
];

// =========================================================================
// 3. LÓGICA DEL PROCESO DE DEPLOY (Soporta alias cortos)
// =========================================================================

let environment = process.argv[2];

if (environment === 'p') environment = 'produccion';
if (environment === 's') environment = 'staging';

if (!environment || !CONFIG[environment]) {
    console.error(`❌ Error: Debes especificar un entorno válido. Ejemplos:`);
    console.error(`   node deploy.js s  (o staging)`);
    console.error(`   node deploy.js p  (o produccion)`);
    process.exit(1);
}

const currentConfig = CONFIG[environment];
const CACHE_FILE = '.deploy-cache.json';
const ftp = new FTPClient();

function getFileHash(filePath) {
    const fileBuffer = fs.readFileSync(filePath);
    const hashSum = crypto.createHash('md5');
    hashSum.update(fileBuffer);
    return hashSum.digest('hex');
}

function getLocalFiles(dir, allFiles = []) {
    const files = fs.readdirSync(dir);

    files.forEach(file => {
        const fullPath = path.join(dir, file);
        const relativePath = path.relative(__dirname, fullPath).replace(/\\/g, '/');

        if (fs.statSync(fullPath).isDirectory()) {
            getLocalFiles(fullPath, allFiles);
        } else {
            const matchesInclude = FILES_TO_INCLUDE.some(pattern => minimatch(relativePath, pattern, { dot: true }));
            const matchesExclude = EXCLUDE_ALWAYS.some(pattern => minimatch(relativePath, pattern, { dot: true }));

            if (matchesInclude && !matchesExclude) {
                allFiles.push({
                    local: fullPath,
                    relative: relativePath
                });
            }
        }
    });

    return allFiles;
}

function loadCache() {
    if (fs.existsSync(CACHE_FILE)) {
        try {
            return JSON.parse(fs.readFileSync(CACHE_FILE, 'utf8'));
        } catch (e) {
            return {};
        }
    }
    return {};
}

// Función auxiliar para emular 'mkdir -p' (crear directorios recursivos) en FTP
function mkdirRecursive(targetDir) {
    return new Promise((resolve, reject) => {
        ftp.mkdir(targetDir, true, (err) => {
            if (err) return reject(err);
            resolve();
        });
    });
}

// Función auxiliar para subir un archivo vía FTP usando Promises
function putFile(localPath, remotePath) {
    return new Promise((resolve, reject) => {
        ftp.put(localPath, remotePath, (err) => {
            if (err) return reject(err);
            resolve();
        });
    });
}

async function runDeploy() {
    console.log(`🚀 Iniciando deploy en entorno: [${environment.toUpperCase()}]`);
    console.log(`🔌 Conectando a ${currentConfig.host}...`);

    const localFiles = getLocalFiles(__dirname);
    const oldCache = loadCache();
    const newCache = { ...oldCache };

    if (localFiles.length === 0) {
        console.log('⚠️ No se encontraron archivos que coincidan con los patrones para subir.');
        return;
    }

    const filesToUpload = [];
    localFiles.forEach(file => {
        const currentHash = getFileHash(file.local);
        const cacheKey = `${environment}:${file.relative}`;

        if (oldCache[cacheKey] !== currentHash) {
            filesToUpload.push({ ...file, hash: currentHash, cacheKey });
        }
    });

    if (filesToUpload.length === 0) {
        console.log('✅ Todos los archivos están actualizados. Nada que subir.');
        return;
    }

    console.log(`📦 Se detectaron ${filesToUpload.length} archivos modificados o nuevos.`);

    // Manejo de la conexión FTP mediante eventos integrados con Promesas
    ftp.on('ready', async () => {
        try {
            for (const file of filesToUpload) {
                const remoteFilePath = path.posix.join(currentConfig.remotePath, file.relative);
                const remoteDir = path.posix.dirname(remoteFilePath);

                // Crear el directorio remoto recursivamente si no existe
                await mkdirRecursive(remoteDir);

                console.log(`⬆️  Subiendo: ${file.relative} -> ${remoteFilePath}`);
                // Subir archivo
                await putFile(file.local, remoteFilePath);

                newCache[file.cacheKey] = file.hash;
            }

            fs.writeFileSync(CACHE_FILE, JSON.stringify(newCache, null, 2), 'utf8');
            console.log(`\n🎉 Deploy finalizado con éxito en [${environment.toUpperCase()}].`);

        } catch (err) {
            console.error('❌ Error durante el deploy:', err.message);
        } finally {
            ftp.end();
        }
    });

    ftp.on('error', (err) => {
        console.error('❌ Error de conexión FTP:', err.message);
    });

    // Iniciar la conexión
    ftp.connect({
        host: currentConfig.host,
        port: currentConfig.port,
        user: currentConfig.username, // La librería 'ftp' usa 'user' en vez de 'username'
        password: currentConfig.password
    });
}

runDeploy();