const plugins = require('gulp-load-plugins');
const gulp = require('gulp');
const del = require('delete');

const webpackStream = require('webpack-stream');
const webpack2 = require('webpack');
const yargs = require('yargs');
const named = require('vinyl-named');

const browserSync = require('browser-sync');

// SASS
const uncss = require('uncss');


// POSTCSS
const postcss = require('gulp-postcss');
const rucksack = require('rucksack-css');
const postcssPartialImport = require('postcss-partial-import');
const postcssMixins = require('postcss-mixins');
const postcssCSSVars = require('postcss-simple-vars');
const postcssMqPacker = require('css-mqpacker');
const sortCSSmq = require('sort-css-media-queries');
const calc = require("postcss-calc");
const colors = require("postcss-color-function");
const postcssMerge = require('postcss-merge-rules');
const postcssNest = require('postcss-nested');
const stylefmt = require('stylefmt');
const replace = require('gulp-replace');
const cssComb = require('gulp-csscomb');
//const cssnano = require('cssnano');



// SASS OR POSTCSS
const autoprefixer = require('autoprefixer');

// FOR LIBRARIES CSS
const addsrc = require('gulp-add-src')
const minify = require('gulp-minify');
const uglify = require('gulp-uglify');
const gulp_cssnano = require('gulp-cssnano'); //not work postcss
const clean_css = require('gulp-clean-css');
const concat = require('gulp-concat');


// OPTIMIZE IMAGES
const imagemin = require('gulp-imagemin');

// FTP - SFTP
const ftp = require('vinyl-ftp');
const sftp = require('gulp-sftp')
//const user = process.env.FTP_USER;
//const pwd = process.env.FTP_PWD;
var gutil = require('gulp-util');

// Load all Gulp plugins into one variable
const $ = plugins();

// Check for --production flag
const PRODUCTION = !!yargs.argv.production;

const header = require("gulp-header");
const pkg = require('./package.json');
const rename = require("gulp-rename");


const config = require("./assets/config.js");

//new
const merge = require("merge-stream");
const plumber = require("gulp-plumber");
//const sass = require("gulp-sass");
const sass = require('gulp-sass')(require('sass'));
const fileinclude  = require('gulp-file-include');
const gulp_autoprefixer = require("gulp-autoprefixer"); //not work postcss

function clean(done) {
  //del(['./public/css'], done);
  //del(['./public/js'], done);
}









function build_sass() {
       var sources_paths = [
              './assets/sass/styles.scss',
              //'./assets/sass/*.scss',
              //"./dev/scss/**/*.scss"
       ];

       return gulp
              .src(sources_paths)
              .pipe(plumber())
              .pipe(sass({ outputStyle: "expanded", includePaths: "./../node_modules", })).on("error", sass.logError)
              .pipe(gulp_autoprefixer({ /*browsers: ['last 2 versions'],*/ cascade: false }))
              /*.pipe(gulp.src([
                     //'./assets/css/vendor/aos-2.3.1.css',
                     //'./assets/css/vendor/swiper.6.2.0.css',
                     './assets/css/vendor/swiper.10.1.0.css',
                     './assets/css/vendor/jquery.fancybox.3.5.7.css',
                     './assets/css/vendor/jquery.timepicker.min.css',
              ]))*/
              .pipe(concat('styles.css'))
              .pipe(browserSync.stream())
              .pipe(gulp.dest("./css"))
              //.pipe(rename({ suffix: ".min" }))
              .pipe(clean_css())
              .pipe(browserSync.stream())
              .pipe(gulp.dest("./css"))
              .pipe(browserSync.stream());
}

function build_css() {
       build_sass_admin();
       return build_sass();
       //return build_postcss();
}





function build_js_main() {//defer
   const scriptsUris = config.getMainJsJQuery();
   return gulp
     .src(scriptsUris)
     //.pipe(uglify())
     //.pipe(header(banner, { pkg: pkg }))
     .pipe(concat('main.js'))
     .pipe(minify({ ext: { min: '.min.js'}, /*ignoreFiles: ['-min.js']*/ }))
     //.pipe(rename({ suffix: '.min' }))
     .pipe(browserSync.stream())
     .pipe(gulp.dest('./js'));
 };








/****************************** UTILS ******************************/



function deploy(){
       const values = config.getConfigValues();
       var remoteLocation = values["ftp_remote_location"];
       var conn = ftp.create({
              host: values["ftp_host"],
              port: values["ftp_port"],
              user: values["ftp_username"],
              password: values["ftp_password"],
              parallel: 8,
              log: gutil.log
       });  
       var localFiles = values["ftp_paths"];
       return gulp.src(localFiles, {base: '.', buffer: false})
                     //.pipe(conn.newer(remoteLocation))
                     .pipe(conn.newerOrDifferentSize(remoteLocation))
                     .pipe(conn.dest(remoteLocation))
};

function deploy_test(){
       const values = config.getConfigValues();
       var remoteLocation = values["ftp_remote_location_test"];
       var conn = ftp.create({
              host: values["ftp_host_test"],
              port: values["ftp_port_test"],
              user: values["ftp_username_test"],
              password: values["ftp_password_test"],
              parallel: 5,
              log: gutil.log
       });    
       var localFiles = values["ftp_paths"];
       return gulp.src(localFiles, {base: '.', buffer: false})
              //.pipe(conn.newer(remoteLocation))
              .pipe(conn.newerOrDifferentSize(remoteLocation))
              .pipe(conn.dest(remoteLocation))
};

function deploy_sftp(){
  const values = config.getConfigValues();
	var remoteLocation = values["ftp_remote_location"];
	var conn = sftp({
    host: values["ftp_host"],
    port: values["sftp_port"],
		user: values["ftp_username"],
		pass: values["ftp_password"],
		remotePath: remoteLocation,
	});
	var localFiles = values["ftp_paths"];	  
	return gulp.src(localFiles, { base: '.', buffer: false } )
	        .pipe(conn);
};




function browser_sync(done) {
  const values = config.getConfigValues();
	//var files = values["browser_sync_files"];
  //browserSync.init(files, {
  browserSync.init(
    {
     proxy: values["browser_sync_proxy"],
     port: values["browser_sync_port"],
     notify: false
    },
    done,
  );
};
function browser_sync_watch(){
   gulp.watch('./assets/sass/**/*.scss').on('all', gulp.series(build_sass));
   gulp.watch("./assets/js/*.js").on('all', gulp.series(build_js_main));
   gulp.watch('./*.php').on('all', browserSync.reload);
}


/****************************** TASKS ******************************/

gulp.task('clean', gulp.series(clean));
gulp.task('build', gulp.series(build_sass, build_js_main));
gulp.task('watch', gulp.series('build', browser_sync, browser_sync_watch));

gulp.task('deploy', gulp.series(deploy));
gulp.task('deploy_sftp', gulp.series(deploy_sftp));
gulp.task('deploy_test', gulp.series(deploy_test));
gulp.task('build_sass', gulp.series(build_sass));
gulp.task('default', gulp.series('watch'), function() {

});



//gulp.task('go', ['default', 'postcssBuild', 'cssLibraries', 'jsLibraries', 'jsDeferLibrariesMain', 'browserSync'], function () {
// });