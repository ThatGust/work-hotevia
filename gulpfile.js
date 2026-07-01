const gulp = require('gulp');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const clean_css = require('gulp-clean-css');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass')(require('sass'));
const gulp_autoprefixer = require('gulp-autoprefixer');
const merge = require('merge-stream');

const config = require("./assets/config.js");

/****************************** CORE FUNCTIONS ******************************/

function build_sass() {
    // Copiar Swiper CSS directamente a la carpeta /css si no existe
    gulp.src('./node_modules/swiper/swiper-bundle.min.css', { allowEmpty: true })
        .pipe(gulp.dest('./css'));

    // Tu tarea de Sass de siempre, sin merge ni cosas raras
    return gulp.src('./assets/sass/styles.scss')
        .pipe(plumber())
        .pipe(sass({ outputStyle: 'expanded' }).on('error', sass.logError))
        .pipe(gulp_autoprefixer({ cascade: false, remove: false }))
        .pipe(clean_css())
        .pipe(gulp.dest('./css'))
        .pipe(browserSync.stream());
}

function build_js_main() {
    const scriptsUris = config.getMainJsJQuery();
    return gulp.src(scriptsUris)
        .pipe(concat('main.min.js'))
        .pipe(terser())
        .pipe(gulp.dest('./js'))
        .pipe(browserSync.stream());   
}

/****************************** SERVER & WATCH ******************************/

function browser_sync(done) {
    const values = config.getConfigValues();
    browserSync.init({
        proxy: values["browser_sync_proxy"],
        port: values["browser_sync_port"],
        notify: false
    });
    done();
}

function browser_sync_watch() {
    gulp.watch('./assets/sass/**/*.scss', gulp.series(build_sass));
    gulp.watch('./assets/js/*.js', gulp.series(build_js_main));
    gulp.watch(['./functions/*.php', './parts/*.php', './*.php']).on('change', browserSync.reload);
}

/****************************** TASKS ******************************/

gulp.task('build', gulp.series(build_sass, build_js_main));
gulp.task('watch', gulp.series('build', browser_sync, browser_sync_watch));
gulp.task('build_sass', gulp.series(build_sass));
gulp.task('default', gulp.series('watch'));